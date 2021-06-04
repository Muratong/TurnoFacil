
<?php 
  include 'admin/db_connect.php';
  $doctor= $conn->query("SELECT * FROM doctors_list ");
  while($row = $doctor->fetch_assoc()){
    $doc_arr[$row['id']] = $row;
  }
  $patient= $conn->query("SELECT * FROM users where type = 3 ");
  while($row = $patient->fetch_assoc()){
    $p_arr[$row['id']] = $row;
  }
  $cancha= $conn->query("SELECT * FROM canchas ");
  while($row = $cancha->fetch_assoc()){
    $c_arr[$row['id']] = $row;
  }
  $horario= $conn->query("SELECT * FROM horarios ");
  while($row = $horario->fetch_assoc()){
    $h_arr[$row['id']] = $row;
  }
?>
<br><p></p><br><p></p>
<div class="container-fluid">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <li class="btn-primary btn btn-sm " type="button"><a style="color:white" href="index.php?page=predios"><i class="fa fa-plus"></i> Nuevo Turno</li>
        <br>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
            <th>Dias & Horas de solicitudes</th>
            <th>Predios</th>
            <th>Cancha</th>
            <th>Nombre</th>
            <th>Turno</th>
            <th>Precio</th>
            <th>Estados</th>
           
          </tr>
          </thead>
          <tbody>
  <!------------ -----------Aqui es donde llama en la tabla los turnos de cada cancha correspondiente-------------------------------------->
          <?php 
          $where = '';
          if($_SESSION['login_type'] == 3)
            $where = " where patient_id = ".$_SESSION['login_id'];
          $qry = $conn->query("SELECT * FROM appointment_list ".$where." order by id desc ");
          while($row = $qry->fetch_assoc()):
          ?>
          <tr>
            <td class="text-center " ><?php echo date ("l d /M / Y .-(h:i:s) ",strtotime($row['date_created'])) ?></td>
            <td class="text-center"><?php echo "".$doc_arr[$row['doctor_id']]['name'] ?></td>
            <td class="text-center"><span class="badge badge-primary"><?php echo $c_arr[$row['id_canchas']]['nombre'] ?></span></td>
            <td class="text-center"><?php echo $p_arr[$row['patient_id']]['name'] ?></td>
                        <td class="text-center" >
                           <?php if($row['status'] == 0): ?>
                          <span class="badge badge-warning"><?php echo $h_arr[$row['id_horario']]['inicio'] ?>
                          </span>
                          <?php endif ?>
                           <?php if($row['status'] == 1): ?>
                          <span class="badge badge-primary"><?php echo $h_arr[$row['id_horario']]['inicio'] ?>
                          </span>
                          <?php endif ?>
                           <?php if($row['status'] == 2): ?>
                          <span class="badge badge-info"><?php echo $h_arr[$row['id_horario']]['inicio'] ?>
                          </span>
                          <?php endif ?>
                           <?php if($row['status'] == 3): ?>
                          <span class="badge badge-danger"><?php echo $h_arr[$row['id_horario']]['inicio'] ?>
                          </span>
                          <?php endif ?>
                        </td>
                        <td class="text-center"><?php echo $h_arr[$row['id_horario']]['precio'] ?></td>
            <td class="text-center">
              <?php if($row['status'] == 0): ?>
                <span class="badge badge-warning">Pendiente</span>
              <?php endif ?>
              <?php if($row['status'] == 1): ?>
                <span class="badge badge-primary">Confirmado</span>
              <?php endif ?>
              <?php if($row['status'] == 2): ?>
                <span class="badge badge-info">Reprogramado</span>
              <?php endif ?>
              <?php if($row['status'] == 3): ?>
                <span class="badge badge-danger">Jugado</span>
              <?php endif ?>
            </td>
            <!--<td class="text-center">
              <button  class="btn btn-primary btn-sm update_app" type="button" data-id="<?php echo $row['id'] ?>">Actualizar</button>
              <button  class="btn btn-danger btn-sm delete_app" type="button" data-id="<?php echo $row['id'] ?>">Eliminar</button>
            </td>-->
          </tr>
        <?php endwhile; ?>
      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br><p></p>
<style>
  
  td{
    vertical-align: middle !important;
  }
  td p{
    margin: unset
  }
  
</style>
<script>
  $('.update_app').click(function(){
    uni_modal("Editar Turno","set_appointment.php?id="+$(this).attr('data-id'),"")
  })
  $('.new_appointment').click(function(){
    uni_modal("Agregar Turno","set_appointment.php?id="+$(this).attr('data-id'),'')
  })
  $('.delete_app').click(function(){ 
    _conf("¿Estas seguro de Eliminar el turno?","delete_app",[$(this).attr('data-id')])
  })
  function delete_app($id){
    start_load()
    $.ajax({
      url:'ajax.php?action=delete_appointment',
      method:'POST',
      data:{id:$id},
      success:function(resp){
        if(resp==1){
          alert_toast("Datos se elimina correctamente",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }
</script>