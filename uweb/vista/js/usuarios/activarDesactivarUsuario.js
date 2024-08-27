var tablaUsuarios = $('.tablaUsuarios').DataTable();
    //ACTIVAR BOTONES CON LOS ID CORRESPONDIENTES (ACTIVAR-DESACTIVAR USUARIO SELECCIONADO)
    $('.tablaUsuarios tbody').on('click','button.btnActivarUsuario',function(){
        var idUsuario = $(this).attr("idUsuario");
        var estadoUsuario = $(this).attr("estadoUsuario");
        var datos = new FormData();
        datos.append("idUsuario",idUsuario);
        datos.append("estadoUsuario",estadoUsuario);
        $.ajax({
            type : 'POST',
            url  : "ajax/usuarios/activarDesactivarUsuario.ajax.php",
            data : datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta =="errorActualizar" || respuesta =="errorConexion"){
                    swal({
                        type: "error",
                        title: "Error al actualizar</br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }else{
                    if(estadoUsuario == 0){
                        $("#btnActivado"+idUsuario).removeClass('btn-success');
                        $("#btnActivado"+idUsuario).addClass('btn-danger ');
                        $("#btnActivado"+idUsuario).html('Desactivado');
                        $("#btnActivado"+idUsuario).attr('estadoUsuario',1);
                    }else{
                        $("#btnActivado"+idUsuario).addClass('btn-success');
                        $("#btnActivado"+idUsuario).removeClass('btn-danger');
                        $("#btnActivado"+idUsuario).html('Activado');
                        $("#btnActivado"+idUsuario).attr('estadoUsuario',0);
                    }
                }
            }
        });
    });