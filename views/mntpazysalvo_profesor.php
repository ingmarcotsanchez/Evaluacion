<?php
define( "BASE_URL", "/Evaluacion/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
    $usuario = new Usuario();
    $usu = $usuario->listar();
    $usu_id = $_SESSION["usu_id"];
    
require_once("../models/Institucional.php");
    $institucional = new Institucional();
    $ins = $institucional->realizadas($usu_id);

if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>EAL | Certificados</title>
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
            <form method="post" action="Vistas/fpdf/certificado_institucional.php">
                <section class="content">
                    <div class="container-fluid">
                    <?php if($ins == NULL):?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class='bx bx-bell text-danger' style="font-size:24px ;"></i>
                                    Constancia de Evaluaciones Institucionales
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-danger">No ha realizado la evaluación Institucional</div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-check text-success"></i>
                                    Constancia de Evaluaciones Institucionales
                                </h3>
                            </div>
                            <div class="card-body">
    
                                <?php if($usu_id == $ins[1]["usu_id"] AND $_SESSION["rol_id"] == 3):?>
                                    <p>Estimado profesor <b><?php echo $_SESSION["usu_nombre"]." ".$_SESSION["usu_apellidos"] ;?></b> gracias por realizar la evaluación institucional de este semestre, por favor descargar el paz y salvo para entregar en la unidad correspondiente.</p>
                                    <button type="button" id="btnInstitucional" class="btn btn-primary">Desacargar su Certificado</button>
                                <?php else: ?>   
                                    <div class="alert alert-danger">No ha realizado todas las evaluaciones</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
                </section>
            </form>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/mntpazysalvo.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
