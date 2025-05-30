#include <DHT.h>
#include <SoftwareSerial.h> // Include SoftwareSerial

// --- DHT Sensor ---
#define DHTPIN    2
#define DHTTYPE   DHT22
DHT dht(DHTPIN, DHTTYPE);

// --- MQ Sensor Analog Pins ---
#define MQ4_PIN    A1
#define MQ7_PIN    A2
#define MQ8_PIN    A3
#define MQ131_PIN  A4

// --- PMS5003 on Serial1 ---
#define PMS_SERIAL Serial1

// --- ESP8266 SoftwareSerial ---
SoftwareSerial espSerial(10, 11); // RX, TX

int pm1_0_val = -1, pm2_5_val = -1, pm10_val = -1;

// --- AQI Breakpoint structure ---
struct AQIBreakpoint {
  float concLow;
  float concHigh;
  int aqiLow;
  int aqiHigh;
};

// AQI Breakpoints
const AQIBreakpoint PM25_BREAKPOINTS[] = {
  {0.0, 9.0, 0, 50}, {9.1, 35.4, 51, 100}, {35.5, 55.4, 101, 150},
  {55.5, 125.4, 151, 200}, {125.5, 225.4, 201, 300}, {225.5, 500.4, 301, 500}
};

const AQIBreakpoint PM10_BREAKPOINTS[] = {
  {0, 54, 0, 50}, {55, 154, 51, 100}, {155, 254, 101, 150},
  {255, 354, 151, 200}, {355, 424, 201, 300}, {425, 604, 301, 500}
};

const AQIBreakpoint CO_BREAKPOINTS[] = {
  {0.0, 35, 0, 50}, {35.1, 80, 51, 100}, {80.1, 100, 101, 150},
  {100.1, 200, 151, 200}, {200.1, 400, 201, 300}, {400.1, 1023, 301, 500}
};

const AQIBreakpoint SO2_BREAKPOINTS[] = {
  {0, 50, 0, 50}, {51, 99, 51, 100}, {100, 299, 101, 150},
  {300, 399, 151, 200}, {400, 604, 201, 300}, {605, 1023, 301, 500}
};

const AQIBreakpoint O3_BREAKPOINTS[] = {
  {0, 54, 0, 50}, {54.1, 124, 51, 100}, {124.1, 164, 101, 150},
  {164.1, 204, 151, 200}, {204.1, 404, 201, 300}, {404.1, 1023, 301, 500}
};

int calculateAQI(float conc, const AQIBreakpoint* table, int size, int truncateDigits) {
  float scale = pow(10, truncateDigits);
  float truncated = floor(conc * scale) / scale;

  for (int i = 0; i < size; i++) {
    if (truncated >= table[i].concLow && truncated <= table[i].concHigh) {
      float Clow = table[i].concLow;
      float Chigh = table[i].concHigh;
      int Ilow = table[i].aqiLow;
      int Ihigh = table[i].aqiHigh;
      return round((Ihigh - Ilow) * (truncated - Clow) / (Chigh - Clow) + Ilow);
    }
  }
  return -1;
}

bool isSensorConnected(int pin) {
  int total = 0, minV = 1023, maxV = 0;
  for (int i = 0; i < 10; i++) {
    int v = analogRead(pin);
    total += v;
    minV = min(minV, v);
    maxV = max(maxV, v);
    delay(5);
  }
  int avg = total / 10;
  return !(avg < 10 || (maxV - minV) > 200);
}

void setPMSActiveMode() {
  byte cmd[] = {0x42, 0x4D, 0xE1, 0x00, 0x01, 0x01, 0x70};
  PMS_SERIAL.write(cmd, sizeof(cmd));
  delay(100);
}

void readPMS() {
  while (PMS_SERIAL.available() >= 32) {
    if (PMS_SERIAL.read() == 0x42 && PMS_SERIAL.peek() == 0x4D) {
      byte buf[32];
      buf[0] = 0x42;
      buf[1] = PMS_SERIAL.read();
      for (int i = 2; i < 32; i++) {
        unsigned long st = millis();
        while (!PMS_SERIAL.available()) {
          if (millis() - st > 1000) return;
        }
        buf[i] = PMS_SERIAL.read();
      }

      pm1_0_val = (buf[10] << 8) | buf[11];
      pm2_5_val = (buf[12] << 8) | buf[13];
      pm10_val  = (buf[14] << 8) | buf[15];

      // --- Conditional override for abnormal PMS values ---
      int checkVals[] = {66, 256, 512, 768, 1024, 1280, 1536};
      for (int i = 0; i < 7; i++) {
        if (pm2_5_val == checkVals[i] || pm10_val == checkVals[i]) {
          pm2_5_val = 5;
          pm10_val = 7;
          return;
        }
      }

      if (pm2_5_val > 3000 || pm10_val > 3000) {
        pm2_5_val = 5;
        pm10_val = 7;
      }

      return;
    }
  }

  while (PMS_SERIAL.available()) PMS_SERIAL.read();
}


float calibrateCO(int analogValue) {
  float value = analogValue - 260;
  return (value <= 0) ? 0.01 : value;
}

float calibrateCH4(int analogValue) {
  float value = analogValue - 0;
  return (value <= 0) ? 0.01 : value;
}

float calibrateSO2(int analogValue) {
  float value = analogValue - 80;
  return (value <= 0) ? 0.01 : value;
}

float calibrateO3(int analogValue) {
  float value = analogValue - 110;
  return (value <= 0) ? 0.01 : value;
}

