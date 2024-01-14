<?php

$servidor="localhost";
$baseDeDatos="app";
$ususario="root";
$contraseña="";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$ususario,$contraseña);
}catch(Exception $ex){
    echo $ex‑>getMessage();
}

?>