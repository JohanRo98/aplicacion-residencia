<?php
include("../../db.php");

session_start(); 

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia_nombre_usuario = $conexion->prepare("SELECT usuario FROM tbl_usuarios WHERE id = :id");
    $sentencia_nombre_usuario->bindParam(":id", $txtID);
    $sentencia_nombre_usuario->execute();
    $nombre_usuario_eliminado = $sentencia_nombre_usuario->fetchColumn();

    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Usuario no autenticado";

    $accion = "Se eliminó el usuario '$nombre_usuario_eliminado'";
    $_SESSION['actividad_usuario'] = $accion; 

    include("historial.php");

    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>

<br/>
<h3>Usuarios</h3>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="crear.php" role="button">Agregar usuario</a>
        <a name="" id="" class="btn" href="historial.php?accion=Clic en el botón de historial" role="button" style="background-color: #800080; border-color: #800080; color: #fff;">Historial de actividades</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del usuario</th>
                        <th scope="col">Correo electronico</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($lista_tbl_usuarios as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td><?php echo $registro['usuario']; ?></td>
                        <td><?php echo $registro['correoelectronico']; ?></td>
                        <td>********</td>
                        <td>
                            <a class="btn btn-warning" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
