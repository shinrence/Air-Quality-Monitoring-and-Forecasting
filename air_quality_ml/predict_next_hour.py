import pandas as pd
import numpy as np
import joblib
import json
import os
import time
from datetime import datetime, timedelta

# Pollutants and AQI
pollutants = ['temp', 'hum', 'ch4', 'co', 'so2', 'o3', 'pm25', 'pm10']
targets = pollutants + ['aqi']

model_dir = 'models'
data_path = 'C:/xampp1/htdocs/thesiss/all_data_log.txt'
prediction_file_1h = 'prediction_1h.txt'
prediction_file_8h = 'prediction_8h.txt'

def load_models():
    models = {}
    for target in targets:
        model_path = os.path.join(model_dir, f'{target}_predictor.joblib')
        if os.path.exists(model_path):
            models[target] = joblib.load(model_path)
        else:
            print(f"⚠️ Model not found for {target}")
    return models

def read_latest_data():
    with open(data_path, 'r') as f:
        lines = f.readlines()
        if len(lines) < 1080:
            raise ValueError("Not enough data. At least 1080 entries are required.")
        recent_lines = lines[-1080:]
        values = {p: [] for p in targets}

        for line in recent_lines:
            try:
                json_data = json.loads(line)
                values['temp'].append(float(json_data['TEMP']))
                values['hum'].append(float(json_data['HUM']))
                values['ch4'].append(float(json_data['CH4']))
                values['co'].append(float(json_data['CO']))
                values['so2'].append(float(json_data['H2']))
                values['o3'].append(float(json_data['O3']))
                values['pm25'].append(float(json_data['PM25']))
                values['pm10'].append(float(json_data['PM10']))
                values['aqi'].append(float(json_data['AQI']))
            except Exception as e:
                print(f"⚠️ Skipping a malformed line: {e}")

        averaged = {key: np.mean(val) if val else 0.0 for key, val in values.items()}
        return averaged

def recursive_predict(models, initial_data, hours=1):
    predictions = []
    current = initial_data.copy()

    for h in range(1, hours + 1):
        next_hour = {}
        for target in targets:
            features = pollutants if target == 'aqi' else [f for f in pollutants if f != target]
            X = np.array([current[f] for f in features]).reshape(1, -1)
            prediction = models[target].predict(X)[0]
            next_hour[target] = prediction
        predictions.append(next_hour)
        current = next_hour
    return predictions

def round_to_full_hour(dt):
    return dt.replace(minute=0, second=0, microsecond=0) + timedelta(hours=1)

def save_predictions_to_txt(predictions, start_time, file_path):
    with open(file_path, 'a') as f:
        for i, prediction in enumerate(predictions, 1):
            hour_start = start_time + timedelta(hours=i-1)
            hour_end = hour_start + timedelta(hours=1)
            f.write(f"Timestamp: {hour_start.strftime('%Y-%m-%d %H:%M')}\n")
            f.write(f"Hour: {hour_start.strftime('%H:%M')} - {hour_end.strftime('%H:%M')}\n")
            for key in targets:
                f.write(f"  {key}: {prediction[key]:.2f}\n")
            f.write("----\n")

def main():
    if not os.path.exists(data_path):
        print(f"❌ {data_path} not found.")
        return

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
                save_predictions_to_txt(predictions_1h, rounded_time, prediction_file_1h)
                last_1h_run = now.hour
            except Exception as e:
                print(f"❌ Failed 1-hour prediction: {e}")

        # 8-hour prediction (every 8th hour)
        if last_8h_run is None or now.hour % 8 == 0 and now.hour != last_8h_run:
            try:
                latest_data = read_latest_data()
                predictions_8h = recursive_predict(models, latest_data, hours=8)
                print(f"\n📗 8-Hour Prediction starting {rounded_time.strftime('%Y-%m-%d %H:%M')}:")
                for i, pred in enumerate(predictions_8h):
                    slot = rounded_time + timedelta(hours=i)
                    print(f"  🕒 {slot.strftime('%H:%M')} - {(slot + timedelta(hours=1)).strftime('%H:%M')}")
                    for key in targets:
                        print(f"    {key}: {pred[key]:.2f}")
                save_predictions_to_txt(predictions_8h, rounded_time, prediction_file_8h)
                last_8h_run = now.hour
            except Exception as e:
                print(f"❌ Failed 8-hour prediction: {e}")

        time.sleep(60)

if __name__ == "__main__":
    main()


