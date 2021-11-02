<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- CDN LIBRERIAS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- INICIO DE NAVBAR -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PRUEBA TECNICA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?php echo $this->session->userdata('nick_name') ?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('index.php/cnt_prueba/logout')?>">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- FIN DE NAVBAR -->

    <h3 style="text-align: center; padding-top: 1em; padding-bottom: 1em;">REGISTRO</h3>

    <!-- INICIO DEL FORMULARIO -->
    <div class="container">
        <form action="" method="post">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="">
                <label for="apellido">Apellido</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" name="email" id="email" placeholder="">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="">
                <label for="usuario">Nombre de usuario</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="">
                <label for="pwd">Password</label>
            </div>
            <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
            <button type="submit" class="btn btn-secondary" name="regresar">Regresar</button>
        </form>
    </div>
    <!-- FIN DEL FORMULARIO -->
</body>

</html>