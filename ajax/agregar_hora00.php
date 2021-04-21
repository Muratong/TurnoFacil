<?php
$session_id= session_id();
if (isset($_POST['id'])){
	$id=$_POST['id'];

	/* Conectar a la Database*/
	require_once ("../admin/db_connect.php");//Contiene las variables de configuracion para conectar a la base de datos
	

	//$sumador_total=0;
	$qry = $conn->query("SELECT * FROM horarios where id=".$id);
	while ($row=$qry->fetch_assoc())
	{
	echo $row['inicio'];
	
		}
	
}
?>

