import joblib

model_path = 'models/temp_predictor.joblib'

try:
    model = joblib.load(model_path)
    print("✅ Model loaded successfully.")
    print("Model type:", type(model))
except Exception as e:
    print(f"❌ Failed to load model: {e}")
