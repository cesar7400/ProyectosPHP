//eliminar tipo cliente
$('.tablaTipoCliente').DataTable();
$('.tablaTipoCliente tbody').on('click','button.btnEliminarTipocliente',function(){
    var idtipocli = $(this).attr("idtipocli");
    var tipocliente = $(this).attr("tipocliente");
    //para tomar el valor de la fila en resoluciones pequeñas
    var row = $(this).closest('tr').index();
    swal({
        title: "¿Está seguro eliminar tipo cliente "+tipocliente+" ?",
        text: "¡Si no está seguro puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar tipo cliente!"
    }).then(function(result){
        if(result.value){
            var datos = new FormData();
            datos.append("idTipoCliEl",idtipocli);
            datos.append("tipoClieEl",tipocliente);
            $.ajax({
                url:"ajax/tipocliente/eliminarTipoCliente.ajax.php",
                method:"POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta == "ok"){
                        if(window.matchMedia("(min-width:992px)").matches){
                            document.getElementById("tablaTipoCliente").deleteRow(row+1); 
                        }else{
                            document.getElementById("tablaTipoCliente").deleteRow(row);
                        }
                        swal({
                            type: "success",
                            title: "Tipo cliente "+tipocliente+" ha sido eliminado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(function(result){
                            if(result.value){
                                window.location="tipoCliente";
                            }
                        })
                    }else if(respuesta != ""){
                        swal({
                            type: "info",
                            title: "Tipo cliente "+tipocliente+" está en uso",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: true
                        })
                    }else if(respuesta == "errorEliminar" || respuesta == "errorConexion"){
                        swal({
                            type: "error",
                            title: "Error al eliminar.<br>No es posible la conexión con el servidor.",
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
});