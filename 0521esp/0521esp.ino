#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// Wi-Fi credentials
const char* ssid     = "Infinix";
const char* password = "zxcvbnm1";

// Server URL
const char* serverUrl = "https://air-quality-php-backend.onrender.com/data_receive.php";


// Function to encode URL parameters
String urlEncode(const String& str) {
  String encoded = "";
  char c;
  char code0, code1;
  for (int i = 0; i < str.length(); i++) {
    c = str.charAt(i);
    if (isalnum(c)) {
      encoded += c;
    } else {
      encoded += '%';
      code0 = (c >> 4) & 0xF;
      code1 = c & 0xF;
      encoded += char(code0 < 10 ? '0' + code0 : 'A' + code0 - 10);
      encoded += char(code1 < 10 ? '0' + code1 : 'A' + code1 - 10);
    }
  }
  return encoded;
}

// Connect to Wi-Fi
void connectToWiFi() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.print("🔄 Connecting to Wi-Fi");
    WiFi.begin(ssid, password);

    unsigned long startAttemptTime = millis();

    // Wait for connection or timeout after 10 seconds
    while (WiFi.status() != WL_CONNECTED && millis() - startAttemptTime < 10000) {
      delay(500);
      Serial.print(".");
    }

    if (WiFi.status() == WL_CONNECTED) {
      Serial.println("\n✅ Connected to Wi-Fi!");
      Serial.print("IP Address: ");
      Serial.println(WiFi.localIP());
    } else {
      Serial.println("\n❌ Failed to connect to Wi-Fi.");
    }
  }
}

void setup() {
  Serial.begin(9600); // Communication with Mega
  delay(1000);
  Serial.println("\n=== ESP8266 Booting ===");

  connectToWiFi();  // Initial Wi-Fi connection

  Serial.println("=== Ready to receive data from Mega ===");
}

unsigned long lastReconnectAttempt = 0;
const unsigned long reconnectInterval = 10000; // 10 seconds

void loop() {
  // Reconnect if Wi-Fi drops or hasn't connected in 10 seconds
  if (WiFi.status() != WL_CONNECTED && millis() - lastReconnectAttempt > reconnectInterval) {
    lastReconnectAttempt = millis();
    connectToWiFi();
  }

  // Read and send data if available
  if (Serial.available()) {
    String data = Serial.readStringUntil('\n');
    data.trim();

    if (data.length() > 0) {
      Serial.print("📥 Received from Mega: ");
      Serial.println(data);

      if (data == "HELLO") {
        Serial.println("HELLO");
      } else {
        sendToServer(data);
        Serial.println("ACK");
      }
    }
  }
}


// Send data to server
void sendToServer(const String& payload) {
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;

    http.begin(client, serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String postData = "data=" + urlEncode(payload);
    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      Serial.print("📤 Data sent successfully! Response Code: ");
      Serial.println(httpResponseCode);
    } else {
      Serial.print("❌ Error sending data. Code: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  } else {
    Serial.println("❌ Wi-Fi not connected.");
  }
}









