<?php
require_once "controller/companies.controller.php";
require_once "model/companies.model.php";

$rpta = CompaniesController::ctrSelectIndicator($_COOKIE["id_indicators"],'indicator');
if($rpta == "errorSql" || $rpta == "connectionError"){
  echo'<script>alert("Error de conexión");</script>';
  echo "<script> window.location='viewConsultant'; </script>";
}

?>
<div class="content-wrapper">
  <section class="content-header">
    <h3>
      <?php
          echo $rpta[0][0];
      ?>
    </h3>
  </section>
  <section class="content">
    <div class="box">
      <div class="panel-heading">
        <h4>
        <?php 
          echo $rpta[0][1];
        ?>
        </h4>
      </div>
      <div class="box-body">
        <?php 
            if($rpta[0][2] == "1"){
              echo '<div class="form-group has-feedback">
                      <label class=" control-label" ><p id="element">'.$rpta[0][3].'</p><span class="symbol required"></span></label>
                        <input type="text" onKeyPress="return Numeros(event)" onpaste="return false" oncut="return false" oncopy="return false" maxlength="10" class="form-control" name="NewValue"  id="NewValue" autocomplete="off" style="border-radius: 15px" placeholder="Ingresar valor" required>
                    </div>
                    <div class="form-group has-feedback">
                      <label class=" control-label"><p id="element">'.$rpta[1][3].'</p><span class="symbol required"></span></label>
                        <input type="text" onKeyPress="return Numeros(event)" onpaste="return false" oncut="return false" oncopy="return false" maxlength="10" class="form-control" name="NewValue1"  id="NewValue1" autocomplete="off" style="border-radius: 15px" placeholder="Ingresar valor" required>
                    </div>';
            }else{
              echo '<div class="form-group has-feedback">
              <label class=" control-label" ><p id="element">'.$rpta[0][3].'</p><span class="symbol required"></span></label>
                <input type="text" onKeyPress="return Numeros(event)" onpaste="return false" oncut="return false" oncopy="return false" maxlength="10" class="form-control" name="NewValue"  id="NewValue" autocomplete="off" style="border-radius: 15px" placeholder="Ingresar valor" required>
            </div>';
            }
          ?>
      </div>
      <button id="btnAddCal" class="btn btn-primary" onclick="AddCal(<?php echo $rpta[0][2]?>,<?php echo $_COOKIE['id_indicators']?>,<?php echo $_COOKIE['id_company']?>)" title="Ingresar calificación">Ingresar</button>
      <a href="../indicadores/companiesindicators" class="btn btn-primary" title="Regresar">Regresar</a>
    </div>
  </section>
</div>