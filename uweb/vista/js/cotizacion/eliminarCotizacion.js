//eliminar Cotización
$('.cotizacionesVenProd').ready(function(){
    $('.cotizacionesVenProd').DataTable();
    $('.cotizacionesVenProd tbody').on('click','button.btnEliminarCot',function(){
        var idEliminarCotizacion = $(this).attr("idEliminarCotizacion");
        //para tomar el valor de la fila en resoluciones pequeñas
        var row = $(this).closest('tr').index();
        swal({
            title: "¿Está seguro eliminar la cotización "+idEliminarCotizacion+" ?",
            text: "¡Si no está seguro puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar cotización!"
        }).then(function(result){
            if(result.value){
                var datos = new FormData();
                datos.append("IdCotizacionEliminar",idEliminarCotizacion);
                $.ajax({
                    url:"ajax/cotizacion/eliminarCotizacion.ajax.php",
                    method:"POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){
                        if(respuesta == "ok"){
                            if(window.matchMedia("(min-width:992px)").matches){
                                document.getElementById("cotizacionesVenProd").deleteRow(row+1);
                            }else{
                                document.getElementById("cotizacionesVenProd").deleteRow(row);
                            }
                            swal({
                                type: "success",
                                title: "Cotización "+idEliminarCotizacion+" ha sido eliminada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then(function(result){
                                if(result.value){
                                    window.location="cotizaciones";
                                }
                            })
                        }else if(respuesta == "errorBorrar" || respuesta == "errorConexion"){
                            swal({
                                type: "error",
                                title: "Error al eliminar cotización.<br>No es posible la conexión con el servidor.",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then(function(result){
                                if(result.value){
                                }
                            })
                        }
                    }
                });
            }
        })
    })
});