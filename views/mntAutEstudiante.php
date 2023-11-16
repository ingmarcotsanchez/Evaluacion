<?php
define( "BASE_URL", "/Evaluacion/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
    $usuario = new Usuario();
    $usu = $usuario->listar();
    $usu_id = $_SESSION["usu_id"];

require_once("../models/Asignaturas.php");
    $asignaturas = new Asignatura();
    $mat = $asignaturas->asignaturas();

require_once("../models/EvaEstudiante.php");
    $pregAutEst = new EvaEstudiante();
    $preEvaEst = $pregAutEst->evaEstudiantesAct();

require_once("../models/REvaEstudiante.php");
    $respEvaEst = new REvaEstudiante();
    $resEvaEst = $respEvaEst->revaEstudiantesAct();

require_once("../models/Autoevaluacion.php");
    $autoevaluacion = new Autoevaluacion();
    $aut = $autoevaluacion->evaluaciones();

if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>EAL | Evaluación</title>
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
            <form method="post" id="autoevaluacion_form">
                <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $usu_id; ?>">
                <!--<input type="hidden" name="mat_id" id="mat_id">-->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="card">
                                <?php
                                for($i=0;$i<sizeof($preEvaEst);$i++):
                                    $id = $resEvaEst[$i]["rea_id"];
                                ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $preEvaEst[$i]["pea_id"]." ".$preEvaEst[$i]["pea_pregunta"] ?></h3>
                                </div>
                                <div class="card-body">
                                <?php
                                    for($j=0;$j<sizeof($resEvaEst);$j++):
                                ?>
                                    <?php if($preEvaEst[$i]["pea_id"] == $resEvaEst[$j]["pea_id"]): ?>
                                        <input type="radio" name="auto_respuesta_<?php echo $preEvaEst[$i]["pea_id"] ?>" id="auto_respuesta_<?php echo $preEvaEst[$i]["pea_id"] ?>" value="<?php echo $preEvaEst[$i]['pea_pregunta']."-".$resEvaEst[$j]['rea_respuesta'] ; ?>" required> <?php echo $resEvaEst[$j]["rea_respuesta"]; ?>
                                    <?php endif; ?>
                                <?php
                                    endfor;
                                ?>
                                </div>
                                <?php
                                    endfor;
                                ?>
                            </div>
                        </div>
                    </section>
                <div class="card">
                <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
                
            </form>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/mntAutEstudiante.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
