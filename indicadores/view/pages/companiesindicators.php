<div class="content-wrapper">
  <section class="content-header">
    <h3>
      <?php 
          echo '<script>document.write(JSON.parse(localStorage.getItem("nameCompany")));</script>';
      ?>
    </h3>
  </section>
  <section class="content">
    <div class="box">
      <div class="panel-heading">
        <h4><span class="pull-right"></span></h4>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive companiesIndicatorsTable" id="companiesIndicatorsTable" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre indicaor</th>
              <th>Seleccionar</th>
            </tr>
          </thead>
        </table>
      </div>
      <a href="../indicadores/viewcompanies" id="btn_back_consultan" class="btn btn-primary" title="Regresar">Regresar</a>
      <a href="../indicadores" class="btn btn-primary" title="Inicio">Inicio</a>
    </div>
  </section>
</div>