
		$(document).ready(function(){
			load(1);
		});

		function load(page){
			
		}

		function agregar (id)
		{
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_turno.php",
        data: "id="+id,
       	success: function(event) {
	 	$('#turnos').html(event);
		}
			});
		}
		 	
		$("#datos_turno").submit(function(){
		  var usuario = $("#usuario").val();
		  var cancha = $("#cancha").val();
		  var telefono = $("#telefono").val();
		  var fecha = $("#fecha").val();
		  
		 VentanaCentrada('./pdf/documentos/ticket_pdf.php?cancha='+cancha+'&usuario='+usuario+'&telefono='+telefono+'&fecha='+fecha,'Planilla','','1024','768','true');
	 	});