<?php
include("../../db.php");

session_start(); 
if ($_POST) {
    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
    $correoelectronico = isset($_POST["correoelectronico"]) ? $_POST["correoelectronico"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios (id, usuario, correoelectronico, password) VALUES (NULL, :usuario, :correoelectronico, :password)");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":correoelectronico", $correoelectronico);
    $sentencia->bindParam(":password", $password);

    $sentencia->execute();

    $nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Usuario no autenticado";

    $accion = "Nuevo usuario creado "; 
    $_SESSION['actividad_usuario'] = $accion; 
    include("historial.php");

    $mensaje = "Registro agregado";
    header("Location:index.php?mensaje=" . $mensaje);
}
?>

<?php include("../../templates/header.php"); ?>

<br/>

<div class="card">
    <div class="card-header" style="background-color: #0066cc; color: white;">
        <h3> Datos del usuario </h3>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre del usuario">
            </div>
          

            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba la contraseña">
            </div>

            <div class="mb-3">
              <label for="correoelectronico" class="form-label">Correo electronico:</label>
              <input type="email"
                class="form-control" name="correoelectronico" id="correoelectronico" aria-describedby="helpId" placeholder="Escriba el correo electronico">
            </div>

  <div style="text-align: center; margin-top: 20px;">
                <button type="submit" class="btn btn-success" style="margin-right: 10px;">Agregar</button>
                <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>