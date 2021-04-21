<?php 
date_default_timezone_set('America/Argentina/La_Rioja');
setlocale(LC_TIME, 'Spanish');

$fecha=date("d-m-y");
     echo UTF8_encode(strftime("%A %#d de %B del %Y"));
   ?>
     <script src="js/turno.js" ></script>

<header class="masthead">

   <div class="container h-10">
   <div class="row h-10 align-items-center justify-content-center text-center">
    <div class="col-lg-10 align-self-end mb-4 page-title">
    <h3 class="text-white">Reserva tu hora en <?php echo $_SESSION['setting_name']; ?></h3>
   <hr class="divider my-4" />
   <a class="btn btn-primary btn-xl js-scroll-trigger" href="index.php?page=doctors">Ver  Los  Predios</a>

                    </div>
                    
                </div>
            </div>
        </header>
        <div><br></div>
<div class="container">
	<?php include'sidebar.php';?>
		<div class="col-xs-12 col-sm-9">
			<!--<div class="jumbotron">-->
				<div class="">
					<div class="panel panel-default">
						<div class="panel-body">	
							<fieldset>
								<p class="bg-warning">
							
									<?php 
									?>
									<div class="alert alert-info" ><strong><a style="color: green">  SELECIONADA :</a> <?php echo "".$row['name'].', '.$row['name_pref'] ?></strong> / Elija tu cancha </div>
									</p>
					<?php ?>

								<?php 
					$where = '';
					if($_SESSION['login_type'] == 2)
						$where = " where doctor_id = ".$_SESSION['login_doctor_id'];

					if(isset($_GET['id'])){
	$predio = $conn->query("SELECT * FROM canchas where doctor_id =".$_GET['id']);
}
					while($row = $predio->fetch_assoc()):
					?>

        <div style="float:left; width:370px; margin-left:10px;">
				<div style="float:left; width:70px; margin-bottom:10px;">

					 <img src="./assets/imagenes/<?php echo $row['imagen'] ?>" width="100px" height="150px" style="-webkit-border-radius:5px; -moz-border-radius:5px;"title="<?php echo " ".$row['nombre'] ?>" class=" set_appointment" type="button"  data-id="<?php echo $row['id'] ?>" data-doctor_id="<?php echo $row['doctor_id'] ?>"  data-name="<?php echo "".$row['nombre'] ?>"/>
							</div>	
				
				<div style="float:right; height:125px; width:250px; margin:0px; color:#000033;">
					<form name=""  method="POST" action="">
						<br/>
						<input type="hidden" name="canchas" value="<?php echo " ".$row['id'] ?>"/>
				  		<p><strong>Pista =><a style="color: red"><?php echo " ".$row['nombre'] ?></a><br/> 
		  						
					<div class="form-group">
						<div class="row">
						  <div class="col-xs-12 col-sm-12">
						     <button class="btn-outline-primary  btn  mb-8 reservar" type="button"  data-id="<?php echo $row['id'] ?>" data-doctor_id="<?php echo $row['doctor_id'] ?>"  data-name="<?php echo "".$row['nombre'] ?>" >Reservar</button>
																           				     
							           			 </div>
							            	</div>
							            </div>
							
				  		 </form>
				  	</div>
				</div>
			<?php endwhile; ?>
					</fieldset>	
				</div>
			</div>	
		</div>
	</div>
</div>
<style>
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:300px;
		max-height: :150px;
	}
</style>
<script>
	
	$('.reservar').click(function(){
       
			uni_modal("Sacar tu turno: "+$(this).attr('data-name'),"consultar_horarios.php?id="+$(this).attr('data-id'),'')
		
		})
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-turno').get(0).reset();
	}
</script>