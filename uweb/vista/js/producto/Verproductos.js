$('.tablaProductos').ready(function(){
    //CARGAR TABLA DINÁMICA
    var tablaProductos = $('.tablaProductos').DataTable({
        "ajax":"ajax/productos/verProductos.ajax.php",
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                render: function(data, type, row){
                    return '<button class="btn btn-success btn-xs btnVerProducto" idverProudcto="'+row[10]+'" data-toggle="modal" data-target="#modalVerProducto" title="Ver cliente"><i class="fa fa-search-plus"></i></button>'
                          +'<button class="btn btn-primary btn-xs btnSeleccionarProducto" id_producto="'+row[10]+'" title="Editar producto"><i class="fa fa fa-pencil"></i></button>'
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
    $('.tablaProductos tbody').on('click','button.btnVerProducto',function(){
        var idverProudcto = $(this).attr("idverProudcto");
        var datos = new FormData();
        datos.append("idverProudctoSel",idverProudcto);
        $.ajax({
            type : 'POST',
            url  : "ajax/productos/verProductoSeleccionado.ajax.php",
            data : datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                    swal({
                        type: "error",
                        title: "Error al consultar el producto.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }else{
                    //se muestra el form modal con la informacion del cliente seleccionado
                    $("#modalVerProducto").modal("show");
                    $("#verCodigoP").html(" "+respuesta["codigo"]);
                    $("#verNombreP").html(" "+respuesta["nombre"]);
                    $("#VerDescripcionP").html(" "+respuesta["descripcion"]);
                    $("#VerValorP").html(" "+respuesta["valor"]);
                    $("#verIvaP").html(" "+respuesta["iva"]+'%');
                    $("#VerIVAvalor").html(" "+respuesta["valoriva"]);
                    $("#VertipoP").html(" "+respuesta["tipoproducto"]);
                    $("#VerFechaIng").html(" "+respuesta["fechaingreso"]);
                    if(respuesta["fechamodificacion"] ==""){
                        $("#verFechaMod").html("");
                    }else{
                        $("#verFechaMod").html(" "+respuesta["fechamodificacion"]);
                    }
                }
            }
        });
    })
    //actualizar tabla productos
    $('#btn_upd_productos').on('click',function(e){
        tablaProductos.ajax.reload(null, false);
    })
})