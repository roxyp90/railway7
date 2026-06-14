<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f0f4f8; 
            font-family: 'Nunito', sans-serif;
            margin: 0;
            overflow: hidden; /* Evita scrolls innecesarios */
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
            box-shadow: 0 30px 60px rgba(0,0,0,0.1); 
            max-width: 650px; 
            width: 90%; 
            text-align: center; 
            border: 1px solid rgba(255,255,255,0.8);
            position: relative;
            z-index: 10;
        }

        /* Robot grande y animado */
        .robot-container { 
            animation: floating 3.5s infinite ease-in-out; 
            margin-bottom: 10px;
        }
        
        .robot-img {
            width: 380px; /* Tamaño ideal para que destaque */
            height: auto;
            filter: drop-shadow(0 15px 20px rgba(0,0,0,0.1));
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(20px) rotate(1.5deg); }
        }
        
        .error-code { 
            font-size: 100px; 
            font-weight: 900; 
            margin: 0; 
            background: linear-gradient(135deg, #4299e1 0%, #667eea 100%);
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
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-home { 
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white !important; 
            padding: 15px 35px; 
            border-radius: 20px; 
            font-weight: 700; 
            text-decoration: none !important; 
            display: inline-block; 
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(66, 153, 225, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-home:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 15px 30px rgba(66, 153, 225, 0.4);
            filter: brightness(1.1);
        }
    </style>
</head>
<body>

    <div class="error-page">
        <div class="error-card">
            <div class="robot-container">
                <img src="{{ asset('images/robot-404.png') }}" alt="Robot Buscando" class="robot-img">
            </div>

            <h1 class="error-code">404</h1>
            <h2 class="error-title">¡Ups! Te perdiste</h2>
            <p class="error-msg">Parece que el camino que seguías no existe. El robot ya está investigando qué pasó.</p>
            
            <a href="{{ route('home') }}" class="btn-home">
                Volver al Panel Principal
            </a>
        </div>
    </div>

</body>
</html>