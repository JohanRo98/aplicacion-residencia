<?php

$host = "127.0.0.1"; 
$usuario = "root"; 
$contrasena = ""; 
$base_datos = "app";

$ruta_respaldo = 'C:/Users/johan/OneDrive/Documentos/Respaldos/';

$archivo_respaldo = $ruta_respaldo . 'respaldo_' . date('Y-m-d_H-i-s') . '.sql';

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

$tablas = $conexion->query('SHOW TABLES');
while ($fila = $tablas->fetch_row()) {
    $nombre_tabla = $fila[0];
    $resultado = $conexion->query("SELECT * FROM $nombre_tabla");
    $columnas = $resultado->fetch_fields();
    
    $sql = "DROP TABLE IF EXISTS $nombre_tabla;\n";
    $sql .= "CREATE TABLE $nombre_tabla (\n";
    
    foreach ($columnas as $columna) {
        $sql .= "`$columna->name` $columna->type";
        if ($columna->length) {
            $sql .= "($columna->length)";
        }
        $sql .= ",\n";
    }
    
    $sql = rtrim($sql, ",\n");
    $sql .= "\n);\n";
    
    while ($datos = $resultado->fetch_assoc()) {
        $sql .= "INSERT INTO $nombre_tabla VALUES (";
        foreach ($datos as $valor) {
            $sql .= "'" . $conexion->real_escape_string($valor) . "',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ");\n";
    }

    file_put_contents($archivo_respaldo, $sql, FILE_APPEND);
}

$conexion->close();

header("Location: exito.php");
exit(); 
?>




