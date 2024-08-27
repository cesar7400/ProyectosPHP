<?php
  require_once "controlador/cliente.controlador.php";
  require_once "modelo/cliente.modelo.php";
?>
<div class="content-wrapper">
  <section class="content-header">
    <h3>Clientes</h3>
  </section>
    <section class="content">
      <div class="box">
        <div class="panel-heading">
          <h4><i class="fa fa-user"></i> Consulta de Clientes<span class="pull-right">
              <a href="agregarCliente" class="btn btn-primary" title="Agregar usuario">Agregar Cliente</a>
              <button name="btn_upd_clientes" id="btn_upd_clientes" class="btn btn-primary " title="Actualizar"><span class="glyphicon glyphicon-refresh"></span></button></span>
          </h4>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablaCliente" id="tablaCliente" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Nit</th>
                <th>Email</th>
                <th>Tipo cliente</th>
                <th>Teléfono</th>
                <th>Celular</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
        <!--Modal ver cliente-->
        <div id="modalVerCliente" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <!-- cabeza del Modal-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Datos del Cliente</h4>
              </div>
              <!-- cuerpo del Modal-->
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <table width="547" border="0" align="center">
                      <tbody>
                        <tr>
                          <td><strong>Nombres:</strong> <strong id="VernombreClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Apellidos:</strong> <strong id="VerapellidoClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Cédula:</strong> <strong id="VercedulaClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Nit:</strong> <strong id="VerNitClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Email:</strong> <strong id="VerEmailClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Tipo cliente:</strong> <strong id="VerTipoClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Teléfono:</strong> <strong id="VerTelefonoClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Celular:</strong> <strong id="VerCelularClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Ciudad:</strong> <strong id="VerCiudadClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Dirección:</strong> <strong id="VerDireccionClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Fecha ingreso:</strong> <strong id="verFechaingresoClie"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Fecha modificación:</strong> <strong id="verFechamodificacionClie"></strong></td>
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
        <!--MODAL EDITAR CLIENTE-->
        <div id="modalEditarCliente" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <form role="form" method="post" enctype="multipart/form-data" id="frmEditarCliente">
                <!--CABEZA DEL MODAL-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar cliente</h4>
                </div>
                <!--CUERPO DEL MODAL-->
                <div class="modal-body">
                  <div class="box-body">
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarNombresClie" onpaste="return false" oncut="return false" oncopy="return false" name="editarNombresClie" placeholder="Ingresar nombre(s)" required>
                        <div class="text-danger" id="eerrorNombresClie"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA APELLIDOS -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarApellidosClie" onpaste="return false" oncut="return false" oncopy="return false" name="editarApellidosClie" placeholder="Ingresar apellidos" required>
                        <div class="text-danger" id="errorApellidosClie"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA CÉDULA -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="14" id="editarCedulaClie" onpaste="return false" oncut="return false" oncopy="return false" name="editarCedulaClie" placeholder="Ingresar cédula" required>
                        <div class="text-danger" id="errorCedulaClie"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA NIT -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                        <input type="text" class="form-control input-lg nit" autocomplete="off" maxlength="14" id="editarNitClie" onpaste="return false" oncut="return false" oncopy="return false" name="editarNitClie" placeholder="Ingresar nit" required>
                        <span class="input-group-addon"><label id="dv"></label></span>
                        <div class="text-danger" id="errorNitClie"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA EL EMAIL -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> 
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarEmailClie" onpaste="return false" oncut="return false" oncopy="return false" name="editarEmailClie" placeholder="Ingresar email" required>
                      </div>
                    </div>
                    <!-- TIPO CLIENTE -->
                    <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-check-circle"></i></span>
                        <select name="EditarTipoCliente" id="EditarTipoCliente" class='form-control' required="" aria-required="true">
                          <option value="">Seleccionar tipo cliente</option>
                          <?php
                            $tipoCLiente = ControladorCliente::ctrVerTipoCliente();
                            foreach($tipoCLiente as $valor => $value){
                              echo'<option value="'.$value["idtipocliente"].'">'.$value["tipocliente"].'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <!-- ENTRADA PARA TELÉFONO -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control input-lg telefono" autocomplete="off" maxlength="13" id="editarTelefonoClie" onpaste="return false" oncut="return false" oncopy="return false" name="editarTelefonoClie" placeholder="Ingresar teléfono" required>
                      </div>
                    </div>
                    <!-- ENTRADA PARA CELULAR -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 
                        <input type="text" class="form-control input-lg celular" autocomplete="off" maxlength="19" id="editarCelularClie" name="editarCelularClie" onpaste="return false" oncut="return false" oncopy="return false" placeholder="Ingresar celular" required>
                      </div>
                    </div>
                    <!-- ENTRADA CIUDAD -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building"></i></span> 
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="20" id="editarCiudadClie" name="editarCiudadClie" onpaste="return false" oncut="return false" oncopy="return false" placeholder="Ingresar ciudad" required>
                      </div>
                    </div>  
                    <!-- ENTRADA DIRECCION -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="40" id="editarDireccionClie" name="editarDireccionClie" onpaste="return false" oncut="return false" oncopy="return false" placeholder="Ingresar dirección" required>
                      </div>
                    </div>  
                  </div>
                  <!--PIE DEL MODAL-->
                  <div class="modal-footer">
                    <button type="button" class="btn btn pull-left btn-cancelar-upd-cliente"><i class="fa fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-upd-cliente" id="btn-upd-cliente"><i class="fa fa-pencil"></i> Modificar cliente</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </section>
</div>