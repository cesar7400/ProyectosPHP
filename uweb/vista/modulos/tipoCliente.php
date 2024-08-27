<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tipo clientes
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Tipo clientes</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
        <div class="box">
          <div class="panel-heading">
          <h4><i class="fa fa-user-circle"></i> Tipo clientes<span class="pull-right">
          <a class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoCliente" title="Agregar tipo cliente">Agregar tipo cliente</a>
          <button name="btn_upd_tipocliente" id="btn_upd_tipocliente" class="btn btn-primary " title="Actualizar"><span class="glyphicon glyphicon-refresh"></span></button></span>
          </h4>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablaTipoCliente" id="tablaTipoCliente" width="100%">
            <thead>
              <tr>
              <th style="width:10px">#</th>
              <th>Tipo cliente</th>
              <th>Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
  </div>
  <!--formulario modal agregar Tipo Cliente-->
<div id="modalAgregarTipoCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form role="form" method="post" id="modalTipoClienteAgregar">
     <!-- cabeza del Modal-->
      <div class="modal-header" style="background:#3c8dbc; color:white">
        <button type="button" class="close" id="btnCerrarModalTipoCliente" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Tipo cliente</h4>
      </div>
      <!-- cuerpo del Modal-->
      <div class="modal-body">
        <div class="box-body">
        <!-- entrada para el nombre -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="text" maxlength="40" class="form-control input-lg" autocomplete="off" onpaste="return false" oncut="return false" oncopy="return false" name="nuevoTipoCliente" id="nuevoTipoCliente" placeholder="Ingresar Tipo cliente" required>
            </div>
          </div>
        </div>
      </div>
      <!-- pie del Modal-->
      <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left salirTC" data-dismiss="modal">Salir</button>
      <button type="sumit" class="btn btn-primary" id="btn-submit_add_TipoCliente" name="btn-submit_add_TipoCliente">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <!--formulario modal editar Tipo Cliente-->
  <div id="modalEditarTipoCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form role="form" method="post" id="modalTipoClienteEditar">
     <!-- cabeza del Modal-->
      <div class="modal-header" style="background:#3c8dbc; color:white">
        <button type="button" class="close" id="btnCerrarModalEditarTipoCliente" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Tipo cliente</h4>
      </div>
      <!-- cuerpo del Modal-->
      <div class="modal-body">
        <div class="box-body">
        <!-- entrada para el nombre -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="text" maxlength="40" class="form-control input-lg" autocomplete="off" onpaste="return false" oncut="return false" oncopy="return false" name="editarTipoCliente" id="editarTipoCliente" placeholder="Editar Tipo cliente" required>
            </div>
          </div>
        </div>
      </div>
      <!-- pie del Modal-->
      <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left btn-cancelar-upd-TipoCliente">Cancelar</button>
      <button type="sumit" class="btn btn-primary" id="btn-submit_upd_TipoCliente" name="btn-submit_upd_TipoCliente">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>