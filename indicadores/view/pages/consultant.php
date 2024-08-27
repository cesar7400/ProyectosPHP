<div class="content-wrapper">
  <section class="content-header">
    <h3>Consultores</h3>
  </section>
  <section class="content">
    <div class="box">
      <div class="panel-heading">
        <h4><span class="pull-right"></span></h4>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive consultantTable" id="consultantTable" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Correo</th>
              <th>Asignar empresas</th>
              <th>Ver empresas</th>
            </tr>
          </thead>
        </table>
      </div>
      <button id="btn_aupdade_con" class="btn btn-primary" title="Actualizar">Actualizar</button>
      <a href="../indicadores" id="btn_back_consultan" class="btn btn-primary" title="Regresar">Regresar</a>
    </div>
    <!--Modal agregar empresa-->
    <div id="modalEmpresaConsultor" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- cabeza del Modal-->
          <div class="modal-header" style="background:#3c8dbc; color:white">
          </div>
          <!-- cuerpo del Modal-->
          <div class="modal-body">
            <div class="box-body">
              <div class="row">
              <table width="490" height="300" border="10" align="center" class="display table table-bordered table-striped dt-responsive companiestTable" id="companiestTable" width="100%">
                <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Nombre</th>
                    <th>Nit</th>
                    <th>Teléfono</th>
                    <th>Seleccionar</th>
                  </tr>
                </thead>
              </table>
              </div>
            </div>
          </div>
          <!-- pie del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnClose" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal consultores-->
    <div id="modalviewEmpresaConsultor" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- cabeza del Modal-->
          <div class="modal-header" style="background:#3c8dbc; color:white">
          </div>
          <!-- cuerpo del Modal-->
          <div class="modal-body">
            <div class="box-body">
              <div class="row">
                <table id="view_info" width="490" height="20" border="10" align="center" class="display table table-bordered table-striped dt-responsive viewcompaniestTable" id="viewcompaniestTable" width="100%">
                  <tr>
                    <th>Nombre</th>
                    <th>Nit</th>
                    <th>Teléfono</th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <!-- pie del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnViewClose" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>