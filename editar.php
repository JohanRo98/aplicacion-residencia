<?php 
include("../../db.php");

session_start(); 

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id = :id");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correoelectronico = $registro["correoelectronico"];

}

if ($_POST) {
    $txtID = isset($_POST["txtID"]) ? $_POST["txtID"] : "";
    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
    $correoelectronico = isset($_POST["correoelectronico"]) ? $_POST["correoelectronico"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario, correoelectronico=:correoelectronico, password=:password WHERE id=:id");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":correoelectronico", $correoelectronico);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":id", $txtID);

    $sentencia->execute();

    $nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Usuario no autenticado";

    $accion = "Se editó un usuario"; 
    $_SESSION['actividad_usuario'] = $accion; 

    include("historial.php");

    $mensaje = "Registro actualizado";
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
          <label for="txtID" class="form-label">ID:</label>
          <input type="text"
          value="<?php echo $txtID;?>"
            class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" 
                value="<?php echo $usuario;?>"
                class="form-control" name="usuario" id="usuario" placeholder="Nombre del usuario">
            </div>
          

            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password"
              value="<?php echo $password;?>"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba la contraseña">
            </div>

            <div class="mb-3">
              <label for="correoelectronico" class="form-label">Correo electronico:</label>
              <input type="email"
              value="<?php echo $correoelectronico;?>"
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