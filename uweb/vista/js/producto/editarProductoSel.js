var valProducto;
function txtValoIVAed(){
    var x = document.getElementById("editarivaProductoSel").value;
    if(x == "1"){
            document.getElementById('editarValorIva').style.visibility = 'visible';
            document.getElementById('editIVA').style.visibility = 'visible';
    }else{
            document.getElementById('editarValorIva').style.visibility = 'hidden';
            document.getElementById('editIVA').style.visibility = 'hidden';
            $("#editarValorIva").val('');
    }
}
$('.tablaProductos').ready(function(){
    $('.tablaProductos tbody').on('click','button.btnSeleccionarProducto',function(){
        id_producto = $(this).attr("id_producto");
        editarProducto(id_producto);
    });

    //editar producto seleccionado
    function editarProducto(id_producto){
        var datos = new FormData();
        datos.append("idverProudctoSel",id_producto);
        $.ajax({
            type : 'POST',
            url  : "ajax/productos/verProductoSeleccionado.ajax.php",
            data : datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                    swal({
                        type: "error",
                        title: "Error al consultar el producto.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }else{
                    //se muestra el form modal con la informacion del producto seleccionado
                    $("#modalEditarProducto").modal("show");
                    $(".errorCodigoP").remove();
                    $("#editarCodigoPro").val(respuesta["codigo"]);
                    $("#editarNombrePro").val(respuesta["nombre"]);
                    $("#editarDescripcionPro").val(respuesta["descripcion"]);
                    $("#editarValornPro").val(respuesta["valor"]);
                    $("#editarTipoPro").val(respuesta["idtipoproducto"]);
                    if((respuesta["iva"] == 1)){
                        document.getElementById("edPsel1").selected = "true";
                    }else{
                        document.getElementById("edPsel0").selected = "true";
                        document.getElementById('editarValorIva').style.visibility = 'hidden';
                        document.getElementById('editIVA').style.visibility = 'hidden';
                    }
                    if(respuesta["valoriva"]=='0' && respuesta["iva"] == 0){
                        $("#editarValorIva").val('');
                    }else{
                        $("#editarValorIva").val(respuesta["valoriva"]);
                    }
                    $(".errorCodigoP").remove();
                    valProducto = new Array(respuesta["idproducto"], respuesta["codigo"]);
                }
            }
        });
    }
    //restablecer
    $('.btn-cancelar-upd-producto').on('click',function(e){
        var cont = ["editarCodigoPro", "editarNombrePro", "editarDescripcionPro", "editarValornPro", "editarTipoPro", "editarivaProductoSel", "editarValorIva"];
        for (var i = 0; i < cont.length; i++){
            document.getElementById(String(cont[i])).value="";
            $(String("#"+cont[i])+"-error").remove();
        }
        editarProducto(objProducto()[0]);
        document.getElementById('btn-upd-producto').disabled = false;
    })
});

function objProducto(){
    return valProducto;
}
$('#frmEditarProducto').ready(function(){

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
    
    $('#frmEditarProducto').validate({
        rules:
        {
            editarCodigoPro: { required: true, digits: true },
            editarNombrePro: { required: true, letrasespaciosnumeros: true },
            editarDescripcionPro: { required: true, letrasespaciosnumeros: true },
            editarValornPro: { required: true, digits: true },
            editarTipoPro: { valor: "" },
            editarValorIva: { required: false,  digits : true, minlength: 1, maxlength:3},
           },
        messages:
           {
            editarCodigoPro:{ required: "Ingresar código", digits:"Ingresar solo números" },
            editarNombrePro:{ required: "Ingresar nombre", letrasespaciosnumeros:"Hay caracteres no validos" },
            editarDescripcionPro:{ required: "Ingresar descripción", letrasespaciosnumeros:"Hay caracteres no validos" },
            editarValornPro:{ required: "Ingresar valor", digits:"Ingresar solo números" },
            editarTipoPro:{ required: "Seleccionar tipo producto", valueNotEquals: "Seleccionar tipo producto" },
            editarivaProductoSel: { required: "Seleccionar IVA", valueNotEquals: "Seleccionar IVA" },
            editarValorIva:{ required: "Ingresar IVA", digits: "Ingresar solo digitos para para el IVA", minlength: "Ingresar 1 digitos como m&iacute;nimo", maxlength: "Ingresar 3 digitos como máximo" },
       },
        submitHandler: submitForm
    });
    function submitForm(){
        //cargamos el script para uso de variables de este 
        var datos = new FormData();
        datos.append("idproductoPed",objProducto()[0]);
        datos.append("codigoPed",$("#editarCodigoPro").val().trim());
        datos.append("nombrePed",$("#editarNombrePro").val().trim());
        datos.append("descripcionPed",$("#editarDescripcionPro").val().trim().toLowerCase());
        datos.append("valorPed",$("#editarValornPro").val().trim().toLowerCase());
        datos.append("idtipoproductoPed",$("#editarTipoPro").val().trim());
        datos.append("ivaPed",$("#editarivaProductoSel").val().trim());
        datos.append("valorivaPed",($("#editarValorIva").val()=="")?"0":$("#editarValorIva").val().trim());

        $.ajax({
            type : 'POST',
            url  : "ajax/productos/actualizarProducto.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $(".btn-upd-producto").html('<i class="fa fa-refresh"></i> Verificando...');
            },
            success: function(respuesta){
                if(document.getElementById("editarivaProductoSel").value == "1" && $("#editarValorIva").val()==""){
                    $("#editarValorIva").after('<label id="editarValorIva-error" class="error" for="editarValorIva">Ingresar IVA</label>');
                    $(".btn-upd-producto").html('<span class="fa fa-pencil"></span> Modificar');
                }else{
                    if(respuesta == "errorConexion" || respuesta == "errorActualizar"){
                        $(".btn-upd-producto").html('<span class="fa fa-pencil"></span> Modificar');
                        swal({
                            type: "error",
                            title: "Error al actualizar el producto\nNo es posible la conexión con el servidor.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        });
                    }
                    if(respuesta == "ok"){
                        swal({
                            type: "success",
                            title: "¡El producto ha sido modificado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then(function(result){
                            if(result.value){
                                window.location = "producto";
                            }
                        });
                    }
                }
            }
        });
    };
});