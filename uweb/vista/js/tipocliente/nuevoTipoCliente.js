$('#modalTipoClienteAgregar').ready(function(){

    $.validator.addMethod("letrasnumeros", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ\s]{1,}$/);
    });
    /*validation */
    $("#modalTipoClienteAgregar").validate({
        rules:
        {
            nuevoTipoCliente: { required: true, letrasnumeros: true },
	    },
        messages:
	    {
            nuevoTipoCliente:{ required: "Ingresar tipo cliente", letrasnumeros: "No puede llevar caracteres especiales" },
        },
       submitHandler: submitForm
    });
    function submitForm(){

        if($("#nuevoTipoCliente").val() == ""){
            $(".text").remove();
            $("#nuevoTipoCliente").after('<div class="text text-danger" style="color:blue;font-weight:bold">Tipo cliente no puede ir vac&iacute;o</div>');
            $("#nuevoTipoCliente").focus();
            return false;
        }else{
            var datos = new FormData();
            datos.append("nuevoTipoCliente",$("#nuevoTipoCliente").val().trim().toLowerCase());
            $.ajax({
                type : 'POST',
                url  : "ajax/tipocliente/agregarTipoCliente.ajax.php",
                data : datos,
                //para subir archivos por ajax
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                    $("#btn-submit_add_TipoCliente").html('<i class="fa fa-refresh"></i> Verificando...');
                },
                success: function(respuesta){
                    if(respuesta == "errorConexion"){
                        $("#btn-submit_add_TipoCliente").html('<i class="btn-primary"></i> Guardar');
                        swal({
                            type: "error",
                            title: "No es posible la conexión con el servidor.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        });
                    }
                    if(respuesta == "errorAgregar"){
                        $("#btn-submit_add_TipoCliente").html('<i class="btn-primary"></i> Guardar');
                        swal({
                            type: "error",
                            title: "Error al ingresar tipo cliente.<br>No es posible la conexión con el servidor.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        });
                    }
                    if(respuesta == "ok"){
                        swal({
                            type: "success",
                            title: "Tipo cliente ha sido ingresado correctamente",
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
    }
});
//limpiar formulario modal
$("#btnCerrarModal").on("click",function(event){ 
    $('#nuevoTipoCliente').val('');
    $("#nuevoTipoCliente-error").remove();
});
$(".salirTC").on("click",function(event){ 
    $('#nuevoTipoCliente').val('');
    $("#nuevoTipoCliente-error").remove();
});
