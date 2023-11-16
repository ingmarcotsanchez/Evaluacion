<?php
define( "BASE_URL", "/Evaluacion/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>EAL | Perfil</title>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">
        <!-- Header -->
        <?php
            include("modulos/header.php");
        ?>
        <!-- /.Header -->

        <!-- Menú -->
        <?php
            include("modulos/menu.php");
        ?>
        <!-- /.Menú -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2"></div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Usuario</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_nombre">Nombre</label>
                                        <input type="text" class="form-control" name="usu_nombre" id="usu_nombre" placeholder="Ingrese su nombre" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_apellidos">Apellidos</label>
                                        <input type="text" class="form-control" name="usu_apellidos" id="usu_apellidos" placeholder="Ingrese su apellido" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_clave">Password</label>
                                        <input type="password" class="form-control" name="usu_clave" id="usu_clave" placeholder="Ingrese su clave">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_correo">Email</label>
                                        <input type="text" class="form-control" name="usu_email" id="usu_email" placeholder="Ingrese su correo" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_direccion">Dirección</label>
                                        <input type="text" class="form-control" name="usu_direccion" id="usu_direccion" placeholder="Ingrese su direccion">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_tel">Teléfono</label>
                                        <input type="text" class="form-control" name="usu_tel" id="usu_tel" placeholder="Ingrese su telefono">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary" id="btnactualizar">Actualizar</button>
                            </div>
                        <!-- /.card-body -->
                        </div>
                    <!-- /.row -->
                </div>
            </section>
        </div>
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php
    include("modulos/js.php");
    ?>
    <script type="text/javascript" src="js/perfil.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
