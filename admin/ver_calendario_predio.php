<style>
	#uni_modal .modal-footer{
		display: none;
	}
</style>
<?php 
	include'db_connect.php';
	$qry = $conn->query("SELECT * FROM doctors_schedule where doctor_id=".$_GET['id']);
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center">Dias</th>
						<th class="text-center">Horas</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row=$qry->fetch_assoc()): ?>
					<tr>
						<th class="text-center"><?php echo $row['day'] ?></th>
						<th class="text-center"><?php echo date("h:i A",strtotime($row['time_from'])).' - '.date("h:i A",strtotime($row['time_to'])) ?></th>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	<hr>
		<div class="row">
			<button class="btn btn-primary btn-sm col-md-3 mr-2" type="button" id="editar">Editar</button>
			<button class="btn btn-secondary btn-sm col-md-3  " type="button" data-dismiss="modal" id="">Cerrar</button>
		</div>
	</div>
</div>
<script>
	$('#editar').click(function(){
		uni_modal("Editar "+$('#uni_modal .modal-title').html(),'manage_calendario_predios.php?did=<?php echo $_GET['id'] ?>','');
	})
</script>