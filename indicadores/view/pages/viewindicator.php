<?php    require_once "controller/users.controller.php";
    require_once "model/users.model.php";
    require_once('../config.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <h3>
        <?php 
          echo '<script>
                if((JSON.parse(localStorage.getItem("nameCompanySelect")))==null){
                    window.location="indicadores";
                }else{
                    document.write(JSON.parse(localStorage.getItem("nameCompanySelect")))
                }
                </script>';
        ?>
        </h3>
    </section>
    <section class="content">
        <div class="box">
            <div class="panel-heading">
                <h4><span class="pull-right"></span></h4>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive historyIndicators" id="historyIndicators" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre indicador</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <button id="btn_back_ind_sel" class="btn btn-primary" title="Regresar">Regresar</button>
            <?php
                $rpta = UsersController::CTRUsers($USER->id);
                if($rpta[0][0] == "consultant"){
                    echo'<a href="viewcompanies" class="btn btn-primary">Calificar empresas</a>';
                }
            ?>
            
            <a href="../indicadores" class="btn btn-primary" title="Inicio">Inicio</a>
        </div>
    </section>
</div>