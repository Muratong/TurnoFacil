<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	//if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
      //  header("location: ../../login.php");
		//exit;
    //}
	
	
	/* Connect To Database*/
	include("../../admin/db_connect.php");
	//include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");
	$session_id= session_id();
	$sql_count=mysqli_query($conn,"select * from appointment_list where patient_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay turnos agregados al ticket')</script>";
	echo "<script>window.close();</script>";
	exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$usuario=intval($_GET['patient_id']);
	$cancha=intval($_GET['id_canchas']);
	$horario=mysqli_real_escape_string($conn,(strip_tags($_REQUEST['schedule'], ENT_QUOTES)));

	//Fin de variables por GET
	$sql=mysqli_query($conn, "select LAST_INSERT_ID(id_canchas) as last from appointment_list order by id_horario desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$num_planilla=$rw['last']+1;	
	//$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/factura_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
