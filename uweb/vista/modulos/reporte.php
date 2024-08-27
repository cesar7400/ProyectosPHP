<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Reportes cotizaciones
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Reportes cotizaciones</li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <div class="input-group">
          <button type="button" class="btn btn-default" id="daterange-btn2">
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
          </button>
        </div>
        <div class="box-tools pull-right">
          <button class="btn btn-success" id="btnreporteExcel" style="margin-top:5px">Reporte excel</button>
        </div>
      </div>
      <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
                <?php
                    include "Cotizacionreporte.php";
                ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <?php
                    include "Productoreporte.php";
                ?>
            </div>
          </div>
      </div>
    </div>
  </section>
 </div>