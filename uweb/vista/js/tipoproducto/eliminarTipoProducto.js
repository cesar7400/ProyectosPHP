//eliminar tipo producto
$('.tablaTipoProducto').DataTable();
$('.tablaTipoProducto tbody').on('click','button.btnEliminarTipoproducto',function(){
    var idTipoPro = $(this).attr("idTipoPro");
    var tipoProuducto = $(this).attr("tipoProuducto");
    //para tomar el valor de la fila en resoluciones pequeñas
    var row = $(this).closest('tr').index();
    swal({
        title: "¿Está seguro eliminar tipo producto "+tipoProuducto+" ?",
        text: "¡Si no está seguro puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar tipo producto!"
    }).then(function(result){
        if(result.value){
            var datos = new FormData();
            datos.append("idTipoProEl",idTipoPro);
            datos.append("tipoProEl",tipoProuducto);
            $.ajax({
                url:"ajax/tipoproducto/eliminarTipoProducto.ajax.php",
                method:"POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta == "ok"){
                        if(window.matchMedia("(min-width:992px)").matches){
                            document.getElementById("tablaTipoProducto").deleteRow(row+1);
                        }else{
                            document.getElementById("tablaTipoProducto").deleteRow(row);
                        }
                        swal({
                            type: "success",
                            title: "Tipo producto "+tipoProuducto+" ha sido eliminado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(function(result){
                            if(result.value){
                                window.location="tipoProducto";
                            }
                        })
                    }else if(respuesta != ""){
                        swal({
                            type: "info",
                            title: "Tipo producto "+tipoProuducto+" está en uso",
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