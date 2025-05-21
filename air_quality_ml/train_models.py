import pandas as pd
import numpy as np
import os
import json
import joblib
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor

# Path to your all_data_log.txt
log_file_path = 'https://air-quality-php-backend.onrender.com/all_data_log_api.php'
models_dir = 'models'
os.makedirs(models_dir, exist_ok=True)

# Pollutants to model
pollutants = ['temp', 'hum', 'ch4', 'co', 'so2', 'o3', 'pm25', 'pm10']
all_targets = pollutants + ['aqi']  # Include AQI

# Read all lines and parse as JSON
with open(log_file_path, 'r') as f:
    lines = f.readlines()

data = []
for line in lines:
    try:
        record = json.loads(line)
        data.append({
            'datetime': pd.to_datetime(record['timestamp']),
            'temp': float(record['TEMP']),
            'hum': float(record['HUM']),
            'ch4': float(record['CH4']),
            'co': float(record['CO']),
            'so2': float(record['H2']),  # H2 = SO2
            'o3': float(record['O3']),
            'pm25': float(record['PM25']),
            'pm10': float(record['PM10']),
            'aqi': float(record['AQI'])  # Include AQI
        })
    except Exception as e:
        print(f"⚠️ Skipping bad line: {line.strip()} | Error: {e}")

df = pd.DataFrame(data).sort_values('datetime').reset_index(drop=True)

# Train a model for each pollutant + AQI
for target in all_targets:
    df_copy = df.copy()

    # Predict next hour's value
    target_col = f'{target}_next_hour'
    df_copy[target_col] = df_copy[target].shift(-1)
    df_copy = df_copy.dropna()

    # Features are all other pollutants (not including AQI itself)
    features = [p for p in pollutants if p != target] if target != 'aqi' else pollutants
    X = df_copy[features]
    y = df_copy[target_col]

    # Split for training/testing
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, shuffle=False)

    model = RandomForestRegressor(n_estimators=100, random_state=42)
    model.fit(X_train, y_train)

    # Save model
    model_filename = f'{target}_predictor.joblib'
    joblib.dump(model, os.path.join(models_dir, model_filename))

print("✅ Models (including AQI predictor) trained using all_data_log.txt and saved in 'models/' folder.")

