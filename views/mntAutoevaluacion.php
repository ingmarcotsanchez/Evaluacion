<?php
define( "BASE_URL", "/Evaluacion/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
$usu_id = $_SESSION["usu_id"];
require_once("../models/Matriculas.php");
$matriculadas = new Matriculas();
$mat=$matriculadas->matriculacion($usu_id);
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>EAL | Autoevaluacion Institucional</title>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Mis Asignaturas</h3>
                        </div>
                        <div class="card-body">
                            <table id="autoevaluacion_data" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Materia</th>
                                        <th>Grupo</th>
                                        <th>Profesor</th>
                                        <th>Estado</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/mntAutoevaluacion.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
