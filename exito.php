<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éxito</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding: 50px;
        }

        .success-message {
            color: #3498db; 
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px; 
        }

        .return-button {
            background-color: #3498db;
            padding: 12px 24px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .return-button:hover {
            background-color: #2980b9; 
            transform: scale(1.05); 
        }
    </style>
</head>
<body>
    <div class="success-message">
        ¡Respaldo exitoso! El archivo se guardó correctamente.
    </div>

    <button class="return-button" onclick="window.location.href='index.php'">Volver a la aplicación</button>
</body>
</html>

