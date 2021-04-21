<?php include 'admin/db_connect.php'; 

	$special = $conn->query("SELECT * FROM medical_specialty");
	$ms_arr = array();
	while ($row=$special->fetch_assoc()) {
		$ms_arr[$row['id']] = $row['name'];
	}


?>
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Predios Asociados</h3>
                        <hr class="divider my-8" />
                    </div>
                </div>
            </div>
        </header>
	<section class="page-section" id="doctors" >
        <div class="container">
        	<div class="card">
        		<div class="card-body" style="background-color:lightgreen; border-radius: 40px ">
        		  <div class="col-lg-12">
						<?php if(isset($_GET['sid']) && $_GET['sid'] > 0): ?>
					<div class="row">
						<div class="col-md-12 text-center">
							<?php
								$s = $conn->query("SELECT * from medical_specialty where id = ".$_GET['sid'])->fetch_array()['name'];
							?>
				<h2><b>Canchas Asociados <?php echo $s ?></b></h2>
						</div>
						</div>
					<hr class="divider">
						<?php endif; ?>
				<?php 
				$where = "";
				if(isset($_GET['sid']) && $_GET['sid'] > 0)
				$where = " where  (REPLACE(REPLACE(REPLACE(specialty_ids,',','\",\"'),'[','[\"'),']','\"]')) LIKE '%\"".$_GET['sid']."\"%' ";
			
	                $cats = $conn->query("SELECT * FROM doctors_list ".$where." order by id asc");
				        while($row=$cats->fetch_assoc()):
				    ?>
			 <div class="row align-items-center">
				<div class="col-md-3">
					<img src="assets/img/<?php echo $row['img_path'] ?>" width="" height="130px" style="-webkit-border-radius:5px; -moz-border-radius:5px;">
				</div>
			<div class="col-md-6">
						 <h1><p><b><?php echo "".$row['name'].', '.$row['name_pref'] ?></b></p></h1>
		
						 <h4><p><small>Ubicacion: <b><?php echo $row['clinic_address'] ?></b></small></p></h4>
						 <h3><p> <b><?php echo $row['contact'] ?></b></p></h3>
						 <p><a href="javascript:void(0)" class="view_schedule" data-id="<?php echo $row['id'] ?>" data-name="<?php echo "".$row['name'].', '.$row['name_pref'] ?>"><i class='fa fa-calendar'></i> Horarios Laborales</a></b></p>
						 <p><b>Categorias de Canchas disponibles:</b></p>
                         
						 <div>
						 <?php if(!empty($row['specialty_ids'])): ?>
						 <?php 
						 foreach(explode(",", str_replace(array("[","]"),"",$row['specialty_ids'])) as $k => $val): 
						 ?>
						 <span style="background-color: lightblue" class="badge badge-light" style="padding: 20px"><large><b><?php echo $ms_arr[$val] ?></b></large></span>
						 <?php endforeach; ?>
						 <?php endif; ?>
						 </div>
					</div>
					<br>
					<div class="col-md-3 text-center align-self-end-sm">
						<button class="btn-outline-primary  btn  mb-4 set_appointment" type="button" data-id="<?php echo $row['id'] ?>"  data-name="<?php echo "".$row['name'].', '.$row['name_pref'] ?>">Ver Canchas</button>
					</div>
					</div>
				<hr class="divider" style="max-width: 60vw">
				<?php endwhile; ?>
				</div>
				</div>
        	</div>
        </div>
    </section>
    <style>
    	#doctors img{
    		max-height: 300px;
    		max-width: 200px; 
    	}
    </style>
    <script>
        
       $('.view_schedule').click(function(){
			uni_modal($(this).attr('data-name')+" ------* Horarios*------","view_doctor_schedule.php?id="+$(this).attr('data-id'))
		})
       $('.set_appointment').click(function(){
       	if('<?php echo isset($_SESSION['login_id']) ?>' == 1)
			uni_modal("Ver Canchas de: "+$(this).attr('data-name'),"set_appointment.php?id="+$(this).attr('data-id'),'')
		else{
			uni_modal("Logea primero","login.php")
		}
		})
        
    </script> 
	
