<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>

    <!-- CDN LIBRERIAS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
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
                            <li><a class="dropdown-item" href="<?php echo base_url('index.php/cnt_prueba/logout') ?>">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- FIN DE NAVBAR -->

    <h3 style="text-align: center; padding-top: 1em; padding-bottom: 1em;">LISTA DE USUARIOS</h3>

    <!-- INICIO DE TABLA -->
    <div class="container">
        <a href="<?php echo base_url('index.php/cnt_prueba/registro') ?>">
            <i class="bi bi-plus-square-fill" style="font-size: 2em;"></i>
        </a>
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Perfil</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $rw) { ?>
                    <tr>
                        <td><?php echo $rw->id_perso; ?></td>
                        <td><?php echo $rw->nombre; ?></td>
                        <td><?php echo $rw->apellido; ?></td>
                        <td><?php echo $rw->nick_name ?></td>
                        <td><?php echo $rw->perfil ?></td>
                        <td><?php echo $rw->correo; ?></td>
                        <td><?php echo $rw->estado; ?></td>
                        <td style="text-align: center;">
                            <?php if ($rw->estado == 0) { ?>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#validateModal" data-bs-idUser="<?php echo $rw->id_user; ?>" data-bs-usuario="<?php echo $rw->nick_name; ?>">
                                    <i style="color: green;" class="bi bi-check2-square"></i>
                                </a>
                            <?php } ?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-idUser="<?php echo $rw->id_user; ?>" data-bs-idPerso="<?php echo $rw->id_perso; ?>" data-bs-usuario="<?php echo $rw->nick_name; ?>">
                                <i style="color: red;" class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- FIN DE TABLA -->

    <!-- INICIO DEL MODAL -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="eliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var deleteModal = document.getElementById('deleteModal')

        var idUser;
        var idPerso;
        var usuario;
        var button;

        deleteModal.addEventListener('show.bs.modal', function(event) {
            button = event.relatedTarget

            idUser = button.getAttribute('data-bs-idUser')
            idPerso = button.getAttribute('data-bs-idPerso')
            usuario = button.getAttribute('data-bs-usuario')

            var modalTitle = deleteModal.querySelector('.modal-title')
            var modalBodyInput = deleteModal.querySelector('.modal-body input')

            modalTitle.textContent = '¿Seguro que desea eliminar a [' + usuario + ']?'
        })

        document.getElementById('eliminar').addEventListener("click", funcionEliminar)

        function funcionEliminar() {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/cnt_prueba/del_registro/" + idUser + "/" + idPerso,
                context: document.body
            }).done(function(res) {
                console.log(res)
                $("#deleteModal").modal('hide');
                $(button).parent().parent().remove();
                location.reload();
            });
        }
    </script>

    <div class="modal fade" id="validateModal" tabindex="-1" aria-labelledby="validateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="validateModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="validar">Validar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var validateModal = document.getElementById('validateModal')

        var idUser;
        var usuario;
        var button;

        validateModal.addEventListener('show.bs.modal', function(event) {
            button = event.relatedTarget

            idUser = button.getAttribute('data-bs-idUser')
            idPerso = button.getAttribute('data-bs-idPerso')
            usuario = button.getAttribute('data-bs-usuario')

            var modalTitle = validateModal.querySelector('.modal-title')
            var modalBodyInput = validateModal.querySelector('.modal-body input')

            modalTitle.textContent = '¿Deseas validar el acceso para [' + usuario + ']?'
        })

        document.getElementById('validar').addEventListener("click", funcionValidar)

        function funcionValidar() {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/cnt_prueba/valid_user/" + idUser,
                context: document.body
            }).done(function(res) {
                $("#validateModal").modal('hide');
                $(button).remove();
                location.reload();
            });
        }
    </script>
    <!-- FIN DEL MODAL -->
</body>

</html>