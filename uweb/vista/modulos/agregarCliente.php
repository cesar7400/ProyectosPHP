
<?php
  require_once "controlador/cliente.controlador.php";
  require_once "modelo/cliente.modelo.php";
?>
<div class="content-wrapper">
  <section class="content-header">
    <h3>Registro de clientes</h3>
  </section>
  <section class="content">
    <div class="box">
      <div class="panel-heading">
        <h4>
          <i class="fa fa-edit"></i>Agregar Cliente<span class="pull-right"></span>
          </h4>
        </div>
          <div class="box-body">
          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="frmClienteNuevo"> 
              
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Nombres: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-user form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="50" class="form-control" name="nuevoNombreCliente"  id="nuevoNombreCliente" autocomplete="off" style="border-radius: 15px" placeholder="Ingresar nombre(s)" required>
                  <div class="text-danger" id="errorNombreCliente"></div>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Apellidos: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-user form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="50" class="form-control" name="nuevoApellidoCliente"  id="nuevoApellidoCliente" autocomplete="off" style="border-radius: 15px" placeholder="Ingresar apellido(s)" required>
                  <div class="text-danger" id="errorApellidoCliente"></div>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Cédula: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-address-card form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="15" class="form-control validarCedula" name="nuevoCedulaCliente" id="nuevoCedulaCliente" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar cédula" required>
                  <div class="text-danger" id="errorCedulaCliente"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Nit: <span class="symbol required"><label id="dv"></label></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-address-book form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="15" class="form-control nit" name="nuevoNitCliente" id="nuevoNitCliente" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar nit" required>
                  <div class="text-danger" id="errorNitCliente"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Tipo cliente: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <select name="nuevoTipoCliente" id="nuevoTipoCliente" class='form-control' required="" aria-required="true">
                    <option value="">Seleccionar tipo cliente</option>
                    <?php
                    $tipoCLiente = ControladorCliente::ctrVerTipoCliente();
                    foreach($tipoCLiente as $valor => $value){
                      echo'<option value="'.$value["idtipocliente"].'">'.$value["tipocliente"].'</option>';
                    }
                    ?>
                  </select>
                  <i class="fa fa-check form-control-feedback"></i>
                  <div class="text-danger" id="errorTipoCliente"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Email: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-envelope-o form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="30" class="form-control validarEmail" name="nuevoEmailCliente" id="nuevoEmailCliente" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar email" required>
                  <div class="text-danger" id="errorEmailCliente"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Teléfono: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-phone form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="13" class="form-control telefono" name="nuevoTelefonoCliente" id="nuevoTelefonoCliente" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar teléfono" required>
                  <div class="text-danger" id="errorTelefonoCliente"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Celular: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-mobile form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="19" class="form-control celular" name="nuevoCelularCliente" id="nuevoCelularCliente" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar cedular" required>
                  <div class="text-danger" id="errorCelularCliente"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Ciudad: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-building form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="30" class="form-control" name="nuevoCiudadCliente" id="nuevoCiudadCliente" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar ciudad" required>
                  <div class="text-danger" id="errorCiudadCliente"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Dirección: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-map-marker form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="40" class="form-control" name="nuevoDireccionCliente" id="nuevoDireccionCliente" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar dirección" required>
                  <div class="text-danger" id="errorDireccionCliente"></div>
                </div>
              </div>

              <div class="modal-footer"> 
                <button class="btn btn-danger" id="btn-cancelar-cliente-add" name="btn-cancelar-cliente-add"><span class="fa fa-times"></span> Cancelar</button>
                <button name="btn-submit_add_cliente" id="btn-submit_add_cliente" class="btn btn-primary btn-user-add"><i class="fa fa-save"></i> Ingresar</button> 
                <a href="verClientes" class="btn btn-success"><span class="fa fa-mail-reply "></span> Regresar</a>
              </div>
              <div id="mensaje"></div>
            </form>
          </div>
      </div>
    </section>
</div>