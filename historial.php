<?php
include("../../db.php");

session_start(); 

$accion = isset($_GET['accion']) ? $_GET['accion'] : "Acción no especificada";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'limpiar_historial') {
    $limpiar_historial = "TRUNCATE TABLE historial_actividades";
    $conexion->exec($limpiar_historial);
}

if (isset($_SESSION['actividad_usuario'])) {
    $nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Usuario no autenticado";
    $actividad_realizada = $_SESSION['actividad_usuario'];

    $insertar_actividad = "INSERT INTO historial_actividades (usuario, actividad_realizada) VALUES (:usuario, :actividad_realizada)";
    $statement_insertar = $conexion->prepare($insertar_actividad);

    $statement_insertar->bindParam(':usuario', $nombre_usuario, PDO::PARAM_STR);
    $statement_insertar->bindParam(':actividad_realizada', $actividad_realizada, PDO::PARAM_STR);
    $statement_insertar->execute();

    unset($_SESSION['actividad_usuario']);
}

if ($accion === "Se eliminó el usuario") {
    $nombre_usuario_eliminado = obtenerNombreUsuarioEliminado($conexion, $accion);

    $insertar_actividad_eliminado = "INSERT INTO historial_actividades (usuario, actividad_realizada) VALUES (:usuario, :actividad_realizada)";
    $statement_insertar_eliminado = $conexion->prepare($insertar_actividad_eliminado);

    $statement_insertar_eliminado->bindParam(':usuario', $nombre_usuario, PDO::PARAM_STR);
    $statement_insertar_eliminado->bindParam(':actividad_realizada', $accion . ": $nombre_usuario_eliminado", PDO::PARAM_STR);
    $statement_insertar_eliminado->execute();
}

if (strpos($accion, "Sitio Desembarque") !== false) {
    $insertar_actividad_sitio_desembarque = "INSERT INTO historial_actividades (usuario, actividad_realizada) VALUES (:usuario, :actividad_realizada)";
    $statement_insertar_sitio_desembarque = $conexion->prepare($insertar_actividad_sitio_desembarque);

    $statement_insertar_sitio_desembarque->bindParam(':usuario', $nombre_usuario, PDO::PARAM_STR);
    $statement_insertar_sitio_desembarque->bindParam(':actividad_realizada', $accion, PDO::PARAM_STR);
    $statement_insertar_sitio_desembarque->execute();
}

if (strpos($accion, "Beneficiario") !== false) {
    $insertar_actividad_beneficiario = "INSERT INTO historial_actividades (usuario, actividad_realizada) VALUES (:usuario, :actividad_realizada)";
    $statement_insertar_beneficiario = $conexion->prepare($insertar_actividad_beneficiario);

    $statement_insertar_beneficiario->bindParam(':usuario', $nombre_usuario, PDO::PARAM_STR);
    $statement_insertar_beneficiario->bindParam(':actividad_realizada', $accion, PDO::PARAM_STR);
    $statement_insertar_beneficiario->execute();
}

$consulta_historial = "SELECT * FROM historial_actividades";
$resultado_historial = $conexion->query($consulta_historial);

function obtenerNombreUsuarioEliminado($conexion, $accion) {
    preg_match('/Se eliminó el usuario \'(.*)\'/', $accion, $matches);

    return isset($matches[1]) ? $matches[1] : "Usuario no especificado";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Actividades</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #ecf0f1;
        }

        h2 {
            color: #333;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #3498db;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #2980b9;
            color: white;
        }

        td {
            background-color: #3498db;
            color: white;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 15px;
            background-color: #2980b9; 
            color: white;
            border: none;
            border-radius: 25px; 
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px; 
        }

        .button-container button:last-child {
            margin-right: 0; 
        }

        .button-container button:hover {
            background-color: #1d5d8d;
        }
    </style>
</head>
<body>

    <h2>Historial de Actividades</h2>

    <form method="post" action="">
        <input type="hidden" name="accion" value="limpiar_historial">
        <div class="button-container">
            <button type="submit">Limpiar Historial</button>
            <button formaction="index.php" type="submit">Regresar a la Aplicación</button>
        </div>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Actividad Realizada</th>
            <th>Fecha Actividad</th>
        </tr>

        <?php
        while ($fila = $resultado_historial->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $fila['id'] . '</td>';
            echo '<td>' . $fila['usuario'] . '</td>';
            echo '<td>' . $fila['actividad_realizada'] . '</td>';
            echo '<td>' . $fila['fecha_actividad'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>

</body>
</html>























