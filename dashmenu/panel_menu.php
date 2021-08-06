<?php

session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../../index.php");
}

include_once('../bd/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "CALL sp_consulta_menu_usuario(?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0,$_SESSION["i_usuaid"]));
$menu = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_consulta_menu_padre(?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0,$_SESSION["i_usuaid"]));
$padremenu = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SoftCob</title>
        <link rel="icon" type="image/png" href="../images/logo.png" >
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../vendor/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../vendor/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        
        <link rel="stylesheet" href="../vendor/plugins/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" type="text/css" href="../vendor/plugins/select2/css/select2.css">
        <link rel="stylesheet" href="../vendor/plugins/alertify/css/alertify.min.css"> 
        <link rel="stylesheet" href="../vendor/plugins/jquery-ui/jquery-ui.min.css">

        <link rel="stylesheet" href="../vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../vendor/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../vendor/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">    

        <link rel="stylesheet" href="../vendor/dist/css/adminlte.min.css">  
        <link rel="stylesheet" href="../css/estilos.css">    
    </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="clearfix"></div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalClose" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #007bff; color:white;">
                    <h5 id="exampleModalLabel">Desea Cerrar la Sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione Cerrar, para Salir de la Sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index.php">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

   <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Opciones superior izquierda -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="../vendor/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nombre de Usuario
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Mensaje_1</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Describir Mensaje</p>
                </div>                
              </div>
            </a>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="../vendor/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Usuario 2
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Mensaje_2</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Describir Mensaje</p>
                </div>
              </div>
            </a>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="../vendor/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Usuario 3
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Mensaje_3</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Describir Mensaje</p>
                </div>
              </div>
            </a>

            <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Podemos Quitar esto</a>
          </div>
        </li>
          <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">Mostrar Notificaciones</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> Numero de mensajes
                <span class="float-right text-muted text-sm">Minutos del mensaje</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> Mas Notificaciones
                <span class="float-right text-muted text-sm">tiempo de la notificacion</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> Otros Reportes
                <span class="float-right text-muted text-sm">Tiempo de reportes</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">Acción Ver mas notificaciones</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="#">
              <i class="fas fa-power-off"></i>
            </a>
            <!-- <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal" href="#">
                    <i class="fas fa-sign-out-alt" style="color:red"></i><span style="color:blue"> Cerrar Sesión</span>  
                </a>
            </div>-->
        </li>
      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../dashmenu/panel_content.php" class="brand-link">
        <img src="../vendor/dist/img/LogoBBP.png" alt="Logo BPP" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SoftCob</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">            
            <img src="<?php echo $_SESSION["s_foto"] ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION["s_usuario"] ?></a>
          </div>
        </div>

        <!-- FORMAR MENU DINAMICO BDD -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <?php
              $tempmenu = null;
              $menusuperior = null;
              foreach($menu as $menurow)
              {
                if($menurow["CodigoMenuPadre"] == null)
                {
                  if($tempmenu != $menurow["MenuId"])
                  {
                    echo "<li class='nav-item'>";
                    echo "<a href='#' class='nav-link'>";
                    echo "<i class='" . "nav-icon " . $menurow['IconoMenu'] . "'></i>";                    
                    echo "<p>" . $menurow["Menu"];
                    echo "<i class='right fas fa-angle-left'></i>";
                    echo "</p></a>";
                    echo "<ul class='nav nav-treeview'>";
                    foreach($menu as $submenu)
                    {
                      if($submenu["MenuId"] == $menurow["MenuId"])
                      {
                        echo "<li class='nav-item'>";
                        echo "<a href='" . $submenu["Accion"] . "'class='nav-link'>";
                        echo "<i class='" . $submenu["IconoTarea"] . "'></i> ";
                        echo "<p>" . $submenu["Tarea"] . "</p>";
                        echo "</a></li>";
                      }
                    }
                    echo "</ul></li>";
                  }
                }
                else
                {
                  if($menusuperior != $menurow['CodigoMenuPadre'])
                  {
                    echo "<li class='nav-item'>";
                    echo "<a href='#' class='nav-link'>";
                    echo "<i class='" . "nav-icon " . $menurow['IconoMenu'] . "'></i>";                    
                    echo "<p>" . $menurow["Menu"];
                    echo "<i class='right fas fa-angle-left'></i>";
                    echo "</p></a>";
                    $tempmenu = null;
                    $menumain = $row['CodigoMenuPadre'];
                    echo "<ul class='nav nav-treeview'>";
                    foreach($menu as $menuinicio){
                      if($menuinicio['CodigoMenuPadre'] == $menumain){
                        if($tempmenu != $menuinicio['MenuId'])
                        {
                          echo "<li class='nav-item'>";
                          echo "<a href='#' class='nav-link'>";
                          echo "<i class='" . "nav-icon " . $menuinicio['IconoMenu'] . "'></i>";                    
                          echo "<p>" . $menuinicio["Menu"];
                          echo "<i class='right fas fa-angle-left'></i>";
                          echo "</p></a>"; 
                        }
                        $tempmenu = $menurow['MenuId'];
                      }
                    }
                    echo "</ul></li>";                                        
                  }
                }
                $tempmenu = $menurow['MenuId'];
                $menusuperior = $menurow['CodigoMenuPadre'];                
              }
            ?>
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>


