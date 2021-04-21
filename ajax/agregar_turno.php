<?php
$session_id= session_id();
if (isset($_POST['id'])){
	$id=$_POST['id'];
}
	/* Conectar a la Database*/
	require_once ("../admin/db_connect.php");//Contiene las variables de configuracion para conectar a la base de datos
?>

<input type="text" name="id_horario" id="id_horario" class="form-control" value="<?php echo $id ; ?>">
<?php
	//$sumador_total=0;
	$qry = $conn->query("SELECT * FROM horarios where id=".$id);
	while ($row=$qry->fetch_assoc())
	{
		?>
	<input type="text" name="time" id="time" class="form-control" value="<?php echo $row['inicio'] ; ?>">
	<?php
		}
?>

