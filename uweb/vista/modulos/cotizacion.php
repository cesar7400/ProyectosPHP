<?php
if(!isset($_SESSION)){
  session_start();
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1 class="editaCotz">Crear cotización</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active editaCotz">Crear cotización</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
        <!--FORMULARIO-->
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border"></div>
                    <form role="form" method="post" class="formularioCotizacion">
                        <div class="box-body">
                            <div class="box">
                                <!--ENTRADA DEL VENDEDOR-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombres"].' '.$_SESSION["apellidos"]; ?>" readonly>
                                        <input type="hidden" name="idVendedor" value="<?php echo '$_SESSION["id"]'; ?>">
                                    </div>
                                </div> 
                                <!--ENTRADA FECHA FINAL--> 
                                <div class="form-group">
                                    <label>Fecha vencimiento:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepickerFechaCot" autocomplete="off">
                                    </div>
                                </div>
                                <!--ENTRADA DEL CLIENTE--> 
                                <div class="form-group">
                                    <input type="hidden" id="editaCotizacion" value="<?php echo $_SESSION["idClienteCot"];?>" name="editaCotizacion">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control select2" id="seleccionarCliente" onchange="selecClienteCot()" name="seleccionarCliente" required>
                                            <option value="">Seleccionar cliente</option>
                                            <?php
                                            $item = null;
                                            $valor = null;
                                            $categorias = ControladorCliente::ctrVerClientes($item, $valor);
                                            foreach ($categorias as $key => $value) {
                                                echo '<option value="'.$value["idcliente"].'">'.$value["nombres"].' '.$value["apellidos"].' '.$value["cedula"].'</option>';
                                                if(isset($_SESSION["idClienteCot"]) && isset($_SESSION["idCotizacionCot"])){
                                                    if ($_SESSION["idClienteCot"] == $value["idcliente"]){
                                                        echo '<option value="'.$value["idcliente"].'" selected>'.$value["nombres"].' '.$value["apellidos"].' '.$value["cedula"].'</option>';
                                                    }
                                                }
                                            }
                                            if(isset($_SESSION["idClienteCot"]) && isset($_SESSION["idCotizacionCot"])){
                                                echo'<input type="hidden" id="IDCotClieED" value="'.$_SESSION["idCotizacionCot"].'">';
                                            }
                                            unset($_SESSION["idClienteCot"]);
                                            unset($_SESSION["idCotizacionCot"]);
                                            ?>
                                        </select>
                                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                                    </div>
                                </div>
                                <!--ENTRADA PARA AGREGAR PRODUCTO--> 
                                <div class="form-group row nuevoProducto">
                                </div>
                                <input type="hidden" id="listaProductos" name="listaProductos">
                                <!--BOTÓN PARA AGREGAR PRODUCTO-->
                                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>
                                <hr>
                                    <div class="row">
                                        <!--ENTRADA  TOTAL-->
                                        <div class="col-xs-8 pull-right">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>total</th>     
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 100%">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                                <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>
                                                            </div>
                                                            <div><label id="errorVentaCotizacion" class="error errorVentaCotizacion"></label></div>
                                                            <div class="text-danger" id="errorDireccionCliente"></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <hr>
                                <!--ENTRADA MÉTODO DE PAGO-->
                                <div class="form-group row">
                                    <div class="col-xs-6" style="padding-right:0px">
                                        <div class="input-group">
                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                <option value="SM">Seleccionar método de pago</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="TC">Tarjeta Crédito</option>
                                                <option value="TD">Tarjeta Débito</option>                  
                                            </select>    
                                        </div>
                                    </div>
                                    <div class="MetodoPago"></div>
                                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button id="btn_guardar_cotizacion" class="btn btn-primary pull-right">Guardar cambios cotización</button>
                        </div>
                    </form>
                </div>  
            </div>
            <!--LA TABLA DE PRODUCTOS-->
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs removeButton">
                <div class="box box-warning">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped dt-responsive tablaCotizacionProductosVenta">
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Valor</th>
                                <th>Tipo producto</th>
                                <th>Acciones</th>
                                </tr>
                            </thead>            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>