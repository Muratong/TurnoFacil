<?php
 session_start();
    ob_start();
include ('admin/db_connect.php')
?>
<style>
	#uni_modal .modal-footer{
		display: none;
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="text-center">
 	                <?php 
 	                  setlocale(LC_TIME, 'Spanish');
                      echo UTF8_encode(strftime("%A %#d de %B del %Y"));
                    ?>
         </div>
                     <?php 
		              if(isset($_GET['id'])){
	                  $predio = $conn->query("SELECT * FROM canchas where id =".$_GET['id']);
                                 }
			           $row=$predio->fetch_assoc();
					 ?>
	<div id="msg"></div>
		 <form action="" id="reserva_turno">
			        <?php 
                      date_default_timezone_set('America/Argentina/La_Rioja');
                      $date=date("d-m-y");
                    ?>
	<div class="form-group">
		  <input class="form-control" type="hidden" name="doctor_id" value="<?php echo $row['doctor_id'] ?>">
    </div>
		  <input class="form-control" type="hidden"  name="id_canchas" id="id_canchas" value="<?php echo $_GET['id'] ?>" class="" >
			         <?php if(isset($_SESSION['login_id'])): ?>
			<!--<label for="" class="control-label">Telefono</label>-->
            <input class="form-control" type="hidden"  name="telefono" id="telefono" value="<?php echo " ".$_SESSION['login_contact'] ?>" class="" required="">
                      <?php endif; ?>
	<div class="form-group">
			<label for="" class="control-label">Seleccionar el dia</label>
			<input class="form-control" type="date" value="" id="date" name="date" class="form" required>
    	
	</div>
	<div class="form-group" id="horarios"></div>

	<div class="form-group">
	<div id="turnos"></div>
	</div>
	 
		</form>
	</div>
</div>

<script type="text/javascript" src="js/turno.js"></script>
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
	
	$("#reserva_turno").submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=reserva_turno',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				resp = JSON.parse(resp)
				if(resp.status == 1){
					alert_toast("El turno se Genero con exito!");
					end_load();
					$('.modal').modal("hide");
					window.location.replace("https://mpago.la/1GmzRm8");
				}else{
					$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')
					end_load();
				}
			}
		})
	})

</script>
	<style>
table {
	max-width: 100%;
	background-color: #fff;
	border-bottom-left-radius: 14px;
	border-bottom-right-radius: 14px;
}
</style></div>
