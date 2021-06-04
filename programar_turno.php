<?php
include ('admin/db_connect.php')
?>

<div class="container-fluid">
  <form action="" id="">
  <div class="col-lg-12">
    <div class="card-body">
      <input type="hidden" name="doctor_id" value="<?php echo $_GET['id'] ?>">
<?php 
        if(isset($_GET['id'])){
  $predio = $conn->query("SELECT * FROM doctors_list where id =".$_GET['id']);
  while($row = $predio->fetch_assoc()){
    $pre_arr[$row['id']] = $row;  
  }
  }
            ?>
      <div class="form-group">
        <label for="" class="control-label">
           <?php foreach($pre_arr as $row): ?>
          <p><h5>Estas Por Solicitar un turno en el Predio.</h5> </p>
            <h2> <strong> <?php echo "".$row['name'].','.$row['name_pref']. '</strong> </h2>
            <p> Ubicado en: <strong> '.$row['clinic_address'] ?></strong></p>
           <p><h5> ¿Quieres Continuar?</h5></p>
        </label>
        <?php endforeach; ?>
      </div>

      <hr>
      <div class="col-md-12 text-center align-self-end-sm">
            <a href="sacar_turno.php?id=<?php echo $row['id'] ?>" class="btn-outline-primary  btn">Confirmar</a>
      
      </div>
    </div>
  </div>
</div>
<style>
  #uni_modal .modal-footer{
    display: none
  }
</style>

