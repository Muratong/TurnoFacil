<?php
$session_id= session_id();
if (isset($_POST['id'])){
	$id=$_POST['id'];
}
	/* Conectar a la Database*/
	require_once ("../admin/db_connect.php");//Contiene las variables de configuracion para conectar a la base de datos
?>

<input type="hidden" name="id_horario" id="id_horario" class="form-control" value="<?php echo $id ; ?>">
<?php
	//$sumador_total=0;
	$qry = $conn->query("SELECT * FROM horarios where id=".$id);
	while ($row=$qry->fetch_assoc())
	{
		?>
	
	<input type="text" name="time" id="time" class="form-control" value="<?php echo $row['inicio'] ; ?>"readonly>
	<label>Usted Tomo Este Horario</label>
	<br>
	<label>Precio del Turno: <?php echo $row['precio'] ; ?></label>
	<div class="form-group">
	<button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Guardar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div> 
		
	<?php
		}
		
		
?>

