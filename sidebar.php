<!--Side bar-->
<div class="row row-offcanvas row-offcanvas-right">
	<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	   <div class="sidebar-nav">
	       <div class="panel alert-info" style="-webkit-border-radius:15px; -moz-border-radius:15px;">
		   
		     <div class="alert alert-info" style="background-color:lightblue;font-size: 20px "><strong>Predio a Reservar</strong> </div>
			 <div class="panel-body">	
				<form  method="POST" action="">
					<div class="col-xs-12 col-sm-12">
					     <div class="form-group">
					         <div class="row">
					           <input type="hidden" name="id">
			    <?php 
                   if(isset($_GET['id'])){
                 $predio = $conn->query("SELECT * FROM doctors_list where id =".$_GET['id']);
         }
                   $row=$predio->fetch_assoc();
									 ?>
					     <div class="col-md-10">
					         <img class=""  src="assets/img/<?php echo $row['img_path'] ?>"width="" height="130px" style="-webkit-border-radius:5px; -moz-border-radius:5px;">       
						</div>
					</div>
				</div>
						   <div class="form-group">
						        <div class="row">
					           <div class="col-xs-12 col-sm-12">
					         <h2><p><b><?php echo "".$row['name'].' / '.$row['name_pref'] ?></b></p></h2>
								                   
						              		</div>
						            	</div>
						            </div>
						        </div>
					        </form>
						</div>
		            </div>      
			
				<div class="panel alert-info" style="-webkit-border-radius:15px; -moz-border-radius:15px;">
					
					<?php if(!isset($_SESSION['login_id'])){

				echo ' <div class="panel-heading">Inicio de sesión de usuario</div>
					   <div class="panel-body">	
						   <form  method="POST" action="admin/ajax.php?action=login2">
								<div class="col-xs-12 col-sm-12">

					          <div class="form-group">
					           <div class="row">
					            <div class="col-xs-12 col-sm-12">
						          <input type="email" placeholder="Email" class="form-control" name="email">
						              		</div>
						            	</div>
						            </div>
						         <div class="form-group">
						           <div class="row">
					            <div class="col-xs-12 col-sm-12">
						            <input type="password" placeholder="Password" class="form-control" name="password">
						              		</div>
						            	</div>
						            </div>

						     <div class="form-group">
						       <div class="row">
					            <div class="col-xs-12 col-sm-12">
						          <button type="submit" class="btn btn-primary" align="right" name="login">Entrar</button>
						           		</div>
						            	</div>
						            </div>
						        </div>
					        </form>
					       
						</div>';
					}else{

				echo'<div class="card-body"></div>
					 <div class="panel-body">	
						<div class="col-xs-12 col-sm-12">
						 <span class="glyphicon glyphicon-user"> </span>  Cliente:<br/> <p><b>'.$_SESSION['login_name'].' </b><br/>
								<span class="glyphicon glyphicon-"> </span> Direccion:<br/> <b>'. $_SESSION['login_address'].'</b><br/>
									 <span class="glyphicon glyphicon-phone"> </span> Tel No.:<br/><b> '. $_SESSION['login_contact'].'</b><br/><br/>
									  
									</div>						
								</div>';
					}
						?>
				</div>
			</div>
		</div> 
		
		
