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
  <title>EAL | Reportes</title>
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
                            <h3 class="card-title">Generación de Reportes</h3>
                        </div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-12">
                                    <!-- Custom Tabs -->
                                    <div class="card">
                                        <div class="card-header d-flex p-0">
                                            <h3 class="card-title p-3">Evaluaciones de los Usuarios</h3>
                                            <ul class="nav nav-pills ml-auto p-2">
                                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Institucional</a></li>
                                                <!--<li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Institucional Estudiantes</a></li>-->
                                                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Autoevaluación</a></li>
                                            </ul>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    <form method="post" action="Vistas/fpdf/reporte_institucional.php">
                                                        <button class="btn btn-info btn-lg" type="submit"><i class="fas fa-table"></i> Institucional Resultados</button>
                                                    </form>
                                                </div>
                                                <!--<div class="tab-pane" id="tab_2">
                                                    <form method="post" action="Vistas/fpdf/reporte_institucional_estudiante.php">
                                                        <button class="btn btn-success btn-lg" type="submit"><i class="fas fa-download"></i> Descargar Resultados</button>
                                                    </form>
                                                </div>-->
                                                <div class="tab-pane" id="tab_3">
                                                    <form method="post" action="Vistas/fpdf/reporte_autoevaluacion.php">
                                                        <button class="btn btn-warning btn-lg" type="submit"><i class="fas fa-table"></i> Autoevaluación Resultados</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <?php require_once("resEvaEstudianteModal.php"); ?>
    <?php require_once("resEvaEstudiantePlantilla.php"); ?>
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/resEvaEstudiante.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
