
<?php
  /*TODO: Llamando Cadena de Conexion */
  require_once("config/conexion.php");

  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuario.php");
    /*TODO: Inicializando Clase */
    $usuario = new Usuario();
    $usuario->login();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EAL | LOGIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="html/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="html/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="html/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="views/css/login.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login">
      <div class="content">
          <img src="views/images/logo.png" alt="Logo institucional">
      </div>
      <div class="login-form">
          <h2 class="title">Evaluaciones</h2>
                                              
          <form id="form1" name="form1" action="" method="post">
                <?php
                if(isset($_GET["m"])){
                  switch($_GET["m"]){
                    case "1";
                      ?>
                      <div class="alert alert-danger" role="alert">
                        Los datos ingresados son incorrectos!
                      </div>
                      <?php
                      break;
                    case "2";
                      ?>
                        <div class="alert alert-warning" role="alert">
                          El formulario tiene los campos vacios!
                        </div>
                      <?php
                      break;
                  }
                }
              ?>
              <div class="input-field">
                  <i class='bx bxs-user'></i>
                  <input type="text" name="usuario" id="usuario" text_blanco="blanco" placeholder="Ingrese su usuario" autocomplete="off"/>
              </div>
              <div class="input-field">
                  <i class='bx bxs-lock-alt'></i>
                  <input type="password" name="passwd" id="passwd" placeholder="Ingrese su contraseña" />
    </div>
    <input type="hidden" name="enviar" class="form-control" value="si">
            <button type="submit" class="btn btn-block">Acceder</button>
          </form>
      </div>
  </div>

  <!-- /.login-logo -->
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="html/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="html/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="html/dist/js/adminlte.min.js"></script>
</body>
</html>
