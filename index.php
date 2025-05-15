<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Air Quality Monitoring</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>

    <style>
        /* Import Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #1e1e2f, #12121f);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh; /* Changed from height to min-height */
    text-align: center;
    padding: 20px; /* Add padding to prevent content from being cut off */
}

/* Ensure the container doesn't get cut off */
.container {
    max-width: 900px;
    padding: 20px;
    animation: fadeIn 1.5s ease-in-out;
}

        h1 {
            font-size: 2.8rem;
            font-weight: 600;
        }

        p {
            font-size: 1.2rem;
            margin-top: 10px;
            opacity: 0.8;
        }

        .animation-container {
            width: 250px;
            margin: 20px auto;
        }

        .btn {
            display: inline-block;
            background: #ffcc00;
            color: #12121f;
            padding: 12px 24px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: #ffdb4d;
            transform: scale(1.05);
        }

        /* Responsive Fixes */
@media (max-width: 768px) {
    h1 {
        font-size: 2rem; /* Reduce font size */
    }

    p {
        font-size: 1rem;
    }

    .animation-container {
        width: 180px; /* Adjust animation size */
    }

    .btn {
        font-size: 1rem;
        padding: 10px 20px;
    }
}

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    
</head>
<body>


    <div class="container">
        <h1>Welcome to the Air Quality Monitoring and Forecasting System</h1>
        <p>Monitor real-time air quality levels and stay informed about your environment.</p>
        
        <div class="animation-container" id="lottie-animation"></div>

        <a href="dashboard.php" class="btn">Get Started</a>
    </div>

    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: false,
            autoplay: true,
            path: 'homepage.json' // Example Lottie animation
        });
    </script>

</body>
</html>
