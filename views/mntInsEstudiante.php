<?php
define( "BASE_URL", "/Evaluacion/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
    $usuario = new Usuario();
    $usu = $usuario->listar();
    $usu_id = $_SESSION["usu_id"];
require_once("../models/InsEstudiante.php");
    $pregInsEst = new InsEstudiante();
    $preInsEst = $pregInsEst->insEstudiantesAct();
require_once("../models/RInsEstudiante.php");
    $respInsEst = new RInsEstudiante();
    $resInsEst = $respInsEst->rinsEstudiantesAct();
require_once("../models/Institucional.php");
    $institucional = new Institucional();
    $ins = $institucional->evaluaciones();

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
            
            <?php if($ins == NULL):?>
                <form method="post" id="evaInstitunal_form">
                    <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $usu_id; ?>">
                                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="card">
                                <?php
                                for($i=0;$i<sizeof($preInsEst);$i++):
                                    $id = $resInsEst[$i]["rei_id"];
                                    //print_r($id);
                                ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $preInsEst[$i]["pei_id"]." ".$preInsEst[$i]["pei_pregunta"] ?></h3>
                                </div>
                                <div class="card-body">
                                <?php 
                                    for($j=0;$j<sizeof($resInsEst);$j++): 
                                ?>
                                    <?php if($preInsEst[$i]["pei_id"] == $resInsEst[$j]["pei_id"]): ?>
                                        <input type="radio" name="eva_respuesta_<?php echo $preInsEst[$i]["pei_id"] ?>" id="eva_respuesta_<?php echo $preInsEst[$i]["pei_id"] ?>" value="<?php echo $preInsEst[$i]['pei_pregunta']."-".$resInsEst[$j]['rei_respuesta'] ; ?>" required><?php echo $resInsEst[$j]["rei_respuesta"]; ?>
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
                        <button type="submit" name="action" value="add" class="btn btn-primary">Enviar Respuestas</button>
                    </div>
                    
                </form>
            <?php else: ?>
                <?php if($usu_id == $ins[1]["usu_id"]):?>
                    <div class="alert alert-danger">Ya ha realizado la evaluación!</div>
                <?php else: ?>
                    <form method="post" id="evaInstitunal_form">
                    <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $usu_id; ?>">
                                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="card">
                                <?php
                                for($i=0;$i<sizeof($preInsEst);$i++):
                                    $id = $resInsEst[$i]["rei_id"];
                                    //print_r($id);
                                ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $preInsEst[$i]["pei_id"]." ".$preInsEst[$i]["pei_pregunta"] ?></h3>
                                </div>
                                <div class="card-body">
                                <?php for($j=0;$j<sizeof($resInsEst);$j++): ?>
                                    <?php if($preInsEst[$i]["pei_id"] == $resInsEst[$j]["pei_id"]): ?>
                                        <input type="radio" name="eva_respuesta_<?php echo $preInsEst[$i]["pei_id"] ?>" id="eva_respuesta_<?php echo $preInsEst[$i]["pei_id"] ?>" value="<?php echo $preInsEst[$i]['pei_pregunta']."-".$resInsEst[$j]['rei_respuesta'] ; ?>"><?php echo $resInsEst[$j]["rei_respuesta"]; ?>
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
                        <button type="submit" name="action" value="add" class="btn btn-primary">Enviar Respuestas</button>
                    </div>
                    
                </form>
                <?php endif;?>
                
            <?php endif;?>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/mntInsEstudiante.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
