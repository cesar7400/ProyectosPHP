<?php
require_once "controlador/tipoProducto.controlador.php";
require_once "modelo/tipoProducto.modelo.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>Nuevo producto</h3>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="panel-heading">
          <h4>
            <i class="fa fa-edit"></i>Agregar Producto<span class="pull-right">
          </h4>
        </div>
          <div class="box-body">
          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="frmProductoNuevo"> 
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Código: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <input type="text" maxlength="20" class="form-control validarCodigoProducto" onKeyPress="return Numeros(event)" name="nuevocodigoProducto" id="nuevocodigoProducto" autocomplete="off" placeholder="Ingresar código producto" required="" aria-required="true">
                  <div class="text-danger" id="errorcodigoBarras"></div>
                  <i class="fa fa-barcode form-control-feedback"></i>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Nombre: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <input type="text" maxlength="50" class="form-control" name="nuevonombreProducto"  id="nuevonombreProducto" onKeyUp="this.value=this.value.toLowerCase();" autocomplete="off" placeholder="Ingresar nombre producto" required="" aria-required="true">
                  <div class="text-danger" id="errornombreProducto"></div>
                  <i class="fa fa-product-hunt form-control-feedback"></i>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Descripción : <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <input type="text" maxlength="50" class="form-control" name="nuevodescripcionProducto"  id="nuevodescripcionProducto" onKeyUp="this.value=this.value.toLowerCase();" autocomplete="off" placeholder="Descripción producto" required="" aria-required="true">
                  <div class="text-danger" id="errordescripcionProducto"></div>
                  <i class="fa fa-pencil form-control-feedback"></i>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Valor: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <input type="text" maxlength="20" class="form-control" onKeyPress="return Numeros(event)" name="nuevovalorProducto" id="nuevovalorProducto" autocomplete="off" placeholder="Ingresar valor producto" required="" aria-required="true">
                  <div class="text-danger" id="errorValor"></div>
                  <i class="fa fa-barcode form-control-feedback"></i>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Tipo producto: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <select name="nuevoTipoProducto" id="nuevoTipoProducto" class='form-control' required="" aria-required="true">
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
                  <div class="text-danger" id="errorCategoria"></div>
                  <i class="fa fa-check form-control-feedback"></i>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">IVA: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <select name="ivaProductoSel" id="ivaProductoSel" onchange="txtValoIVA()" class='form-control' required="" aria-required="true">
                    <option value="">Seleccionar iva</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                  </select>
                  <div class="text-danger" id="errorIva"></div>
                  <i class="fa fa-check form-control-feedback"></i>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label  id="lbliva" style="visibility:hidden" class="col-sm-2 col-sm-2 control-label">Valor iva %: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <input type="text" maxlength="3" class="form-control"  style="visibility:hidden" onKeyPress="return Numeros(event)" name="nuevoValorIVAProducto"  id="nuevoValorIVAProducto"  autocomplete="off" placeholder="Valor IVA %" required="" aria-required="true">
                  <div class="text-danger" id="errorValorIvaProducto"></div>
                  <i class="fa fa-pencil form-control-feedback"></i>
                </div>
              </div>
              <div class="modal-footer"> 
                <button class="btn btn-danger" id="btn-cancelar-product" name="btn-cancelar-product"><span class="fa fa-times"></span> Cancelar</button> 
                <button type="submit" name="btn-submit_add_product" id="btn-submit_add_product" class="btn btn-primary btn-user"><i class="fa fa-save"></i> Ingresar</button> 
                <a href="producto" class="btn btn-success"><span class="fa fa-mail-reply "></span> Regresar</a>
              </div>
              <div id="mensaje"></div>
            </form>
          </div>
      </div>
    </section>
</div>