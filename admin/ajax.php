<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}
if($action == "delete_category"){
	$save = $crud->delete_category();
	if($save)
		echo $save;
}
if($action == "save_predios"){
	$save = $crud->save_predios();
	if($save)
		echo $save;
}
if($action == "delete_predios"){
	$save = $crud->delete_doctor();
	if($save)
		echo $save;
}
if($action == "save_calendario"){
	$save = $crud->save_calendario();
	if($save)
		echo $save;
}
if($action == "reserva_turno"){
	$save = $crud->reserva_turno();
	if($save)
		echo $save;
}
if($action == "delete_turno"){
	$save = $crud->delete_turno();
	if($save)
		echo $save;
}
if($action == "update_turno"){
	$save = $crud->update_appointment();
	if($save)
		echo $save;
}
if($action == "horarios"){
	$result = $crud->horarios();
	if($result)
		echo $result;
}
if($action == "save_cancha"){
	$save = $crud->save_cancha();
	if($save)
		echo $save;
}
if($action == "delete_cancha"){
	$save = $crud->delete_cancha();
	if($save)
		echo $save;
}
if($action == "save_horario"){
	$save = $crud->save_horario();
	if($save)
		echo $save;
}


