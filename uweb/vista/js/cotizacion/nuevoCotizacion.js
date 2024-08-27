var IdCotizacion;
$("#nuevoMetodoPago").prop('disabled',true);
$("#btn_guardar_cotizacion").prop('disabled',true);

//editar cotización
if($("#IDCotClieED").val() !=null){
    $(".editaCotz").text("Editar cotización");
    $("#seleccionarCliente").prop('disabled',true);
    selecClienteCot();
}

function selecClienteCot(){
    
    var rmv = $(".dataP");
    rmv.remove();
    var idClienteCot = document.getElementById("seleccionarCliente").value;
    if(idClienteCot==""){
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total",0);
        $(".estadoBoton").removeClass('btn-default');
        $(".estadoBoton").addClass('btn-primary agregarProducto');

        $("#nuevoMetodoPago").prop('disabled',true);
        $(".codt").remove();
        $("#nuevoMetodoPago").prop('selectedIndex', 0);
        $("#capturarCambioEfectivo").remove();
        $("#capturarValorEfectivo").remove();
        $("#nuevoCodigoTransaccion").remove();
        $("#btn_guardar_cotizacion").prop('disabled',true);
        document.getElementById("btn_guardar_cotizacion").innerHTML ="Guardar cambios cotización";
        return;
    }else{
        var datos = new FormData();
        datos.append("idClienteCot", idClienteCot);
        $.ajax({
            url:"ajax/cotizacion/agregarClienteCot.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                if(respuesta == "errorConexion" || respuesta == "errorAgregar"){
                    $("#btn-submit_add_product").html('<span class="fa fa-save"></span> Ingresar');
                    swal({
                        type: "error",
                        title: "No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }else{
                    IdCotizacion=respuesta;
                    cargarProductosCot(respuesta)
                }
            }
        });
    }
}
function cargarProductosCot(idCot){
    var datos = new FormData();
    datos.append("IdCotizacion", idCot);
    datos.append("idProcot","");
    datos.append("detalleProdCot", "");
    datos.append("cantidadProdCot", "");
    datos.append("valorProCot", "");
    datos.append("opcion", "2");
    $.ajax({
        url:"ajax/cotizacion/agregarProductoCot.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            if(respuesta == "errorConexion" || respuesta == "errorConsulta"){
                $("#btn-submit_add_product").html('<span class="fa fa-save"></span> Ingresar');
                swal({
                    type: "error",
                    title: "No es posible la conexión con el servidor.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
            }else{
                $("#nuevoTotalVenta").val(0);
                $("#totalVenta").val(0);
                $("#nuevoTotalVenta").attr("total",0);
                $(".estadoBoton").removeClass('btn-default');
                $(".estadoBoton").addClass('btn-primary agregarProducto');
                if(respuesta !=""){
                    var rmv = $(".dataP");
                    rmv.remove();
                    respuesta.forEach(funcionForEach);
                    function funcionForEach(item, index){
                        $(".nuevoProducto").append(
                            '<div class="row dataP" style="padding:5px 15px">'+
                                '<!-- Descripción del producto -->'+
                                    '<div class="col-xs-6" style="padding-right:0px">'+
                                        '<div class="input-group">'+
                                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idCotizacion="'+item[0]+'" idProducto="'+item[1]+'"><i class="fa fa-times"></i></button></span>'+
                                            '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+item[1]+'" name="agregarProducto" value="'+item[2]+'" readonly required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<!-- Cantidad del producto -->'+
                                    '<div class="col-xs-3">'+
                                        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'+item[3]+'" required>'+
                                    '</div>'+
                                    '<!-- Precio del producto -->'+
                                    '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
                                        '<div class="input-group">'+
                                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
                                                '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+item[4]+'" name="nuevoPrecioProducto" value="'+item[5]+'" readonly required>'+
                                        '</div>'+
                                    '</div>'+
                            '</div>');
                            $(".estbtn"+item[1]+"").removeClass('btn-primary agregarProducto');
                            $(".estbtn"+item[1]+"").addClass('btn-default');
                    }
                    //AGRUPAR PRODUCTOS EN FORMATO JSON
                    listarProductos();
                    //SUMAR TOTAL DE PRECIOS
                    sumarTotalPrecios();
                    //formato numerico
                    $(".nuevoPrecioProducto").number(true, 0);
                    $("#nuevoTotalVenta").number(true, 0);
                }else{
                    var rmv = $(".dataP");
                    rmv.remove();
                    $("#nuevoMetodoPago").prop('disabled',true);
                    $(".codt").remove();
                    $("#nuevoMetodoPago").prop('selectedIndex', 0);
                    $("#capturarCambioEfectivo").remove();
                    $("#capturarValorEfectivo").remove();
                    $("#nuevoCodigoTransaccion").remove();
                    $("#btn_guardar_cotizacion").prop('disabled',true);
                    document.getElementById("btn_guardar_cotizacion").innerHTML ="Guardar cambios cotización";
                }
            }
        }
    });
}
/*AGREGAR PRODUCTO MODO NORMAL*/
$(".tablaCotizacionProductosVenta tbody").on("click", "button.agregarProducto", function(){

    var idClienteCot = document.getElementById("seleccionarCliente").value;
    if(idClienteCot==""){
        swal({
            type: "info",
            title: "Seleccionar cliente",
            showConfirmButton: true,
            confirmButtonText: "Aceptar",
            closeOnConfirm: false
        });
    }else{
        var idProductoCotizacion = $(this).attr("idProductoCotizacion");
        var valorProductoCot = $(this).attr("valorProductoCot");
        var nombreProductoCot = $(this).attr("nombreProductoCot");
        $(this).removeClass("btn-primary agregarProducto");
        $(this).addClass("btn-default");
        var datos = new FormData();
        datos.append("IdCotizacion", IdCotizacion);
        datos.append("idProcot", idProductoCotizacion);
        datos.append("detalleProdCot", nombreProductoCot);
        datos.append("cantidadProdCot", "1");
        datos.append("valorProCot", valorProductoCot);
        datos.append("opcion", "1");
        $.ajax({
            url:"ajax/cotizacion/agregarProductoCot.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                if(respuesta == "ok"){
                    $(".nuevoProducto").append(
                        '<div class="row dataP" style="padding:5px 15px">'+
                        '<!-- Descripción del producto -->'+
                        '<div class="col-xs-6" style="padding-right:0px">'+
                          '<div class="input-group">'+
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idCotizacion="'+IdCotizacion+'" idProducto="'+idProductoCotizacion+'"><i class="fa fa-times"></i></button></span>'+
                            '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProductoCotizacion+'" name="agregarProducto" value="'+nombreProductoCot+'" readonly required>'+
                          '</div>'+
                        '</div>'+
                        '<!-- Cantidad del producto -->'+
                        '<div class="col-xs-3">'+
                           '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" required>'+
                        '</div>' +
                        '<!-- Precio del producto -->'+
                        '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
                          '<div class="input-group">'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+valorProductoCot+'" name="nuevoPrecioProducto" value="'+valorProductoCot+'" readonly required>'+
                          '</div>'+
                        '</div>'+
                      '</div>');
	                 //SUMAR TOTAL DE PRECIOS
                    sumarTotalPrecios();
                    //AGRUPAR PRODUCTOS EN FORMATO JSON
                    listarProductos();
	                //PONER FORMATO AL PRECIO DE LOS PRODUCTOS
                    $(".nuevoPrecioProducto").number(true, 0);
                    $("#nuevoTotalVenta").number(true, 0);
                }
                if(respuesta == "errorConexion" || respuesta == "errorAgregar"){
                    $("#btn-submit_add_product").html('<span class="fa fa-save"></span> Ingresar');
                    swal({
                        type: "error",
                        title: "No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
            }
        });
    }
});
/*AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS MOVILES*/
$(".btnAgregarProducto").click(function(){

    var idClienteCot = document.getElementById("seleccionarCliente").value;
    if(idClienteCot==""){
        swal({
            type: "info",
            title: "Seleccionar cliente",
            showConfirmButton: true,
            confirmButtonText: "Aceptar",
            closeOnConfirm: false
        });
    }else{
        $.ajax({
            url:"ajax/cotizacion/cotizacionProductos.ajax.php",
              method: "POST",
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  if(respuesta!="errorConexion" || respuesta!="errorConsulta"){
                    $(".nuevoProducto").append(
                        '<div class="row dataP" style="padding:5px 15px">'+
                        '<!-- Descripción del producto -->'+
                        '<div class="col-xs-6 idprcot" style="padding-right:0px">'+
                          '<div class="input-group">'+
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idCotizacion="'+IdCotizacion+'" idProducto=""><i class="fa fa-times"></i></button></span>'+
                            '<select class="form-control select2 nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" id="nuevaDescripcionProducto" required>'+
                            '<option>Seleccione el producto</option>'+
                            '</select>'+  
                          '</div>'+
                        '</div>'+
                        '<!-- Cantidad del producto -->'+
                        '<div class="col-xs-3 ingresoCantidad">'+
                           '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" cantProd required>'+
                        '</div>' +
                        '<!-- Precio del producto -->'+
                        '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
                          '<div class="input-group">'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+
                          '</div>'+
                        '</div>'+
                      '</div>');
                    //AGREGAR LOS PRODUCTOS AL SELECT
                    respuesta.data.forEach(funcionForEach);
                    function funcionForEach(item, index){
                        $(".nuevaDescripcionProducto").append('<option idProducto="'+item[6]+'" value="'+[item[6],item[4],item[2]]+'">'+item[2]+'</option>');
                    }
                    //SUMAR TOTAL DE PRECIOS
                    sumarTotalPrecios();
                    //PONER FORMATO AL PRECIO DE LOS PRODUCTOS
                    //AGRUPAR PRODUCTOS EN FORMATO JSON
                    listarProductos();
                    $(".nuevoPrecioProducto").number(true, 0);
                    $("#nuevoTotalVenta").number(true, 0);
                }else{
                    swal({
                        type: "error",
                        title: "Error al seleccionar producto.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
              }
        });
    }
});
/*SELECCIONAR PRODUCTO(DISPOSITIVO MOVIL*/
$(".formularioCotizacion").on("change", "select.nuevaDescripcionProducto", function(){

    var ProductoCot = $(this).val();
    var cmb = $(this);
	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    var idProducto = $(this).parent().parent().parent().children(".idprcot").children().children().children(".quitarProducto");

    var datos = new FormData();
    datos.append("IdCotizacion", IdCotizacion);
    datos.append("idProcot", ProductoCot.split(',')[0]);
    datos.append("detalleProdCot", ProductoCot.split(',')[2]);
    datos.append("cantidadProdCot", "1");
    datos.append("valorProCot", ProductoCot.split(',')[1]);
    datos.append("opcion", "1");

	$.ajax({
        url:"ajax/cotizacion/agregarProductoCot.ajax.php",
        method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
        processData: false,
        dataType:"json",
      	success:function(respuesta){
            if(respuesta > 0){
                cmb.prop('selectedIndex',0)
                swal({
                    type: "info",
                    title: "Producto ya esta en lista.",
                    showConfirmButton: true,
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                });
            }else{
                if(respuesta == "ok"){
                    $(nuevoPrecioProducto).val(ProductoCot.split(',')[1]);
                    $(nuevoPrecioProducto).attr("precioReal", ProductoCot.split(',')[1]);
                    $(idProducto).attr("idProducto", ProductoCot.split(',')[0]);
                    $(".estbtn"+ProductoCot.split(',')[0]+"").removeClass('btn-primary agregarProducto');
                    $(".estbtn"+ProductoCot.split(',')[0]+"").addClass('btn-default');
                    cmb.prop('disabled',true)
                    //AGRUPAR PRODUCTOS EN FORMATO JSON
                    listarProductos();
                    //SUMAR TOTAL DE PRECIOS
                    sumarTotalPrecios();
                }else{
                    swal({
                        type: "error",
                        title: "Error al seleccionar producto.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
            }
      	}
    })
})
/*SUMAR TODOS LOS PRECIOS*/
function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];  
	for(var i = 0; i < precioItem.length; i++){
		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
	}
	function sumaArrayPrecios(total, numero){
		return total + numero;
	}
	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
    $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
    if(sumaTotalPrecio > 0 && $("#nuevoValorEfectivo").val()!=""){
        $("#nuevoMetodoPago").prop('disabled',false);
        $("#btn_guardar_cotizacion").prop('disabled',false);
    }
}
/*LISTAR TODOS LOS PRODUCTOS*/
function listarProductos(){
	var listaProductos = [];
	var descripcion = $(".nuevaDescripcionProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");
	for(var i = 0; i < descripcion.length; i++){
		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})
	}
	$("#listaProductos").val(JSON.stringify(listaProductos));
}
//si hay cantidad en cero o vacia por defecto se le asigna '1'
$(".formularioCotizacion").on("mouseup change", "input.nuevaCantidadProducto", function(){
    var txt = $(this);
    if(txt.val()==0 || txt.val()==""){
        txt.val('1');
    }
    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");
    precio.val(precioFinal);
    //cambio de color input
    txt.css("background-color", "yellow");
	// SUMAR TOTAL DE PRECIOS
	sumarTotalPrecios();
    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos();
    //verificar el valor pago
    valorTotalCot();
});
/*MODIFICAR LA CANTIDAD*/
$(".formularioCotizacion").on("mouseup keyup", "input.nuevaCantidadProducto", function(){
    var txt = $(this);
    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");
    precio.val(precioFinal);
    //cambio de color input
    txt.css("background-color", "#aaff55");
	// SUMAR TOTAL DE PRECIOS
	sumarTotalPrecios();
    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos();
    //verificar el valor pago
    valorTotalCot();
    
});
/*QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN*/
$(".formularioCotizacion").on("click", "button.quitarProducto", function(){

    var elmItem = $(this).parent().parent().parent().parent();
    var idProducto = $(this).attr("idProducto");
    var idCotizacion = $(this).attr("idCotizacion");
        
    var datos = new FormData();
    datos.append("idProductoCot", idProducto);
    datos.append("IdCotizacion", idCotizacion);
	$.ajax({
        url:"ajax/cotizacion/eliminarProductoCot.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
            if(respuesta == "ok"){
                elmItem.remove();
                $("button.estadoBoton[idProductoCotizacion='"+idProducto+"']").removeClass('btn-default');
                $("button.estadoBoton[idProductoCotizacion='"+idProducto+"']").addClass('btn-primary agregarProducto');
                $(".estbtn"+idProducto+"").removeClass('btn-default');
                $(".estbtn"+idProducto+"").addClass('btn-primary agregarProducto');
                if($(".nuevoProducto").children().length == 0){
                    $("#nuevoTotalVenta").val(0);
                    $("#totalVenta").val(0);
                    $("#nuevoTotalVenta").attr("total",0);
                    $("#nuevoMetodoPago").prop('disabled',true);
                    $(".codt").remove();
                    $("#nuevoMetodoPago").prop('selectedIndex', 0);
                    $("#capturarCambioEfectivo").remove();
                    $("#capturarValorEfectivo").remove();
                    $("#nuevoCodigoTransaccion").remove();
                    $("#btn_guardar_cotizacion").prop('disabled',true);
                    document.getElementById("btn_guardar_cotizacion").innerHTML ="Guardar cambios cotización";
                }else{
                    //SUMAR TOTAL DE PRECIOS
                    sumarTotalPrecios()
                    //AGRUPAR PRODUCTOS EN FORMATO JSON
                    listarProductos()
                }
            }else{
                swal({
                    type: "error",
                    title: "Error al eliminar producto.<br>No es posible la conexión con el servidor.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
            }
      	}
    })
});

/*SELECCIONAR MÉTODO DE PAGO*/
$("#nuevoMetodoPago").change(function(){
    var metodo = $(this).val();
    var btn = document.getElementById("btn_guardar_cotizacion");
	if(metodo == "Efectivo"){
        btn.innerHTML ="Realizar pago";
		$(this).parent().parent().removeClass("col-xs-6");
		$(this).parent().parent().addClass("col-xs-4");
		$(this).parent().parent().parent().children(".MetodoPago").html(
            '<div class="col-xs-4" id="capturarValorEfectivo">'+ 
			 	'<div class="input-group">'+ 
			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
			 		'<input type="text" class="form-control" onKeyUp="valorTotalCot()" id="nuevoValorEfectivo" autocomplete="off" placeholder="Valor" required>'+
			 	'</div>'+
			'</div>'+
			'<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+
			 	'<div class="input-group">'+
			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+
			 	'</div>'+
			'</div>'
		)
		// Agregar formato al precio
		$('#nuevoValorEfectivo').number( true, 2);
        $('#nuevoCambioEfectivo').number( true, 2);
      	// Listar método en la entrada
        listarMetodos()
        $('#btn_guardar_cotizacion').prop('disabled',true);
	}else{
        btn.innerHTML="Realizar transacción";
		$(this).parent().parent().removeClass('col-xs-4');
		$(this).parent().parent().addClass('col-xs-6');
		$(this).parent().parent().parent().children('.MetodoPago').html(
		 	'<div class="col-xs-6 codt" style="padding-left:0px">'+     
                '<div class="input-group">'+  
                    '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Número transacción"  required>'+ 
                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                '</div>'+
            '</div>')
    }
    if(metodo=="SM"){
        btn.innerHTML="Guardar cambios cotización";
        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().parent().children('.MetodoPago').children().remove();
        document.getElementById('errorDireccionCliente').innerHTML = '';
        $('#btn_guardar_cotizacion').prop('disabled',false);
    }if(metodo=="TC" || metodo=="TD"){
        $('#btn_guardar_cotizacion').prop('disabled',false);
        document.getElementById('errorDireccionCliente').innerHTML = '';
    }
});
/*LISTAR MÉTODO DE PAGO*/
function listarMetodos(){
	if($("#nuevoMetodoPago").val() == "Efectivo"){
		$("#listaMetodoPago").val("Efectivo");
	}else{
		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
	}
}
function valorTotalCot(){
    var valorTotalCot = $("#nuevoTotalVenta").val();
    var valorEfectivo = $("#nuevoValorEfectivo").val();
    if(parseInt(valorTotalCot)>parseInt(valorEfectivo)){
        document.getElementById('errorDireccionCliente').innerHTML = 'Valor insuficiente';
        $("#nuevoCambioEfectivo").val('000000');
        $('#btn_guardar_cotizacion').prop('disabled',true);
    }else if($("#nuevoValorEfectivo").val()!=""){
        
        document.getElementById('errorDireccionCliente').innerHTML = '';
        $("#nuevoCambioEfectivo").val(parseInt(valorEfectivo) - parseInt(valorTotalCot));
        $('#btn_guardar_cotizacion').prop('disabled',false);
    }
}
//guardar cambios cotizacion
$('#btn_guardar_cotizacion').on('click',function(e){
    //comprobar que la fecha sea correcta
    if(/^([0-9]{4}\/[0-9]{2}\/[0-9]{2})$/.test($("#datepickerFechaCot").val()) != true){
        swal({
            type: "info",
            title: "La fecha seleccionada no es válida.",
            showConfirmButton: true,
            confirmButtonText: "Aceptar",
            closeOnConfirm: false
        })
        return false;
    }
    if($("#datepickerFechaCot").val() == ""){
        swal({
            type: "info",
            title: "La fecha no puede ir vacía.",
            showConfirmButton: true,
            confirmButtonText: "Aceptar",
            closeOnConfirm: false
        })
        return false;
    }
    var cmb = document.getElementById("nuevoMetodoPago").value;
    if(($("#nuevoCodigoTransaccion").val() == "") && (cmb == "TC" || cmb == "TD")){
        document.getElementById('errorDireccionCliente').innerHTML = 'Digitar numero tarjeta';
        $("#nuevoCodigoTransaccion").focus();
    }else{
        //verificar campos de cantidad que esten en cero o vacíos
        var cantidadProd = $(".nuevaCantidadProducto");
        for(var i = 0; i < cantidadProd.length; i++){
             if($(cantidadProd[i]).val() == "0" || $(cantidadProd[i]).val()== ""){
                swal({
                    type: "info",
                    title: "Hay campos de cantidad no válidos",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
                return false;
             }
        }
        if(cmb =="TC" || cmb =="TD" || cmb =="Efectivo"){
            swal({
                title: "¿Está seguro guardar la cotización?\nRecuerde que ya podra editarla o eliminarla",
                text: "¡Si no está seguro puede cancelar la acción!",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, guardar cotización!"
            }).then(function(result){
                if(result.value){
                    if(cmb == "Efectivo"){
                        guardarCotizacion(IdCotizacion,cmb,$("#nuevoValorEfectivo").val());
                    }else{
                        guardarCotizacion(IdCotizacion,cmb,$("#nuevoCodigoTransaccion").val());
                    }   
                }
            })
            return false;
        }else{
            guardarCotizacion(IdCotizacion,cmb,"cambio");
            return false;
        }
    }
});

function guardarCotizacion(IdCotizacion,cmb,valor){

    var datos = new FormData();
    datos.append("listaProductos", $("#listaProductos").val());
    datos.append("idCotizacion", IdCotizacion);
    datos.append("totalCotizacion", $("#nuevoTotalVenta").val());
    datos.append("fechaVenciminetoCot", $("#datepickerFechaCot").val());
    datos.append("opcionCotizacion", cmb);
    datos.append("valorP", valor);
    $.ajax({
        url:"ajax/cotizacion/guardarCotizacion.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType:"json",
          beforeSend: function(){
            $("#btn_guardar_cotizacion").prop('disabled',true);
          },
          success:function(respuesta){
            if(respuesta != "ok" || respuesta == "errorCotizacion"){
                var rtaError;
                if(respuesta == "errorCotizacion"){
                    rtaError="Error al guardar";
                }else{
                    rtaError = "Error al realizar cambios.<br>No es posible la conexión con el servidor.";
                }
                swal({
                type: "error",
                title: rtaError,
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
                });
                $("#btn_guardar_cotizacion").prop('disabled',false);
            }else{
                if(cmb == "SM"){
                    swal({
                        type: "info",
                        title: "Los cambios se guardaron con exito.",
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false
                    })
                    $("#btn_guardar_cotizacion").prop('disabled',false);
                }else{
                    swal({
                        type: "success",
                        title: "La cotización se guardo con exito.",
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false
                    }).then(function(result){
                        if(result.value){
                            window.location = "cotizacion";
                        }
                    });
                    $("#btn_guardar_cotizacion").prop('disabled',false);
                }
            }
        }
    })
}