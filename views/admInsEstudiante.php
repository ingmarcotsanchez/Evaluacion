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
  <title>EAL | Preguntas Institucional</title>
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
                            <h3 class="card-title">Admón Preguntas Institucionales</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-primary mb-2" onclick="nuevo()">Crear Pregunta</button>
                            <button type="button" class="btn btn-outline-secondary mb-2" id="btnplantilla">Cargar Planilla</button>
                            <table id="pregInsEst_data" class="table display responsive wrap">
                                <thead>
                                    <tr>
                                        <th>Preguntas</th>
                                        <th>Estado</th>
                                        <th></th>
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
    <?php require_once("admInsEstudianteModal.php"); ?>
    <?php require_once("admInsEstudiantePlantilla.php"); ?>
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/admInsEstudiante.js"></script>
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
