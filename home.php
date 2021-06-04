<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width:80%
     border-radius: 20px;
}
</style>
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Bienvenido al <?php echo $_SESSION['setting_name']; ?></h3>
                        <hr class="divider my-4" />
                        <a class="btn btn-primary btn-xl js-scroll-trigger" href="index.php?page=predios">Seleccionar Predio</a>

                    </div>
                    
                </div>
            </div>
        </header>
	<section class="page-section" id="menu">
        
    </section>
    <div id="portfolio" class="container">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-12 text-center" style="background-color:lightyellow ; border-radius: 20px; " >
                    <h2 class="mb-4">PREDIOS ASOCIADOS</h2>

                    <hr class="divider">

                    </div>
                </div><br>
                <div class="row no-gutters">
                    <?php
                    $cats = $conn->query("SELECT * FROM medical_specialty order by id asc");
                                while($row=$cats->fetch_assoc()):
                    ?>
                    <div class="col-lg-4 col-sm-6" >
                        <a class="portfolio-box" href="index.php?page=predios&sid=<?php echo $row['id'] ?>" >
                            <img class="img-fluid" src="assets/img/<?php echo $row['img_path'] ?>" style=" border-radius: 20px; border-top: 5px" />
                            <div class="portfolio-box-caption">
                                <div class="project-name"><?php echo $row['name'] ?></div>
                                <div class="project-category text-white">Figurar Predios</div>
                            </div>
                        </a>
                    </div>
                    
                    <?php endwhile; ?>
                    <br>
                </div>
            </div>
        </div>
   
	
