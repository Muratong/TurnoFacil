<?php
session_start();
    ob_start();
include ('db_connect.php');
$doctor= $conn->query("SELECT * FROM doctors_list ");
	while($row = $doctor->fetch_assoc()){
		$doc_arr[$row['id']] = $row;
	}
	$patient= $conn->query("SELECT * FROM users where type = 3 ");
	while($row = $patient->fetch_assoc()){
		$p_arr[$row['id']] = $row;
	}
	
if(isset($_GET['id'])){
	$cancha = $conn->query("SELECT * FROM canchas ");
	while($row = $cancha->fetch_assoc()){
		$can_arr[$row['id']] = $row;
}
	

	}
	if(isset($_GET['id'])){
	$horario = $conn->query("SELECT * FROM horarios ");
	while($row = $horario->fetch_assoc()){
		$hor_arr[$row['id']] = $row;
}
	
	}
?>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div id="msg"></div>
		<form action="" id="manage-appointment">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
			<?php if($_SESSION['login_type'] == 2): ?>
			<input type="hidden" name="doctor_id" value="<?php echo isset($_SESSION['login_doctor_id']) ? $_SESSION['login_doctor_id'] : ''; ?>">
				<?php else: ?>
			<div class="form-group">
				<label for="" class="control-label">Predios</label>
				<select class="browser-default custom-select select2" name="doctor_id">
					<option value=""></option>
					<?php foreach($doc_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($doctor_id) && $doctor_id == $row['id'] ? 'selected' : '' ?>><?php echo "".$row['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			
			<div class="form-group">
				<label for="" class="control-label">Precio hora</label>
				<select class="browser-default custom-select select2" name="">
					<option value="<?php echo isset($id_horario) ? date("H:i",strtotime($id_horario)) : '' ?>"></option>
					<?php foreach($hor_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($id_horario) && $id_horario == $row['id'] ? 'selected' : '' ?>><?php echo "" .$row['precio'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		<?php endif; ?>
			<div class="form-group">
				<label for="" class="control-label">Cliente</label>
				<select class="browser-default custom-select select2" name="patient_id">
					<option value=""></option>
					<?php foreach($p_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($patient_id) && $patient_id == $row['id'] ? 'selected' : '' ?> required><?php echo $row['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			 
					  <input class="form-control" type="text"  name="id_canchas" id="id_canchas" value="<?php echo $_GET['id'] ?>" class="" >
			<div class="form-group">
				<label for="" class="control-label">Fecha</label>
				<input type="date"  name="date" class="form-control" value="<?php echo isset($schedule) ? date("Y-m-d",strtotime($schedule)) : '' ?>" required>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Canchas</label>
				<select class="browser-default custom-select select2" name="id_canchas">
					<option value=""></option>
					<?php foreach($can_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($id_canchas) && $id_canchas == $row['id'] ? 'selected' : '' ?>><?php echo "".$row['nombre'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Hora</label>
				<select class="browser-default custom-select select2" name="id_horario">
					<option value="<?php echo isset($id_horario) ? date("H:i",strtotime($id_horario)) : '' ?>"></option>
					<?php foreach($hor_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($id_horario) && $id_horario == $row['id'] ? 'selected' : '' ?>><?php echo "".$row['inicio']?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="" class="control-label">Status</label>
				<select class="browser-default custom-select" name="status">
					<option value="0" <?php echo isset($status) && $status == 0 ? "selected" : '' ; ?>>Pendiente</option>
					<option value="1" <?php echo isset($status) && $status == 1 ? "selected" : '' ; ?>>Confirmado</option>
					<option value="2" <?php echo isset($status) && $status == 2 ? "selected" : '' ; ?>>Reprogramado</option>
					<option value="3" <?php echo isset($status) && $status == 3 ? "selected" : '' ; ?>>Hecho</option>
				</select>
			</div>


			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4">Agregar</button>
				<button class="btn btn-secondary btn-sm col-md-4  " type="button" data-dismiss="modal" id="">Cerrar</button>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function(){
$("#date").change(function(e)
{
	e.preventDefault()
	var cancha= $("#id_canchas").val();
	var dt = $("#date").val();
	$.ajax({
    type:"POST",
    data:"dt="+$('#date').val()+"&cancha="+$('#id_canchas').val(),
    url:'busca_horario.php',
    success:function(datos) {
    $('#horarios').html(datos);
          }
	    });
      });
  });
	
	$("#manage-appointment").submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=reserva_turno',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				resp = JSON.parse(resp)
				if(resp.status == 1){
					alert_toast("Solicitud enviada con ??xito");
					// end_load();
					$('.modal').modal("hide");
					setTimeout(function(){
						location.reload();
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')
					end_load();
				}
			}
		})
	})
</script>

