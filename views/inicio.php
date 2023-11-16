<?php
define( "BASE_URL", "/Evaluacion/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
//require_once("../models/Carrera.php");


if(isset($_SESSION["usu_id"])){
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>EAL| Home</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <div class="row">
          <div class="col-12">
            <div class="callout callout-success">
              <h2> Bienvenido: <?php echo $_SESSION['usu_nombre']." ".$_SESSION["usu_apellidos"]; ?> </h2>
              Esta es una plataforma desarrollada por la <strong>Corporación Escuela de Artes y Letras Institución Universitaria </strong>con el fin de que realicen las evaluaciones correspondientes.                
            </div>
          </div><!-- /.col -->
        </div>
      </div>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php if($_SESSION["rol_id"] == 1):?>
          <div class="row">
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3 id="lbltotalProfesores"> </h3>

                  <p>Total de Profesores</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="lbltotalCarreras"> </h3>

                  <p>Total de Programas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 id="lbltotalEstudiantes"> </h3>

                  <p>Total de Estudiantes</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div> 
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="lbltotalActivos"> </h3>

                  <p>Total Activos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="lbltotalInactivos"> </h3>

                  <p>Total Inactivos</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-stalker"></i>
                </div>
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="lbltotalEvaProfesores"> </h3>

                  <p>AutoEvaluaciones Institucionales realizadas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div> 
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="lbltotalEvaEstudiantes"> </h3>

                  <p>Evaluaciones Institucionales realizadas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-plus"></i>
                </div>
              </div>
            </div>   
            <!-- ./col -->
          </div>
        <?php elseif($_SESSION["rol_id"]==2):?>
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?php echo $_SESSION["rol_nombre"];?> </h3>

                  <p>Rol</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3> <?php echo $_SESSION["snies"];?></h3>

                  <p>SNIES</p>
                </div>
              
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $_SESSION["car_id"];?> </h3>

                  <p>Programa</p>
                </div>
                
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-light">
                <div class="inner">
                  <h3><?php echo $_SESSION["usu_sede"];?> </h3>

                  <p>Sede</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>   
            <!-- ./col -->
          </div>
        <?php elseif($_SESSION["rol_id"]==3):?>
          <div class="row">
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $_SESSION["rol_nombre"];?> </h3>

                  <p>Rol</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $_SESSION["usu_sede"];?></h3>

                  <p>Sede</p>
                </div>
              </div>
            </div>  
            <!-- ./col -->
          </div>
        <?php else: ?>
          <div class="alert alert-danger">No es un ususario registrado</div>
        <?php endif; ?>
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
<script type="text/javascript" src="js/inicio.js"></script>


  
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
