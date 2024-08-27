$('.tablaCliente').ready(function(){
    //CARGAR TABLA DINÁMICA
    var tablaClientes = $('.tablaCliente').DataTable({
        "ajax":"ajax/clientes/verClientes.ajax.php",
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    return '<button class="btn btn-success btn-xs btnVerClientes" idverCliente="'+row[11]+'" data-toggle="modal" data-target="#modalVerClientes" title="Ver cliente"><i class="fa fa-search-plus"></i></button>'
                          +'<button class="btn btn-primary btn-xs btnSeleccionarCliente" id_cliente="'+row[11]+'" title="Editar cliente"><i class="fa fa fa-pencil"></i></button>'
                }
            },
        ],
        "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
    //ver cliente seleccionado
    $('.tablaCliente tbody').on('click','button.btnVerClientes',function(){
        var idCliente = $(this).attr("idverCliente");
        var datos = new FormData();
        datos.append("idVerClienteSel",idCliente);
        $.ajax({
            type : 'POST',
            url  : "ajax/clientes/verClienteSeleccionado.ajax.php",
            data : datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                    swal({
                        type: "error",
                        title: "Error al consultar el cliente.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }else{
                    //se muestra el form modal con la informacion del cliente seleccionado
                    $("#modalVerCliente").modal("show");
                    $("#VernombreClie").html(" "+respuesta["nombres"]);
                    $("#VerapellidoClie").html(" "+respuesta["apellidos"]);
                    $("#VercedulaClie").html(" "+respuesta["cedula"]);
                    $("#VerNitClie").html(" "+respuesta["nit"]);
                    $("#VerEmailClie").html(" "+respuesta["email"]);
                    $("#VerTipoClie").html(" "+respuesta["tipocliente"]);
                    $("#VerTelefonoClie").html(" "+respuesta["telefono"]);
                    $("#VerCelularClie").html(" "+respuesta["celular"]);
                    $("#VerCiudadClie").html(" "+respuesta["ciudad"]);
                    $("#VerDireccionClie").html(" "+respuesta["direccion"]);
                    $("#verFechaingresoClie").html(" "+respuesta["fechaingreso"]);
                    if(respuesta["fechamodificacion"] ==""){
                        $("#verFechamodificacionClie").html("");
                    }else{
                        $("#verFechamodificacionClie").html(" "+respuesta["fechamodificacion"]);
                    }
                }
            }
        });
    })
    //actualizar tabla usuarios
    $('#btn_upd_clientes').on('click',function(e){
        tablaClientes.ajax.reload(null, false);
    })
})