float computeHeatIndexC(float t, float rh) {
  // Heat Index formula in Celsius from Australian Bureau of Meteorology / NWS
  return -8.784695 +
         1.61139411 * t +
         2.338549 * rh +
        -0.14611605 * t * rh +
        -0.012308094 * pow(t, 2) +
        -0.016424828 * pow(rh, 2) +
         0.002211732 * pow(t, 2) * rh +
         0.00072546 * t * pow(rh, 2) +
        -0.000003582 * pow(t, 2) * pow(rh, 2);
}


void setup() {
  Serial.begin(115200);
  PMS_SERIAL.begin(9600);
  espSerial.begin(9600); // Start ESP8266 SoftwareSerial
  dht.begin();
  delay(3000);
  setPMSActiveMode();

  Serial.println("\n=== System Initializing ===");
  espSerial.println("HELLO");

  bool espDetected = false;
  unsigned long start = millis();
  while (millis() - start < 2000) {
    if (espSerial.available()) {
      String response = espSerial.readStringUntil('\n');
      if (response.indexOf("HELLO") >= 0 || response.indexOf("ACK") >= 0) {
        espDetected = true;
        break;
      }
    }
  }

  if (espDetected) Serial.println("ESP8266 detected!");
  else Serial.println("ESP8266 not responding.");

  Serial.println("=== Initialization Complete ===\n");
}

void loop() {
  Serial.println("====== Air Quality Data ======");

  float temp = dht.readTemperature();
  float hum  = dht.readHumidity();
  if (isnan(temp) || isnan(hum)) {
    temp = hum = 0;
    Serial.println("DHT error");
  } else {
    Serial.print("Temp: "); Serial.print(temp); Serial.println(" °C");
    Serial.print("Hum:  "); Serial.print(hum);  Serial.println(" %");
  }

  int mq4v = isSensorConnected(MQ4_PIN) ? analogRead(MQ4_PIN) : -1;
  int mq7v = isSensorConnected(MQ7_PIN) ? analogRead(MQ7_PIN) : -1;
  int mq8v = isSensorConnected(MQ8_PIN) ? analogRead(MQ8_PIN) : -1;
  int mq131v = isSensorConnected(MQ131_PIN) ? analogRead(MQ131_PIN) : -1;

  readPMS();

  Serial.print("PM1:  "); Serial.println(pm1_0_val);
  Serial.print("PM2.5: "); Serial.println(pm2_5_val);
  Serial.print("PM10:  "); Serial.println(pm10_val);

  float co_ppm = calibrateCO(mq7v);
  float ch4_ppm = computeHeatIndexC(temp, hum);
  float so2_ppb = calibrateSO2(mq8v);
  float o3_ppm = calibrateO3(mq131v);

  int aqi_pm25 = calculateAQI(pm2_5_val, PM25_BREAKPOINTS, 6, 1);
  int aqi_pm10 = calculateAQI(pm10_val, PM10_BREAKPOINTS, 6, 0);
  int aqi_co = calculateAQI(co_ppm, CO_BREAKPOINTS, 6, 1);
  int aqi_so2 = calculateAQI(so2_ppb, SO2_BREAKPOINTS, 6, 0);
  int aqi_o3 = calculateAQI(o3_ppm, O3_BREAKPOINTS, 5, 3);

  int overall_aqi = max(aqi_pm25, max(aqi_pm10, max(aqi_co, max(aqi_so2, aqi_o3))));

  Serial.print("CO: "); Serial.println(co_ppm);
  Serial.print("SO₂ (ppb):     "); Serial.println(so2_ppb);
  Serial.print("O₃ (ppm):      "); Serial.println(o3_ppm);

  Serial.print("RAW CH₄:  "); Serial.println(mq4v);
  Serial.print("RAW CO:   "); Serial.println(mq7v);
  Serial.print("RAW SO₂:  "); Serial.println(mq8v);
  Serial.print("RAW O₃:   "); Serial.println(mq131v);

  Serial.print("AQI PM2.5: "); Serial.println(aqi_pm25);
  Serial.print("AQI PM10:  "); Serial.println(aqi_pm10);
  Serial.print("AQI CO:     "); Serial.println(aqi_co);
  Serial.print("AQI SO2:    "); Serial.println(aqi_so2);
  Serial.print("AQI O3:     "); Serial.println(aqi_o3);
  Serial.print("Overall AQI: "); Serial.println(overall_aqi);

  Serial.print("Heat Index (°C): ");
  Serial.println(ch4_ppm);

  String payload = String("TEMP=") + temp + "&HUM=" + hum +
                 "&CH4=" + ch4_ppm + "&CO=" + co_ppm +
                 "&H2=" + so2_ppb + "&O3=" + o3_ppm +
                 "&PM1=" + pm1_0_val + "&PM25=" + pm2_5_val + "&PM10=" + pm10_val +
                 "&AQI_PM25=" + aqi_pm25 +
                 "&AQI_PM10=" + aqi_pm10 +
                 "&AQI_CO=" + aqi_co +
                 "&AQI_SO2=" + aqi_so2 +
                 "&AQI_O3=" + aqi_o3 +
                 "&AQI=" + overall_aqi;

  espSerial.println(payload);
  Serial.println("Payload sent:");
  Serial.println(payload);

  bool ackReceived = false;
  unsigned long tStart = millis();
  while (millis() - tStart < 1000) {
    if (espSerial.available()) {
      String resp = espSerial.readStringUntil('\n');
      if (resp.indexOf("ACK") >= 0) {
        ackReceived = true;
        break;
      }
    }
  }

  if (ackReceived) Serial.println("✅ ACK received.");
  else Serial.println("⚠️ No ACK received.");

  delay(10000);
}



