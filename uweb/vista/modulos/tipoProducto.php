<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tipo productos
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Tipo productos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
        <div class="box">
          <div class="panel-heading">
          <h4><i class="fa fa-user-circle"></i> Tipo productos<span class="pull-right">
          <a class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoProducto" title="Agregar tipo producto">Agregar tipo producto</a>
          <button name="btn_upd_tipoproducto" id="btn_upd_tipoproducto" class="btn btn-primary " title="Actualizar"><span class="glyphicon glyphicon-refresh"></span></button></span>
          </h4>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablaTipoProducto" id="tablaTipoProducto" width="100%">
            <thead>
              <tr>
              <th style="width:10px">#</th>
              <th>Tipo productos</th>
              <th>Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
  </div>
  <!--formulario modal agregar Tipo producto-->
<div id="modalAgregarTipoProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form role="form" method="post" id="modalTipoProductoAgregar">
     <!-- cabeza del Modal-->
      <div class="modal-header" style="background:#3c8dbc; color:white">
        <button type="button" class="close" id="btnCerrarModalTipoProducto" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Tipo productos</h4>
      </div>
      <!-- cuerpo del Modal-->
      <div class="modal-body">
        <div class="box-body">
        <!-- entrada para el nombre -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="text" maxlength="40" class="form-control input-lg" autocomplete="off" onpaste="return false" oncut="return false" oncopy="return false" name="nuevoTipoProducto" id="nuevoTipoProducto" placeholder="Ingresar tipo producto" required>
            </div>
          </div>
        </div>
      </div>
      <!-- pie del Modal-->
      <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left salirTp" data-dismiss="modal">Salir</button>
      <button type="sumit" class="btn btn-primary" id="btn-submit_add_TipoProducto" name="btn-submit_add_TipoProducto">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <!--formulario modal editar Tipo Producto-->
  <div id="modalEditarTipoProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form role="form" method="post" id="modalTipoProductoEditar">
     <!-- cabeza del Modal-->
      <div class="modal-header" style="background:#3c8dbc; color:white">
        <button type="button" class="close" id="btnCerrarModalEditarTipoProducto" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar tipo producto</h4>
      </div>
      <!-- cuerpo del Modal-->
      <div class="modal-body">
        <div class="box-body">
        <!-- entrada para el nombre -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="text" maxlength="40" class="form-control input-lg" autocomplete="off" onpaste="return false" oncut="return false" oncopy="return false" name="editarTipoProducto" id="editarTipoProducto" placeholder="Editar tipo producto" required>
            </div>
          </div>
        </div>
      </div>
      <!-- pie del Modal-->
      <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left btn-cancelar-upd-TipoProducto">Cancelar</button>
      <button type="sumit" class="btn btn-primary" id="btn-submit_upd_TipoProducto" name="btn-submit_upd_TipoProducto">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>