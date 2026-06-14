<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acceso Denegado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #fff5f5; 
            font-family: 'Nunito', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .error-page { 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            background: radial-gradient(circle at center, #ffffff 0%, #fed7d7 100%);
        }

        .error-card { 
            background: white; 
            padding: 50px; 
            border-radius: 40px; 
            box-shadow: 0 30px 60px rgba(229, 62, 62, 0.1); 
            max-width: 650px; 
            width: 90%; 
            text-align: center; 
            border: 1px solid rgba(254, 178, 178, 0.5);
        }

        /* Animación de alerta (pulso suave) */
        .robot-container { 
            animation: pulse-red 3s infinite ease-in-out; 
            margin-bottom: 10px;
        }
        
        .robot-img {
            width: 350px;
            height: auto;
            filter: drop-shadow(0 15px 20px rgba(229, 62, 62, 0.2));
        }

        @keyframes pulse-red {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 15px 20px rgba(229, 62, 62, 0.2)); }
            50% { transform: scale(1.03); filter: drop-shadow(0 20px 30px rgba(229, 62, 62, 0.4)); }
        }
        
        .error-code { 
            font-size: 100px; 
            font-weight: 900; 
            margin: 0; 
            background: linear-gradient(135deg, #e53e3e 0%, #9b2c2c 100%);
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
            line-height: 0.9;
        }

        .error-title { 
            color: #2d3748; 
            font-size: 2.2rem; 
            font-weight: 800; 
            margin-top: 15px; 
        }

        .error-msg { 
            color: #718096; 
            font-size: 1.1rem; 
            margin-bottom: 35px;
            max-width: 85%;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-home { 
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white !important; 
            padding: 15px 35px; 
            border-radius: 20px; 
            font-weight: 700; 
            text-decoration: none !important; 
            display: inline-block; 
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(229, 62, 62, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-home:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 15px 30px rgba(229, 62, 62, 0.4);
            filter: brightness(1.1);
        }
    </style>
</head>
<body>

    <div class="error-page">
        <div class="error-card">
            <div class="robot-container">
                <img src="{{ asset('images/robot-403.png') }}" alt="Robot Acceso Denegado" class="robot-img">
            </div>

            <h1 class="error-code">403</h1>
            <h2 class="error-title">Acceso Denegado</h2>
            <p class="error-msg">¡Alto ahí! Parece que no tienes los permisos necesarios para explorar esta zona del sistema.</p>
            
            <a href="{{ route('home') }}" class="btn-home">
                VOLVER AL PANEL PRINCIPAL
            </a>
        </div>
    </div>

</body>
</html>