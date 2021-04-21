<?php include('db_connect.php');
$where = '';
					if($_SESSION['login_type'] == 2)
						$where = " where doctor_id = ".$_SESSION['login_doctor_id'];
					$qry = $conn->query("SELECT * FROM canchas where doctor_id =".$_SESSION['login_doctor_id']);


?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-canchas">
				<input type="hidden" name="id">
				<div class="card">
					<div class="card-header">
						 <h4 style="color:black"> Agregar Canchas</h4>
				  	</div>
					<div class="card-body">

							<div id="msg"></div>
							<input type="hidden" name="doctor_id" value="<?php echo "".$_SESSION['login_doctor_id']. $_SESSION['login_name']."!"  ?>">
							
							<div class="form-group">
								<label class="control-label">Nombre</label>
								<textarea name="nombre" id="" cols="30" rows="2" class="form-control" required=""></textarea>
							</div>							
																				
							<div class="form-group">
								<label for="" class="control-label">Imagen</label>
								<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
							</div>
							<div class="form-group">
								<img src="" alt="" id="cimg">
							</div>	
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-4 offset-md-3">Guardar</button>
								<button class="btn btn-sm btn-default col-sm-4" type="button" onclick="_reset()"> Cancelar</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead> 
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Imagen</th>
									<th class="text-center">Info</th>
									<th class="text-center">Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php 
					$where = '';
					if($_SESSION['login_type'] == 2)
						$where = " where doctor_id = ".$_SESSION['login_doctor_id'];

					$qry = $conn->query("SELECT * FROM canchas ".$where." order by doctor_id desc ");
					while($row = $qry->fetch_assoc()):
					?>
								<tr>
									<td class="text-center"></td>
									<td class="text-center">
										<img src="../assets/imagenes/<?php echo $row['imagen'] ?>" alt="">
									</td>
									<td class="">
										 <p>Nombre: <b><?php echo " ".$row['nombre'] ?></b></p>
										 
										<p><small><a href="javascript:void(0)" class="view_horarios" data-id="<?php echo $row['id'] ?>"data-name="<?php echo "".$row['nombre'] ?>"><i class='fa fa-calendar'></i><strong> Cargar Horarios a canchas</strong></a></b></small></p>

									</td>
						<td class="text-center">
						<button class="btn btn-sm btn-primary edit-cancha"
						 type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['nombre'] ?>"
						 data-imagen="<?php echo $row['imagen'] ?>" >Editar</button>
						<button class="btn btn-sm btn-danger delete_cancha" type="button" 
						data-id="<?php echo $row['id'] ?>">Eliminar</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
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
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	
	function _reset(){
		$('#cimg').attr('src','');
		$('[name="id"]').val('');
		$('#manage-canchas').get(0).reset();
	}
	$('table').dataTable()
	$('#manage-canchas').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('') 
		$.ajax({
			url:'ajax.php?action=save_cancha',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Cancha agregado correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Cancha actualizado correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('.edit-cancha').click(function(){
		start_load()
		var cat = $('#manage-canchas')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='nombre']").val($(this).attr('data-name'))
		cat.find("#cimg").attr("src","../assets/imagenes/"+$(this).attr('data-imagen'))
		end_load()
	})

	$('.view_horarios').click(function(){
		uni_modal($(this).attr('data-name')+" - Horarios","view_cancha_horarios.php?id="+$(this).attr('data-id'))
	})
	$('.delete_cancha').click(function(){
		_conf("¿Está seguro de eliminar esta cancha? "," delete_cancha",[$(this).attr('data-id')])
	})
	
	function delete_cancha($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_cancha',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Cancha eliminados correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>