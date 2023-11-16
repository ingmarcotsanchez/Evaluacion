<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL; ?>inicio.php" class="brand-link">
      <span class="brand-text font-weight-dark">ADMON-EAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"] ?>">
          <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>">
          <a href="#" class="d-block"><?php echo $_SESSION["usu_nombre"]." ".$_SESSION["usu_apellidos"] ;?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">INFORMACIÓN</li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>inicio.php" class="nav-link">
              <i class="fa fa-home text-warning nav-icon"></i>
              <p>Inicio</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>perfil.php" class="nav-link">
              <i class="nav-icon text-warning fas fa-table"></i>
              <p>Perfil</p>
            </a>
          </li>
          <!--Menú Administradores-->
          <?php if($_SESSION["rol_id"] == 1): ?>
          <li class="nav-header">BÁSICAS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-warning"></i>
              <p>
                Administración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admPeriodo.php" class="nav-link">
                <i class="nav-icon text-warning fas fa-th"></i>
                  <p>Periodos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admRol.php" class="nav-link">
                  <i class="far fa-user text-warning nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admUsuario.php" class="nav-link">
                  <i class="far fa-user text-warning nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admCarreras.php" class="nav-link">
                  <i class="far fa-circle text-warning nav-icon"></i>
                  <p>Carreras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admAsignaturas.php" class="nav-link">
                  <i class="far fa-circle text-warning nav-icon"></i>
                  <p>Asignaturas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admMatriculas.php" class="nav-link">
                  <i class="far fa-circle text-warning nav-icon"></i>
                  <p>Matriculas</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-header">EVALUACIONES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-success"></i>
              <p>
                Institucional
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admInsEstudiante.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Preg. Estudiantes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>resInsEstudiante.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Res. Estudiantes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admInsProfesor.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Preg. Docentes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>resInsProfesor.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Res. Docentes</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-success"></i>
              <p>
                Autoevaluación
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admEvaEstudiante.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Preg. Estudiantes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>resEvaEstudiante.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Res. Estudiantes</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">REPORTES</li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>reportes.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">General</p>
            </a>
          </li>
          <!--Menú Estudiantes-->
          <?php elseif($_SESSION["rol_id"] == 2): ?>
          <li class="nav-header">EVALUACIONES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-success"></i>
              <p>
                Institucional
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>mntInsEstudiante.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Eva. Institucional</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-success"></i>
              <p>
                Autoevaluación
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>mntAutoEvaluacion.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Eva. Autoevaluación</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">CERTIFICADOS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-success"></i>
              <p>
                Paz y Salvos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>mntpazysalvo_estudiante.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Certificado</p>
                </a>
              </li>
            </ul>
          </li>
          <!--Menú Profesores-->
          <?php else: ?> 
            <li class="nav-header">EVALUACIONES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-success"></i>
              <p>
                Institucional
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>mntInsProfesor.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Eva. Institucional</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">CERTIFICADOS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-success"></i>
              <p>
                Paz y Salvos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>mntpazysalvo_profesor.php" class="nav-link">
                  <i class="far fa-circle text-success nav-icon"></i>
                  <p>Certificado</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <li class="nav-header">LOGOUT</li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>Logout.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Salir</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>