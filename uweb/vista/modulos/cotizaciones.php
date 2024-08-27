<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrar cotizaciones
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar cotizaciones</li>
    </ol>
  </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a href="cotizacion">
                    <button class="btn btn-primary"> Agregar cotización</button>
                </a>
                <button name="btn_upd_actualizarCot" id="btn_upd_actualizarCot" class="btn btn-primary " title="Actualizar"><span class="glyphicon glyphicon-refresh"></span></button>
                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span><i class="fa fa-calendar"></i> Rango de fecha</span>
                    <i class="fa fa-caret-down"></i>
                </button>        
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas cotizacionesVenProd rangoFechas" id="cotizacionesVenProd">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Código factura</th>
                            <th>Cliente</th>
                            <th>Cédula</th>
                            <th>Vendedor</th>
                            <th>Forma de pago</th>
                            <th>Total</th> 
                            <th>Fecha</th>
                            <th>Fecha vencimiento</th>
                            <th>Acciones</th>
                        </tr> 
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Modal ver cotizacion-->
        <div id="modalVerCotizacion" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <!-- cabeza del Modal-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Datos cotización</h4>
              </div>
              <!-- cuerpo del Modal-->
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <!-- cuerpo del Modal-->
                    <div class="modal-body">
                      <table width="1000" height="500"  border="0" align="center">
                        <tbody>
                          <tr style="position:absolute;top:0.0in;left:0.3in;line-height:0.4in;">
                            <td>
                              <label for="numeroCotizacion">COTIZACIÓN N°</label>
                              <strong id="numeroCot"></strong>
                            </td>
                          </tr>
                          <tr>
                            <td style="position:absolute;top:0.4in;left:0.3in;line-height:0.4in;">
                              <label for="fechaCot">Fecha:</label>
                              <strong id="fechaCotInicio"></strong>
                            </td>
                          </tr>
                          <tr>
                            <td style="position:absolute;top:0.8in;left:0.3in;line-height:0.4in;">
                              <label for="venceCot">Vence:</label>
                              <strong id="fechaVencimientoCot"></strong>
                            </td>
                          </tr>
                          <tr>
                            <td style="position:absolute;top:1.2in;left:0.3in;line-height:0.4in;">
                              <label for="venceCot">Ciudad:</label>
                              <strong id="ClienteCiudad"></strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <strong>
                                <div class="container">
                                  <div class="row" style="position:absolute;top:1.6in;left:0.3in;line-height:0.4in;width:560px;">
                                    <div class="col-sm-3" style="background-color:#18c4f4;">Cliente:</div>
                                    <div class="col-sm-2" style="background-color:#18c4f4;">Nit:</div>
                                    <div class="col-sm-2" style="background-color:#18c4f4;">Teléfono:</div>
                                    <div class="col-sm-5" style="background-color:#18c4f4;">Direción:</div>
                                  </div>
                                </div>
                              </strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              ​​<font size="2" >
                                <div class="container">
                                  <div  class="row" style="position:absolute;top:2.0in;left:0.3in;line-height:0.4in;width:560px;">
                                    <div class="col-sm-3" style="background-color:#FFFFFF;"><p id="ClienteCotnombre"></p></div>
                                    <div class="col-sm-2" style="background-color:#FFFFFF;"><p id="ClienteNit"></p></div>
                                    <div class="col-sm-2" style="background-color:#FFFFFF;"><p id="ClienteTelefono"></p></div>
                                    <div class="col-sm-5" style="background-color:#FFFFFF;"><p ​align="right" id="ClienteDireccion"></p></div>
                                  </div>
                                </div>
                              </font>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div style="position:absolute;top:2.4in;left:0.3in;line-height:0.4in;width:560px;">
                              <table  class="table table-bordered table-striped dt-responsive tablaCotizacionVista" id="tablaCotizacionVista" width="100%">
                                <thead>
                                  <tr>
                                    <th style="width:10px">#</th>
                                    <th>Detalle</th>
                                    <th>Cantidad</th>
                                    <th>Valor unitario</th>
                                    <th>Valor Total</th>
                                  </tr>
                                </thead>
                              </table>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <tr>
                        <td>
                          <strong>
                            <div class="container">
                              <div  class="row" style="position:absolute;top:5.0in;left:0.3in;line-height:0.3in;width:560px;">
                                <div class="col-sm-2" style="background-color:#18c4f4;">Estado:</div>
                                <div class="col-sm-3" style="background-color:#18c4f4;">Subtotal:</div>
                                <div class="col-sm-3" style="background-color:#18c4f4;">Total:</div>
                                <div class="col-sm-4" style="background-color:#18c4f4;">Medio de pago:</div>
                              </div>
                            </div>
                          </strong>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="container">
                            <div class="row" style="position:absolute;top:5.30in;left:0.3in;line-height:0.3in;width:560px;">
                              <div class="col-sm-2" style="background-color:#FFFFFF;"><p id="estadoCoti"></div>
                              <div class="col-sm-3" style="background-color:#FFFFFF;"><p id="subtotalCoti"></div>
                              <div class="col-sm-3" style="background-color:#FFFFFF;"><p id="totalCoti"></div>
                              <div class="col-sm-4" style="background-color:#FFFFFF;"><p id="medioPagoCot"></div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </div>
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
    </section>
</div>