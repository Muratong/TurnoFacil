<?php 
	//include "inc/header.php"; 
	include ('admin/db_connect.php');
    include ('includes/database.php');
	
?>
<?php 
	// error_reporting(0);
	if (isset($_POST['dt'])){
		$dt=$_POST['dt'];
	}
if (isset($_POST['cancha'])){
	$cancha=$_POST['cancha']; 
}
?>
	<div class="container-fluid">		
		<div class="card-body">
		<div class=" pull-right">
		<h4  style="font-size: 14px; color:green"><strong style="color: black"> Fecha elegida</strong>:  <?php echo date('d-m-Y', strtotime($dt)) ; ?></h4>
				</div>
				
					
<?php 

      $date = date('Y-m-d');
	          $mydb->setQuery("SELECT * FROM horarios WHERE id_canchas=".$cancha);
	         
	         $cur = $mydb->loadResultList();
	          				//$row=$consulta->fetch_assoc();
			foreach ($cur as $result) {
				$mydb->setQuery("SELECT status FROM appointment_list  
					WHERE(('$date'>= schedule
				    and '$date'<= schedule)
                    OR ('$dt'>=schedule 
                    and '$dt'<=schedule)
                    OR (schedule>='$date'
                    and schedule<='$dt'
                      )
                     )
                   and id_horario =".$result->id);

				$stats = $mydb->executeQuery();
				 $rows = mysqli_fetch_assoc($stats);
				
				 echo '<div style="float:left; width:130px; margin-left:25px;">';
				 echo '<div style="float:left; width:50px; margin-bottom:2px;">';
				 echo '</div>';	
				 echo '<div style="float:right; height:35px; width:170px; margin:0px; color:#000033;">';
						//Aqui empieza el formulario de datos
					
					
				  		
		        $status=$rows['status'];
				if($status=='0'){
				echo '
			    <div class="form-group">
				<div class="col-md-4">
					<div class="col-xs-4 col-sm-4">
		             <input type="button" class="btn btn-danger btn-sm" name="" value="Reservado"/>		</div>
					 </div>
				</div>
				    ';
							}elseif($status=='1'){
			    echo '
			    <div class="form-group">
				<div class="col-md-4">
					<div class="col-xs-4 col-sm-4">
		             <input type="button" class="btn btn-danger btn-sm" name="" value="Confirmado"/>		</div>
					 </div>
				</div>
				    ';
				}elseif($status=='2'){
				echo '
				<div class="form-group">
				<div class="col-md-4">
				<div class="col-xs-4 col-sm-4">
		             <input type="button" class="btn btn-danger btn-sm" name="" value="Confirmado"/>		</div>
					 </div>
				</div>
				    ';
				}elseif($status=='3'){
				echo '
					<div class="form-group">
				<div class="col-md-4">
					<div class="col-xs-4 col-sm-4">
		             <input type="button" class="btn btn-danger btn-sm" name="" value="Confirmado"/>		</div>
					 </div>
				</div>
				   ';
				}else{
				 echo '
				 <div class="form-group">
				 <div class="col-md-4">
						<div class="col-xs-4 col-sm-4">
		            <input type="button" id="id_horario" class="btn btn-primary btn-sm agregar" name="id_horario"  onclick="agregar('.$result->id.');" value="'.$result->inicio.'"/>						</div>
					</div>
				</div>';
				}
	      	
			echo '</div>';
			echo '</div>';
			}
		
		 ?>							
 <?php
				
	?>
	</div>
</div>
<script type="text/javascript" src="js/turno.js"></script>
