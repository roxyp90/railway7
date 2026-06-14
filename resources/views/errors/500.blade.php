<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error del Servidor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f7fafc; 
            font-family: 'Nunito', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .error-page { 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            background: radial-gradient(circle at center, #ffffff 0%, #e2e8f0 100%);
        }

        .error-card { 
            background: white; 
            padding: 50px; 
            border-radius: 40px; 
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.05); 
            max-width: 650px; 
            width: 90%; 
            text-align: center; 
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Animación de flotado suave */
        .robot-container { 
            animation: floating 3.5s infinite ease-in-out; 
            margin-bottom: 10px;
        }
        
        .robot-img {
            width: 450px;
            height: auto;
            filter: drop-shadow(0 15px 20px rgba(0,0,0,0.1));
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(20px) rotate(-1deg); }
        }
        
        .error-code { 
            font-size: 100px; 
            font-weight: 900; 
            margin: 0; 
            background: linear-gradient(135deg, #718096 0%, #2d3748 100%);
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
            line-height: 0.9;
        }

        .error-title { 
            color: #1a202c; 
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
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            color: white !important; 
            padding: 15px 35px; 
            border-radius: 20px; 
            font-weight: 700; 
            text-decoration: none !important; 
            display: inline-block; 
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(45, 55, 72, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-home:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 15px 30px rgba(45, 55, 72, 0.3);
            filter: brightness(1.2);
        }
    </style>
</head>
<body>

    <div class="error-page">
        <div class="error-card">
            <div class="robot-container">
                <img src="{{ asset('images/robot-500.png') }}" alt="Error de Servidor" class="robot-img">
            </div>

            <h1 class="error-code">500</h1>
            <h2 class="error-title">Error del Servidor</h2>
            <p class="error-msg">¡Algo se rompió internamente! Nuestros robots están revisando los cables para que todo vuelva a la normalidad.</p>
            
            <a href="{{ route('home') }}" class="btn-home">
                Volver al Inicio
            </a>
        </div>
    </div>

</body>
</html>