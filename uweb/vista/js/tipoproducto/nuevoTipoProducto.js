$('#modalTipoProductoAgregar').ready(function(){

    $.validator.addMethod("letrasnumeros", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ\s]{1,}$/);
    });
    /*validation */
    $("#modalTipoProductoAgregar").validate({
        rules:
        {
            nuevoTipoProducto: { required: true, letrasnumeros: true },
	    },
        messages:
	    {
            nuevoTipoProducto:{ required: "Ingresar tipo producto", letrasnumeros: "No puede llevar caracteres especiales" },
        },
       submitHandler: submitForm
    });
    function submitForm(){

        if($("#nuevoTipoProducto").val() == ""){
            $(".text").remove();
            $("#nuevoTipoProducto").after('<div class="text text-danger" style="color:blue;font-weight:bold">Tipo producto no puede ir vac&iacute;o</div>');
            $("#nuevoTipoProducto").focus();
            return false;
        }else{
            var datos = new FormData();
            datos.append("nuevoTipoProducto",$("#nuevoTipoProducto").val().trim().toLowerCase());
            $.ajax({
                type : 'POST',
                url  : "ajax/tipoproducto/agregarTipoProducto.ajax.php",
                data : datos,
                //para subir archivos por ajax
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                    $("#btn-submit_add_TipoProducto").html('<i class="fa fa-refresh"></i> Verificando...');
                },
                success: function(respuesta){
                    if(respuesta == "errorConexion"){
                        $("#btn-submit_add_TipoProducto").html('<i class="btn-primary"></i> Guardar');
                        swal({
                            type: "error",
                            title: "No es posible la conexión con el servidor.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        });
                    }
                    if(respuesta == "errorAgregar"){
                        $("#btn-submit_add_TipoProducto").html('<i class="btn-primary"></i> Guardar');
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
                            title: "Tipo producto ha sido ingresado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(function(result){
                            if(result.value){
                                window.location="tipoProducto";
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
    $('#nuevoTipoProducto').val('');
    $("#nuevoTipoProducto-error").remove();
});
$(".salirTp").on("click",function(event){
    $('#nuevoTipoProducto').val('');
    $("#nuevoTipoProducto-error").remove();
});
