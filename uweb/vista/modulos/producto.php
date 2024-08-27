<?php
  require_once "controlador/tipoProducto.controlador.php";
  require_once "modelo/tipoProducto.modelo.php";
?>
<div class="content-wrapper">
  <section class="content-header">
    <h3>Productos</h3>
  </section>
  <section class="content">
    <div class="box">
      <div class="panel-heading">
        <h4><i class="fa fa-product-hunt"></i> Productos<span class="pull-right">
          <a href="agregarProducto" class="btn btn-primary"title="Agregar Producto">Agregar Producto</a>
          <button name="btn_upd_productos" id="btn_upd_productos" class="btn btn-primary " title="Actualizar"><span class="glyphicon glyphicon-refresh"></span></button>
        </h4>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>      
              <th>Código</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Valor</th>
              <th>IVA</th>
              <th>Valor IVA</th>
              <th>Tipo producto</th>
              <th>Fecha ingreso</th>
              <th>Fecha modificación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div>
    <!--Modal ver productos-->
      <div id="modalVerProducto" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- cabeza del Modal-->
            <div class="modal-header" style="background:#3c8dbc; color:white">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Datos del Producto</h4>
            </div>
            <!-- cuerpo del Modal-->
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <table width="547" border="0" align="center">
                      <tbody>
                        <tr>
                          <td width="410"><strong>Código:</strong><strong id="verCodigoP"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Nombre:</strong><strong id="verNombreP" aling></td>
                        </tr>
                        <tr>
                          <td><strong>Descripción: </strong><strong id="VerDescripcionP"></td>
                        </tr>
                        <tr>
                          <td><strong>Valor: </strong><strong id="VerValorP"></td>
                        </tr>
                        <tr>
                          <td><strong>IVA:</strong><strong id="verIvaP"></td>
                        </tr>
                        <tr>
                          <td><strong>Valor IVA: <strong id="VerIVAvalor"></td>
                        </tr>
                        <tr>
                          <td><strong>Tipo: </strong> <strong id="VertipoP"></td>
                        </tr>
                        <tr>
                          <td><strong>Fecha ingreso: </strong> <strong id="VerFechaIng"></td>
                        </tr>
                        <tr>
                          <td><strong>Fecha modificación: </strong> <strong id="verFechaMod"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- pie del Modal-->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
              </div>
          </div>
        </div>
      </div>
      <div id="modalEditarProducto" class="modal fade" role="dialog">
        <!--MODAL EDITAR PRODUCTO-->
          <div class="modal-dialog">
            <div class="modal-content">
              <form role="form" method="post" enctype="multipart/form-data" id="frmEditarProducto">
                <!--CABEZA DEL MODAL-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar producto</h4>
                </div>
                <!--CUERPO DEL MODAL-->
                <div class="modal-body">
                  <div class="box-body">
                    <!-- ENTRADA PARA EL CÓDIGO -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" onKeyPress="return Numeros(event)" id="editarCodigoPro" onpaste="return false" oncut="return false" oncopy="return false" name="editarCodigoPro" placeholder="Ingresar código" required>
                        <div class="text-danger" id="errorCodigoP"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarNombrePro" onpaste="return false" oncut="return false" oncopy="return false" name="editarNombrePro" placeholder="Ingresar nombre" required>
                        <div class="text-danger" id="errorNombrePro"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA DESCRIPCIÓN -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil "></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarDescripcionPro" onpaste="return false" oncut="return false" oncopy="return false" name="editarDescripcionPro" placeholder="Ingresar descripción" required>
                        <div class="text-danger" id="errorDescripcionPro"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA VALOR -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil "></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="15" onKeyPress="return Numeros(event)" id="editarValornPro" onpaste="return false" oncut="return false" oncopy="return false" name="editarValornPro" placeholder="Ingresar valor unitario" required>
                        <div class="text-danger" id="errorDescripcionPro"></div>
                      </div>
                    </div>
                    <!-- TIPO PRODUCTO -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-check-circle"></i></span>
                        <select name="editarTipoPro" id="editarTipoPro" class='form-control' required="" aria-required="true">
                          <option value="">Seleccionar producto</option>
                          <?php
                            $item = null;
                            $valor = null;
                            $tipoProducto = controladorTipoProducto::ctrMostrarTipoProducto($item,$valor);
                            foreach($tipoProducto as $valor => $value){
                              echo'<option value="'.$value["idtipoproducto"].'">'.$value["tipoproducto"].'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <!-- ENTRADA PARA IVA SELECCIONAR -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-check"></i></span>
                        <select name="editarivaProductoSel" id="editarivaProductoSel"  onchange="txtValoIVAed ()" class='form-control' required="" aria-required="true">
                          <option value="">Seleccionar iva</option>
                          <option value="1" id="edPsel1">Si</option>
                          <option value="0" id="edPsel0">No</option>
                        </select>
                      </div>
                    </div>
                    <!-- ENTRADA PARA VALOR IVA -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" id="editIVA"><i class="fa fa-pencil"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="3" onKeyPress="return Numeros(event)" id="editarValorIva" onpaste="return false" oncut="return false" oncopy="return false" name="editarValorIva" placeholder="Ingresar valor iva %" required>
                      </div>
                    </div>
                  <!--PIE DEL MODAL-->
                  <div class="modal-footer">
                    <button type="button" class="btn btn pull-left btn-cancelar-upd-producto"><i class="fa fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-upd-producto" id="btn-upd-producto"><i class="fa fa-pencil"></i> Modificar</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>