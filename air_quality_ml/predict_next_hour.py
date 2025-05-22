import pandas as pd
import numpy as np
import joblib
import os
import time
from datetime import datetime, timedelta
import requests

pollutants = ['temp', 'hum', 'ch4', 'co', 'h2', 'o3', 'pm25', 'pm10']
targets = pollutants + ['aqi']
model_dir = 'models'
data_path = 'https://air-quality-php-backend.onrender.com/all_data_log_api.php'

api_url = 'https://air-quality-php-backend.onrender.com/forecast_data_api.php'

def load_models():
    models = {}
    for target in targets:
        actual_target = 'h2' if target == 'so2' else target
        model_path = os.path.join(model_dir, f'{actual_target}_predictor.joblib')

        if os.path.exists(model_path):
            models[target] = joblib.load(model_path)
        else:
            print(f"⚠️ Model not found for {target}")
    return models

def read_latest_data():
    try:
        response = requests.get(data_path)
        response.raise_for_status()
        records = response.json()
    except Exception as e:
        raise RuntimeError(f"Failed to fetch or parse API data: {e}")

    if len(records) < 360:
        raise ValueError("Not enough data. At least 1200 entries are required.")

    recent_records = records[-360:]
    values = {p: [] for p in targets}

    for record in recent_records:
        try:
            if any(record[k] in [None, ''] for k in ['temp', 'hum', 'ch4', 'co', 'h2', 'o3', 'pm25', 'pm10', 'aqi_total']):
                raise ValueError("Missing required fields.")

            values['temp'].append(float(record['temp']))
            values['hum'].append(float(record['hum']))
            values['ch4'].append(float(record['ch4']))
            values['co'].append(float(record['co']))
            values['h2'].append(float(record['h2']))
            values['o3'].append(float(record['o3']))
            values['pm25'].append(float(record['pm25']))
            values['pm10'].append(float(record['pm10']))
            values['aqi'].append(float(record['aqi_total']))
        except Exception as e:
            print(f"⚠️ Skipping bad record: {record} | Error: {e}")

    averaged = {key: np.mean(val) if val else 0.0 for key, val in values.items()}
    return averaged

def recursive_predict(models, initial_data, hours=1):
    predictions = []
    current = initial_data.copy()

    for h in range(1, hours + 1):
        next_hour = {}
        for target in targets:
            features = pollutants if target == 'aqi' else [f for f in pollutants if f != target]
            X = pd.DataFrame([current], columns=features)

            prediction = models[target].predict(X)[0]
            next_hour[target] = prediction
        predictions.append(next_hour)
        current = next_hour
    return predictions

def round_to_full_hour(dt):
    return dt.replace(minute=0, second=0, microsecond=0) + timedelta(hours=1)

def prepare_prediction_payload(predictions, start_time):
    payload = []
    for i, pred in enumerate(predictions):
        hour_start = start_time + timedelta(hours=i)
        hour_end = hour_start + timedelta(hours=1)
        entry = {
            "timestamp": hour_start.strftime('%Y-%m-%d %H:%M'),
            "hour_range": f"{hour_start.strftime('%H:%M')} - {hour_end.strftime('%H:%M')}",
            "values": {key: round(pred[key], 2) for key in pred}
        }
        payload.append(entry)
    return payload

def send_predictions_to_api(predictions, api_url):
    try:
        response = requests.post(api_url, json=predictions)
        if response.status_code == 200:
            print("✅ Successfully sent predictions to API.")
        else:
            print(f"❌ Failed to send predictions. Status code: {response.status_code}")
    except Exception as e:
        print(f"❌ Exception sending predictions: {e}")

def main():
    models = load_models()
    last_1h_run = None
    last_8h_run = None

    while True:
        now = datetime.now()
        rounded_time = round_to_full_hour(now)

        # 1-hour prediction
        if last_1h_run is None or now.hour != last_1h_run:
            try:
                latest_data = read_latest_data()
                predictions_1h = recursive_predict(models, latest_data, hours=1)
                print(f"\n📘 1-Hour Prediction for {rounded_time.strftime('%Y-%m-%d %H:%M')} - {(rounded_time + timedelta(hours=1)).strftime('%H:%M')}:")
                for key in targets:
                    print(f"  {key}: {predictions_1h[0][key]:.2f}")

                # Optional: send 1h predictions too
                # payload_1h = prepare_prediction_payload(predictions_1h, rounded_time)
                # send_predictions_to_api(payload_1h, api_url)

                last_1h_run = now.hour
            except Exception as e:
                print(f"❌ Failed 1-hour prediction: {e}")

        # 8-hour prediction (every 8th hour)
        if last_8h_run is None or (now.hour % 8 == 0 and now.hour != last_8h_run):
            try:
                latest_data = read_latest_data()
                predictions_8h = recursive_predict(models, latest_data, hours=8)
                print(f"\n📗 8-Hour Prediction starting {rounded_time.strftime('%Y-%m-%d %H:%M')}:")
                for i, pred in enumerate(predictions_8h):
                    slot = rounded_time + timedelta(hours=i)
                    print(f"  🕒 {slot.strftime('%H:%M')} - {(slot + timedelta(hours=1)).strftime('%H:%M')}")
                    for key in targets:
                        print(f"    {key}: {pred[key]:.2f}")

                # Send to API:
                payload_8h = prepare_prediction_payload(predictions_8h, rounded_time)
                send_predictions_to_api(payload_8h, api_url)

                last_8h_run = now.hour
            except Exception as e:
                print(f"❌ Failed 8-hour prediction: {e}")

        time.sleep(60)

if __name__ == "__main__":
    main()



