<head class="main">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav"  style="padding:0;background: lightgreen ">
   
   <div class="container" >
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon" ></span></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto my-2 my-lg-0">

     <li class="treeview" >
        <a href="index.php?page=home" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-home"></i></span> Inicio</a>
      </li>
       <li class="treeview" >
        <a href="index.php?page=appointments" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-calendar"></i></span> Turnos</a> 
      </li>
       <li class="treeview" >
        <a href="index.php?page=predios" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-home"></i></span> Predios</a>
      </li>
       <li class="treeview" >
        <a href="index.php?page=categories" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-futbol"></i></span> Tipos Canchas</a>
        </li> 
<?php if($_SESSION['login_type'] == 2): ?>
   <li class="treeview" >
        <a href="index.php?page=canchas" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-futbol"></i></span> Mis canchas</a>
      </li>
       <li class="treeview" >
        <a href="index.php?page=configuracion" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-cog"></i></span> Configuracion</a>
      </li>   
<?php endif; ?>
        <?php if($_SESSION['login_type'] == 1): ?>
      <li class="treeview" >
        <a href="index.php?page=users" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-users"></i></span> Usuarios</a>
      </li>
       <li class="treeview" >
        <a href="index.php?page=site_settings" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fa fa-cog"></i></span> Configuracion</a>
      </li>
      <?php endif; ?>
      <li class="treeview">
      	<a href="ajax.php?action=logout" class="nav-link js-scroll-trigger"><span class="pull-right-container"><i class="fas fa-power-off"></i></span>&nbsp; Salir</a>
      </li>
     
  </ul>

</div>
</div>
</nav>
</head>
    
