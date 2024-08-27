//ver cotización detalle 
$('.cotizacionesVenProd').ready(function(){
    $('.cotizacionesVenProd tbody').on('click','button.btnVerCotizacion',function(){
        idverCotizacion = $(this).attr("idverCotizacion");
        fechainicial = $(this).attr("fechainicial");
        fechamovimiento = $(this).attr("fechamovimiento");
        IdCotCliente = $(this).attr("IdCotCliente");
        var datos = new FormData();
        datos.append("IdClienteCotVer",IdCotCliente);
        datos.append("idverCotizacion",idverCotizacion);
        datos.append("postDetCot","valorCot");     
        $.ajax({
            type : 'POST',
            url  : "ajax/cotizacion/detalleCotizacion.ajax.php",
            data : datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                    swal({
                        type: "error",
                        title: "Error al consultar la cotización.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }else{
                    //se muestra el form modal con la informacion del cliente seleccionado
                    $("#modalVerCotizacion").modal("show");
                    $("#numeroCot").html(idverCotizacion);
                    $("#fechaCotInicio").html(fechainicial);
                    $("#fechaVencimientoCot").html(fechamovimiento);
                    $("#ClienteCotnombre").html(respuesta["nombres"]+" "+respuesta["apellidos"]);
                    $("#ClienteNit").html(respuesta["nit"].replace("-",""));
                    $("#ClienteTelefono").html(respuesta["telefono"].replace("-","").replace("-",""));
                    $("#ClienteDireccion").html(respuesta["direccion"]);
                    $("#ClienteCiudad").html(respuesta["ciudad"]);
                    if(respuesta['estado']!="0"){
                        $("#estadoCoti").html("Pagada");
                    }else{
                        $("#estadoCoti").html("En curso");
                    }
                    $("#subtotalCoti").html(respuesta["totalcotizacion"]);
                    $("#totalCoti").html(respuesta["totalcotizacion"]);
                    $("#medioPagoCot").html(respuesta["formapago"]);
                    $(".tablaCotizacionVista").dataTable().fnDestroy();
                    detalleProductosCot(idverCotizacion);
                    $("#tablaCotizacionVista_length").remove();
                }
            }
        })
    });
});
function detalleProductosCot(idCotizacion){
    
    $('.tablaCotizacionVista').DataTable({
        "pageLength": 4,
        "bFilter": false,
        "bInfo": false,
        "ajax":{
            "type": 'POST',
            "url":"ajax/cotizacion/detalleCotizacion.ajax.php",
            "data": {"idCotizacion": idCotizacion}
        },
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
    
        }
    
    });
}
