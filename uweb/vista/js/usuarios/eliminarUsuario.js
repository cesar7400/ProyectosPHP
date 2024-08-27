//eliminar usuario
var tablaUsuarios = $('.tablaUsuarios').DataTable();
$('.tablaUsuarios tbody').on('click','button.btnEliminarUsuario',function(){
    var idUsuario = $(this).attr("idUsuarioEliminar");
    var imagenUsuario = $(this).attr("imagenUsuarioEliminar");
    var nombreUsuario = $(this).attr("nombreUsuarioEliminar");
    //para tomar el valor de la fila en resoluciones pequeñas
    var row= $(this).closest('tr').index();
    swal({
        title: "¿Está seguro eliminar el usuario "+nombreUsuario+" ?",
        text: "¡Si no está seguro puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar usuario!"
    }).then(function(result){
        if(result.value){
            var datos = new FormData();
            datos.append("idUsuario",idUsuario);
            datos.append("imagenUsuario",imagenUsuario);
            datos.append("nombreUsuario",nombreUsuario);
            $.ajax({
                url:"ajax/usuarios/eliminarUsuario.ajax.php",
                method:"POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta == "ok"){
                        if(window.matchMedia("(min-width:992px)").matches){
                            document.getElementById("tablaUsuarios").deleteRow(row+1);
                        }else{
                            document.getElementById("tablaUsuarios").deleteRow(row);
                        }
                        swal({
                            type: "success",
                            title: "El usuario "+nombreUsuario+" ha sido eliminado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(function(result){
                            if(result.value){
                                window.location = "VerUsuarios";
                            }
                        })
                    }else{
                        swal({
                            type: "error",
                            title: "Error al eliminar el usuario.<br>No es posible la conexión con el servidor.",
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