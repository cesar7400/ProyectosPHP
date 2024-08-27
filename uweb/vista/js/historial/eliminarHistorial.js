$('#btn_del_historial').on('click',function(e){
    //reinicia  datatable 
    $(".tablaUsuarios").dataTable().fnDestroy();
    //actualiza datatable
    var tablaHistorial = $('.tablaHistorial').DataTable();
    if(! tablaHistorial.data().count() ){
        swal({
            title: "El historial está vacío",
            type: "info",
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        })
    }else{
        swal({
            title: "¿Está seguro eliminar el historial",
            text: "¡Si no está seguro puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar historial!"
        }).then(function(result){
            if(result.value){
                var datos = new FormData();
                datos.append("histelm","histelm");
                $.ajax({
                    url:"ajax/historial/eliminarHistorial.ajax.php",
                    data: datos,
                    method:"POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(respuesta){
                        if(respuesta == "ok"){
    
    
                            tablaHistorial.ajax.reload(null, false);
                            swal({
                                type: "success",
                                title: "El historial ha sido eliminado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then(function(result){
                                if(result.value){
                                }
                            })
                        }else{
                            swal({
                                type: "error",
                                title: "Error al eliminar historial.<br>No es posible la conexión con el servidor.",
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
    }
})