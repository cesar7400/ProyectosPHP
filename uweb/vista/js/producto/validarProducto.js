/*validar producto crear*/
$("#frmProductoNuevo").on('keyup', function(){
    $("#nuevocodigoProducto").on('keyup', function(){
        $(".errorCodigoProducto").remove();
    });
    if($("#nuevocodigoProducto").val().length > 0){
        valCodigoProducto($("#nuevocodigoProducto").val().trim());
    }
    function valCodigoProducto(valor){
        var datos = new FormData();
        datos.append("codigoPr", valor);
        $.ajax({
            url:"ajax/productos/validarProducto.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    $(".errorCodigoProducto").remove();
                    $("#nuevocodigoProducto").after('<div class="text text-danger errorCodigoProducto" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                    $("#nuevocodigoProducto").val("");
                }else{
                    if(respuesta != false){
                        $("#nuevocodigoProducto").after('<div class="text text-danger errorCodigoProducto" style="color:blue;font-weight:bold">El código ya está registrado</div>');
                        $("#nuevocodigoProducto").val("");
                    }
                }
            }
        });
    }
});
//validar producto (actualizar)
$("#frmEditarProducto").on('keyup', function(){
    $("#editarCodigoPro").on('keyup', function(){
        $(".errorCodigoP").remove();
        if($("#editarCodigoPro").val().length == 0){
            document.getElementById('btn-upd-producto').disabled = true;
        }else{
            document.getElementById('btn-upd-producto').disabled = false;
        }
        if($("#editarCodigoPro").val().length > 0){
            $.getScript("vista/js/producto/editarProductoSel.js", function(e){
                if(objProducto()[1] != $("#editarCodigoPro").val().trim().toLowerCase()){
                    valCodigoProducto($("#editarCodigoPro").val().trim().toLowerCase());
                }
            });
        }
    });
    function valCodigoProducto(valor){
        var datos = new FormData();
        datos.append("codigoPr", valor);
        $.ajax({
            url:"ajax/productos/validarProducto.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    $("#editarCodigoPro").after('<div class="text text-danger errorCodigoP" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                    $("#editarCodigoPro").val("");
                }else{
                    if(respuesta != false){
                        $(".errorCodigoP").remove();
                        $("#editarCodigoPro").after('<div class="text text-danger errorCodigoP" style="color:blue;font-weight:bold">El código ya está registrado</div>');
                        $("#editarCodigoPro").val("");
                        document.getElementById('btn-upd-producto').disabled = true;
                    }else{
                        document.getElementById('btn-upd-producto').disabled = false;
                    }
                }
            }
        });
    }
});