import pandas as pd
import numpy as np
import os
import json
import joblib
import requests
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor

# ✅ API endpoint
api_url = 'https://air-quality-php-backend.onrender.com/all_data_log_api.php'
models_dir = 'models'
os.makedirs(models_dir, exist_ok=True)

# ✅ Pollutants to model
pollutants = ['temp', 'hum', 'ch4', 'co', 'h2', 'o3', 'pm25', 'pm10']
all_targets = pollutants + ['aqi']  # Include AQI

# ✅ Fetch data from API
try:
    response = requests.get(api_url)
    response.raise_for_status()
    records = response.json()
except Exception as e:
    print(f"❌ Error fetching data from API: {e}")
    exit()

# ✅ Parse data into structured list
data = []
for record in records:
    try:
        data.append({
            'datetime': pd.to_datetime(record['timestamp']),
            'temp': float(record['temp']),
            'hum': float(record['hum']),
            'ch4': float(record['ch4']),
            'co': float(record['co']),
            'h2': float(record['h2']),         # SO₂
            'o3': float(record['o3']),
            'pm25': float(record['pm25']),
            'pm10': float(record['pm10']),
            'aqi': float(record['aqi_total'])  # Overall AQI
        })
    except Exception as e:
        print(f"⚠️ Skipping bad record: {record} | Error: {e}")

# ✅ Convert to DataFrame
df = pd.DataFrame(data)

# 🔍 Check if data is valid
if df.empty:
    print("❌ No valid data was parsed. Exiting.")
    exit()

# ✅ Sort by datetime
df = df.sort_values('datetime').reset_index(drop=True)

# ✅ Train a model for each pollutant + AQI
for target in all_targets:
    df_copy = df.copy()

    # Predict next hour's value
    target_col = f'{target}_next_hour'
    df_copy[target_col] = df_copy[target].shift(-1)
    df_copy = df_copy.dropna()

    # Features are all other pollutants (excluding AQI if not target)
    features = [p for p in pollutants if p != target] if target != 'aqi' else pollutants
    X = df_copy[features]
    y = df_copy[target_col]

    # Train/test split
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, shuffle=False)

    # Train model
    model = RandomForestRegressor(n_estimators=100, random_state=42)
    model.fit(X_train, y_train)

    # Save model
    model_filename = f'{target}_predictor.joblib'
    joblib.dump(model, os.path.join(models_dir, model_filename))
    print(f"✅ Trained and saved model: {model_filename}")

print("\n✅ All models trained and saved in the 'models/' folder.")


