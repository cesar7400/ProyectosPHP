var valTipoCliente;
//selecionar tipo cliente para editar
function editarTipoCliente(idTipoCliente){
    var datos = new FormData();
    datos.append("idSelTipoCliente",idTipoCliente);
    $.ajax({
        type : 'POST',
        url  : "ajax/tipocliente/seleccionarTipocliente.ajax.php",
        data : datos,
        //para subir archivos por ajax
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta =="errorConexion" || respuesta == "errorConsulta"){
                swal({
                    type: "error",
                    title: "Error al consultar.<br>No es posible la conexión con el servidor.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
            }else{
                //se muestra el form modal con la informacion del tipo cliente seleccionado
                $("#modalEditarTipoCliente").modal("show");
                $(".errorTipoCliente").remove();
                document.getElementById("editarTipoCliente").style.fontSize = "20px"; 
                document.getElementById("editarTipoCliente").style.color = "red";
                $("#editarTipoCliente").val(respuesta["tipocliente"]);
                valTipoCliente = new Array(respuesta["idtipocliente"], respuesta["tipocliente"]);
            }
        }
    })
}
$('.tablaTipoCliente tbody').on('click','button.btnEditarTipocliente',function(){

    var idTipoCliente = $(this).attr("idTipoCli");
    editarTipoCliente(idTipoCliente);
})
function objTipoCliente(){
    return valTipoCliente;
}
$("#btn-submit_upd_TipoCliente").ready(function(){

    $.validator.addMethod("letrasnumeros", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9]{1,}$/);
    });
    $("#modalTipoClienteEditar").validate({
        
        rules:
        {
            editarTipoCliente: { required: true, letrasnumeros: true },
	    },
        messages:
	    {
            editarTipoCliente:{ required: "Ingresar tipo cliente", letrasnumeros: "Tipo cliente no puede llevar caracteres especiales" },
        },
       submitHandler: submitForm
    });
    function submitForm(){
        var datos = new FormData();
        datos.append("idTipoClienteEd", objTipoCliente()[0]);
        datos.append("editarTipoCliente",$("#editarTipoCliente").val().trim());
        $.ajax({
            type : 'POST',
            url  : "ajax/tipocliente/actualizarTipocliente.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $("#btn-submit_upd_TipoCliente").html('<i class="fa fa-refresh"></i> Verificando...');
            },
            success: function(respuesta){
                if(respuesta == "errorConexion" || respuesta == "errorAgregar"){
                    $("#btn-submit_upd_TipoCliente").html('<i class="btn-primary"></i> Guardar cambios');
                    swal({
                        type: "error",
                        title: "Error al actualizar.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
                if(respuesta == "ok"){
                    swal({
                        type: "success",
                        title: "Tipo cliente ha sido actualizado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(function(result){
                        if(result.value){
                            window.location="tipoCliente";
                        }
                    });
                }
            }
        });
    }
});
//limpiar formulario modal
$(".btn-cancelar-upd-TipoCliente").on("click",function(event){
    $("#editarTipoCliente").val(objTipoCliente()[1]);
    document.getElementById("btn-submit_upd_TipoCliente").disabled=false;
    $("#editarTipoCliente-error").remove();
    $(".errorTipoCliente").remove();
});