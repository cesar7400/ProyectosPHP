var valTipoProducto;
//selecionar tipo producto para editar
function editarTipoProducto(idTipoProducto){
    var datos = new FormData();
    datos.append("idSelTipoProducto",idTipoProducto);
    $.ajax({
        type : 'POST',
        url  : "ajax/tipoproducto/seleccionaTipoProducto.ajax.php",
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
                //se muestra el form modal con la informacion del tipo producto seleccionado
                $("#modalEditarTipoProducto").modal("show");
                $(".errorTipoProducto").remove();
                document.getElementById("editarTipoProducto").style.fontSize = "20px"; 
                document.getElementById("editarTipoProducto").style.color = "red";
                $("#editarTipoProducto").val(respuesta["tipoproducto"]);
                valTipoProducto = new Array(respuesta["idtipoproducto"], respuesta["tipoproducto"]);
            }
        }
    })
}
$('.tablaTipoProducto tbody').on('click','button.btnEditarTipoproducto',function(){

    var idTipoPro = $(this).attr("idTipoPro");
    editarTipoProducto(idTipoPro);
})
function objTipoProducto(){
    return valTipoProducto;
}
$("#btn-submit_upd_TipoProducto").ready(function(){

    $.validator.addMethod("letrasespaciosnumeros", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ0-9\s\\áéíóúÁÉÍÓÚ]{1,}$/);
});
    $("#modalTipoProductoEditar").validate({
        
        rules:
        {
            editarTipoProducto: { required: true, letrasespaciosnumeros: true },
	    },
        messages:
	    {
            editarTipoProducto:{ required: "Ingresar tipo producto", letrasespaciosnumeros: "Tipo producto no puede llevar caracteres especiales" },
        },
       submitHandler: submitForm
    });
    function submitForm(){
        var datos = new FormData();
        datos.append("idTipoProductoEd", objTipoProducto()[0]);
        datos.append("editarTipoProducto",$("#editarTipoProducto").val().trim());
        $.ajax({
            type : 'POST',
            url  : "ajax/tipoproducto/actualizarTipoProducto.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $("#btn-submit_upd_TipoProducto").html('<i class="fa fa-refresh"></i> Verificando...');
            },
            success: function(respuesta){
                if(respuesta == "errorConexion" || respuesta == "errorAgregar"){
                    $("#btn-submit_upd_TipoProducto").html('<i class="btn-primary"></i> Guardar cambios');
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
                        title: "Tipo producto ha sido actualizado correctamente",
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
});
//limpiar formulario modal
$(".btn-cancelar-upd-TipoProducto").on("click",function(event){
    $("#editarTipoProducto").val(objTipoProducto()[1]);
    document.getElementById("btn-submit_upd_TipoProducto").disabled=false;
    $("#editarTipoProducto-error").remove();
    $(".errorTipoProducto").remove();
});