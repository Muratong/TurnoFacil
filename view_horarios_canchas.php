<style>
	#uni_modal .modal-footer{
		display: none;
	}
</style>
<?php 
	include'admin/db_connect.php';
	include 'admin/admin_class.php'
	//$qry = $conn->query("SELECT * FROM doctors_schedule where doctor_id=".$_GET['id']);
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center">Precio</th>
						<th class="text-center">Horarios</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row=$consulta->fetch_assoc()): ?>
					<tr>
						<th class="text-center"><?php echo $row['precio'] ?></th>
						<th class="text-center"><?php echo date("h:i A",strtotime($row['inicio'])).' - '.date("h:i A",strtotime($row['final'])) ?></th>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	<hr>
		<div class="row">
			<button class="btn btn-secondary btn-sm col-md-4 offset-md-4 " type="button" data-dismiss="modal" id="">Cerrar</button>
		</div>
	</div>
</div>
<script>
	$('#edit').click(function(){
		uni_modal("Editar "+$('#uni_modal .modal-title').html(),'manage_doctor_schedule.php?did=<?php echo $_GET['id'] ?>','mid-large');
	})
</script>