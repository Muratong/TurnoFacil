<style>
	#uni_modal .modal-footer{
		display: none;
	}
</style>
<?php 
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM horarios where id_canchas =".$_GET['did']);
$c = $qry->num_rows;
while($row=$qry->fetch_assoc()){
	$id[$row['hora']] = $row['id'];
	$from[$row['hora']] = date("H:i",strtotime($row['inicio']));
	$to[$row['hora']] = date("H:i",strtotime($row['final']));
	$precio[$row['hora']] = $row['precio'];
}


?>
<div class="container-fluid">
	<form  id="manage-horario">
		<input type="hidden" name="id_canchas" value="<?php echo $_GET['did'] ?>">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th class="text-center"></th>
						<th class="text-center">Nº</th>
						<th class="text-center">Desde</th>
						<th class="text-center">A</th>
						<th class="text-center">precio</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$hora = array(
						"1","2","3","4","5","6","7","8","9","10","11","12"
					);
					for($i = 0 ; $i < 12;$i++):
					?>
					<tr>
						<td class="form-control"><input type="checkbox" name="check[<?php echo $i ?>]" value="<?php echo isset($id[$hora[$i]]) ? $id[$hora[$i]] : '' ?>" <?php echo isset($id[$hora[$i]]) ? "checked" :( $c > 0 ? '' : 'checked') ?>></td>
						<td class="form-control"><?php echo $hora[$i] ?> <input type="hidden" name="hora[<?php echo $i ?>]" value="<?php echo $hora[$i] ?>"></td>
						<td class="text-center"><input name="inicio[<?php echo $i ?>]" type="time" value="<?php echo isset($from[$hora[$i]]) ? $from[$hora[$i]] : '' ?>" class="form-control" id=""></td>
						<td class="text-center"><input name="final[<?php echo $i ?>]" type="time" value="<?php echo isset($to[$hora[$i]]) ? $to[$hora[$i]] : '' ?>" class="form-control" id=""></td>
						<td class="text-center">
							<input name="precio[<?php echo $i ?>]" type="text" value="<?php echo isset($precio[$hora[$i]]) ? $precio[$hora[$i]] : '' ?>" class="form-control"  placeholder="$" >
						</td>
					</tr>
					<?php endfor; ?>
				</tbody>
			</table>
			</div>
		</div>
	<hr>
		<div class="row">
			<button class="btn btn-primary btn-sm col-md-3 mr-2" >Guardar</button>
			<button class="btn btn-secondary btn-sm col-md-3  " type="button" data-dismiss="modal" id="">Cerrar</button>
		</div>
	</div>
	</form>
</div>

<script>
	$("#manage-horario").submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_horario',
			method:"POST",
			data:$(this).serialize(),
			success:function(resp){
				if(resp==1){
					alert_toast("Horario guardado correctamente","success");
					var title = $("#uni_modal .modal-title").html();
					title.replace("Edit ",'')
					end_load()
					uni_modal(title,'view_cancha_horarios.php?id=<?php echo $_GET['did'] ?>')
				}
			}
		})
	})
</script>