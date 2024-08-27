function txtValoIVA(){
        var x = document.getElementById("ivaProductoSel").value;
        if(x == "1"){
                document.getElementById('nuevoValorIVAProducto').style.visibility = 'visible';
                document.getElementById('lbliva').style.visibility = 'visible';
        }else{
                document.getElementById('nuevoValorIVAProducto').style.visibility = 'hidden';
                document.getElementById('lbliva').style.visibility = 'hidden';
                $('#nuevoValorIVAProducto').val('');
                $("#nuevoValorIVAProducto-error").remove();
        }
}

//agregar producto
$('frmProductoNuevo').ready(function(){
    $.validator.addMethod("letrasespacios", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ\s\\áéíóúÁÉÍÓÚ]{1,}$/);
    });
    $.validator.addMethod("letrasespaciosnumeros", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zñA-ZÑ0-9\s\\áéíóúÁÉÍÓÚ]{1,}$/);
    });
    $.validator.addMethod("letrasnumeros", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9]{1,}$/);
    });
    $.validator.addMethod("celular", function(value, element) {
        return this.optional(element) || value == value.match(/[0-9]{3}\ \-\ [0-9]{3}\ \-\ [0-9]{2}\ \-\ [0-9]{2}$/);
    });
    $.validator.addMethod("telefono", function(value, element) {
        return this.optional(element) || value == value.match(/[0-9]{3}\ \-\ [0-9]{2}\ \-\ [0-9]{2}$/);
    });
    $.validator.addMethod("direccion", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ0-9\s\\áéíóúÁÉÍÓÚ\\-]{1,}$/);
    });
    $.validator.addMethod("valor", function(value, element, arg){
        return arg != value;
    });
    /*validation */
    $("#frmProductoNuevo").validate({
        rules:
        {
            nuevocodigoProducto: { required: true, digits: true },
            nuevonombreProducto: { required: true, letrasespaciosnumeros: true },
            nuevodescripcionProducto: { required: true, letrasespaciosnumeros: true },
            nuevovalorProducto: { required: true, digits: true },
            nuevoTipoProducto: { valor: "" },
            nuevoValorIVAProducto: { required: false,  digits : true, minlength: 1, maxlength:3},
        },
        messages:
        {
            nuevocodigoProducto:{ required: "Ingresar código", digits:"Ingresar solo números" },
            nuevonombreProducto:{ required: "Ingresar nombre", letrasespaciosnumeros:"Hay caracteres no validos" },
            nuevodescripcionProducto:{ required: "Ingresar descripción", letrasespaciosnumeros:"Hay caracteres no validos" },
            nuevovalorProducto:{ required: "Ingresar valor", digits:"Ingresar solo números" },
            nuevoTipoProducto:{ required: "Seleccionar tipo producto", valueNotEquals: "Seleccionar tipo producto" },
            ivaProductoSel: { required: "Seleccionar IVA", valueNotEquals: "Seleccionar IVA" },
            nuevoValorIVAProducto:{ required: "Ingresar IVA", digits: "Ingresar solo digitos para para el IVA", minlength: "Ingresar 1 digitos como m&iacute;nimo", maxlength: "Ingresar 3 digitos como máximo" },
        },
        submitHandler: submitForm	
    });
    function submitForm(){
        if(document.getElementById("ivaProductoSel").value == "1" && $("#nuevoValorIVAProducto").val()==""){
            $("#nuevoValorIVAProducto").after('<label id="nuevoValorIVAProducto-error" class="error" for="nuevoValorIVAProducto">Ingresar IVA</label>');
            $("#btn-submit_add_product").html('<span class="fa fa-save"></span> Ingresar');
            return;
        }else{
            var datos = new FormData();
            datos.append("codigoP",$("#nuevocodigoProducto").val().trim());
            datos.append("nombreP",$("#nuevonombreProducto").val().trim());
            datos.append("descripcionP",$("#nuevodescripcionProducto").val().trim());
            datos.append("valorP",$("#nuevovalorProducto").val().trim());
            datos.append("idtipoproductoP",$("#nuevoTipoProducto").val().trim());
            datos.append("ivaP",$("#ivaProductoSel").val().trim());
            datos.append("valorivaP",($("#nuevoValorIVAProducto").val()=="")?"0":$("#nuevoValorIVAProducto").val().trim());
            $.ajax({
                type : 'POST',
                url  : "ajax/productos/agregarProducto.ajax.php",
                data : datos,
                //para subir archivos por ajax
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                    $("#btn-submit_add_product").html('<i class="fa fa-refresh"></i> Verificando...');
                },
                success: function(respuesta){
                    if(respuesta == "errorConexion"){
                        $("#btn-submit_add_product").html('<span class="fa fa-save"></span> Ingresar');
                        swal({
                            type: "error",
                            title: "No es posible la conexión con el servidor.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        });
                    }
                    if(respuesta == "errorAgregar"){
                        $("#btn-submit_add_product").html('<span class="fa fa-save"></span> Ingresar');
                        swal({
                        type: "error",
                        title: "Error al ingresar el cliente.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        });
                    }
                    if(respuesta == "ok"){
                        var cont = ["nuevocodigoProducto", "nuevonombreProducto", "nuevodescripcionProducto", "nuevoTipoProducto", "ivaProductoSel", "nuevoValorIVAProducto"];
                        for (var i = 0; i < cont.length; i++){
                            document.getElementById(String(cont[i])).value="";
                            $(String(cont[i]).replace("nuevo","#error")).html('');
                        }
                        $("#btn-submit_add_product").html('<span class="fa fa-save"></span> Ingresar');
                        swal({
                            type: "success",
                            title: "El producto ha sido registrado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        });
                    }
                }
            });
        }
    }
});
//limpiar form
$('#btn-cancelar-product').on('click',function(e){
    var cont = ["nuevocodigoProducto", "nuevonombreProducto", "nuevodescripcionProducto", "nuevovalorProducto", "nuevoTipoProducto", "ivaProductoSel", "nuevoValorIVAProducto"];
    for (var i = 0; i < cont.length; i++){
        document.getElementById(String(cont[i])).value="";
        $(String("#"+cont[i])+"-error").remove();
    }
    document.getElementById('btn-cancelar-product').disabled = false;
    document.getElementById('nuevoValorIVAProducto').style.visibility = 'hidden';
    document.getElementById('lbliva').style.visibility = 'hidden';
    $('#nuevoValorIVAProducto').val('');
    $("#nuevoValorIVAProducto-error").remove();
    return false;
});