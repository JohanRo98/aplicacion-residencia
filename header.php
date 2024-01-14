<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$url_base = "http://localhost/app/";

if (!isset($_SESSION['usuario'])) {
    header("Location: " . $url_base . "/login.php");
}
?>


<!doctype html>
<html lang="es">

<head>
  <title>Title</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>

  <nav class="navbar navbar-expand-lg" style="background-color: #3498db;">
    <a class="navbar-brand text-white" href="<?php echo $url_base;?>" style="font-size: 24px; font-family: 'Arial', sans-serif;">
        <i class="fas fa-fish"></i> PescaNet
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo $url_base;?>apartados/beneficiarios/" style="font-weight: bold;">
                    <i class="fas fa-users"></i> Beneficiarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo $url_base;?>apartados/sitio desembarque/" style="font-weight: bold;">
                    <i class="fas fa-map-marker-alt"></i> Sitio Desembarque
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo $url_base;?>apartados/usuarios/" style="font-weight: bold;">
                    <i class="fas fa-user"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo $url_base;?>cerrar.php" style="font-weight: bold;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>
</nav>


  <main class="container">

  <?php if(isset($_GET['mensaje'])) {  ?>
<script>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
</script>
<?php } ?>