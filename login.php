<?php
session_start();
if(isset($_POST["usuario"]) && isset($_POST["contraseña"])){ 
    include("./db.php");

    $sentencia = $conexion->prepare("SELECT *,count(*) as n_usuarios 
    FROM `tbl_usuarios` 
    WHERE usuario=:usuario 
    AND password=:password");

    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $contraseña);


    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    if($registro["n_usuarios"] > 0){
        $_SESSION['usuario'] = $registro["usuario"];
        $_SESSION['logueado'] = true;
        header("Location:index.php");
    } else {
        $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.3/css/boxicons.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            position: relative;
        }

        .banner {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container {
            margin-top: 60px;
            position: relative;
            z-index: 1;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
            overflow: hidden;
            position: relative;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 30px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            background-color: #fff;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .center-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #007bff;
        }

        body:after {
            content: '';
            position: fixed;
            z-index: -1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle, #86e0ff 0%, #007bff 100%);
            background-size: 200% 200%;
            animation: waveAnimation 15s linear infinite;
        }

        @keyframes waveAnimation {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 200% 200%;
            }
        }
    </style>
</head>

<body>
    <div class="banner">
        <h1>PescaNet</h1>
    </div>

    <main class="container">
        <div class="card">
            <div class="card-header text-center">
                <span style='font-size: 4em; color: #007bff;'>&#127907;P</span>
            </div>
            <div class="card-body">
                <?php if(isset($mensaje)){ ?>
                    <div class="alert alert-danger" role="alert">
                        <strong><?php echo $mensaje;?></strong>
                    </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bxs-user'></i></span>
                            <input type="text" class="form-control" name="usuario" id="usuario"
                                placeholder="Escriba su usuario">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bxs-lock'></i></span>
                            <input type="password" class="form-control" name="contraseña" id="contraseña"
                                placeholder="Escriba su contraseña">
                        </div>
                    </div>
                    <div class="center-btn">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Hagamos Más por Santa Rosalía y Ecologist Without Borders </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>

</html>






