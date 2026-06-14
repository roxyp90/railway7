<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Sesión Expirada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #faf5ff; font-family: 'Nunito', sans-serif; margin: 0; }
        .error-page { 
            height: 100vh; display: flex; align-items: center; justify-content: center;
            background: radial-gradient(circle at center, #ffffff 0%, #ebf4ff 100%);
        }
        .error-card { 
            background: white; padding: 50px; border-radius: 40px; 
            box-shadow: 0 30px 60px rgba(107, 70, 193, 0.1); 
            max-width: 650px; width: 90%; text-align: center; border: 1px solid #e9d8fd;
        }
        .robot-container { animation: slow-float 4s infinite ease-in-out; margin-bottom: 10px; }
        .robot-img { width: 450px; height: auto; filter: drop-shadow(0 15px 20px rgba(107, 70, 193, 0.2)); }
        
        @keyframes slow-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(15px); }
        }
        
        .error-code { 
            font-size: 100px; font-weight: 900; margin: 0; 
            background: linear-gradient(135deg, #6b46c1 0%, #d53f8c 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; 
            line-height: 0.9;
        }
        .error-title { color: #2d3748; font-size: 2.2rem; font-weight: 800; margin-top: 15px; }
        .error-msg { color: #718096; font-size: 1.1rem; margin-bottom: 35px; }
        
        .btn-home { 
            background: linear-gradient(135deg, #6b46c1 0%, #805ad5 100%);
            color: white !important; padding: 15px 35px; border-radius: 20px; 
            font-weight: 700; text-decoration: none !important; display: inline-block; 
            transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(107, 70, 193, 0.3);
        }
        .btn-home:hover { transform: translateY(-4px); box-shadow: 0 15px 30px rgba(107, 70, 193, 0.4); }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="error-card">
            <div class="robot-container">
                <img src="{{ asset('images/robot-419.png') }}" alt="Sesión Expirada" class="robot-img">
            </div>
            <h1 class="error-code">419</h1>
            <h2 class="error-title">Sesión Expirada</h2>
            <p class="error-msg">Parece que estuviste inactivo por un tiempo. Por seguridad, tu sesión ha expirado.</p>
            <a href="{{ route('login') }}" class="btn-home">Volver a Ingresar</a>
        </div>
    </div>
</body>
</html>