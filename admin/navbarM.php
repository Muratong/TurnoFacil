 
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>|  |</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3 -->
    <script src="https://kit.fontawesome.com/37483315ca.js" crossorigin="anonymous"></script>
    <!-- para agregar color en la barra -->
 <!-- jQuery 3 -->
  <script src="./public/jquery/dist/jquery.min.js"></script>

 <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="./public/bootstrap/dist/css/bootstrap.min.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="./public/bootstrap/dist/css/_all-skins.min.css">

    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="./public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="./public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="./public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="./public/datatables/jquery.dataTables.min.css">    
    <link href="./public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="./public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="./public/css/bootstrap-select.min.css">

  </head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Load Facebook SDK for JavaScript -->



  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
<div class="user-panel" >
        <div class="pull-left ">
          <img src="" class="img-circle" style="width: 50px; height: 50px;" alt="">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['login_name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
      <li style="background-color: black " class="header" >MENÚ DE NAVEGACIÓN</li>
    
       <li ><a href="index.php?page=home"><i class="fas fa-home"></i> &nbsp;<span><b>INICIO</b></span><small class="label pull-right bg-yellow">inicio</small></a></li>
       <li ><a href="index.php?page=appointments"><i class="fas fa-calendar"></i> &nbsp;<span><b>TURNO</b></span><small class="label pull-right bg-yellow">turno</small></a></li>
        <li ><a href="index.php?page=predios"><i class="fas fa-home"></i> &nbsp;<span><b>PREDIOS</b></span><small class="label pull-right bg-yellow">predios</small></a></li>
       <li ><a href="index.php?page=categories"><i class="fas fa-futbol"></i> &nbsp;<span><b>TIPO CANCHA</b></span><small class="label pull-right bg-yellow">tipo</small></a></li>

          <?php
             if($_SESSION['login_type'] == 2): ?>
            <li style="background-color:black" class="header" ><strong>MENÚ DE CONTROL PREDIOS</strong></li>

          <li class="treeview">
          <a href="index.php?page=canchas">
            <i class="fa fa-futbol"></i> <span>Mis canchas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> 
          </a>
        </li>
          <li class="treeview">
          <a href="index.php?page=configuracion">
            <i class="fa fa-smile-o"></i> <span>Configuracion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
          <?php endif; ?>
    

        <?php if($_SESSION['login_type'] == 1) {
?>
          
          <li class="treeview" >
          <a href="index.php?page=users">
            <i class="fa fa-users"></i>&nbsp; <span><b>Usuarios</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           </li>
           <li class="treeview" >
          <a href="index.php?page=site_settings">
            <i class="fa fa-cogs"></i>&nbsp; <span><b>Configuracion</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           </li>
      
       
<?php } ?>
       <li ><a href="http://jbzeus.com/tienda/index.php?view=soporte"><i class="fa  fa-exclamation-circle"></i> <span>Acerca de</span><small class="label pull-right bg-yellow"></small></a></li>   
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>