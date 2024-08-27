$("#modalTipoProductoAgregar").on('keyup', function(){

    $("#nuevoTipoProducto").on('keyup', function(){
        $(".errorTipoProducto").remove();
    });
    
    if($("#nuevoTipoProducto").val().length > 0){
        valTipoProducto($("#nuevoTipoProducto").val().trim().toLowerCase());
    }
});

function valTipoProducto(valor){
    var datos = new FormData();
    datos.append("tipoProductoVal",valor);
    $.ajax({
        url:"ajax/tipoproducto/validarTipoProducto.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                $("#nuevoTipoProducto").after('<div class="text text-danger errorTipoProducto" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                $("#nuevoTipoProducto").val("");
            }else{
                if(respuesta != false){
                    $("#nuevoTipoProducto").after('<div class="text text-danger errorTipoProducto" style="color:blue;font-weight:bold">Tipo producto ya existe</div>');
                    document.getElementById("btn-submit_add_TipoProducto").disabled=true;
                }else{
                    document.getElementById("btn-submit_add_TipoProducto").disabled=false;
                }
            }
        }
    });
}
$("#modalTipoProductoEditar").on('keyup', function(){
    
    $('#editarTipoProducto').on('keyup', function(){
        $(".errorTipoProducto").remove();
    });
    if($("#editarTipoProducto").val().length > 0){
        $.getScript("vista/js/tipoproducto/editarTipoProducto.js", function(e){
            if((objTipoProducto()[1].trim().toLowerCase() != $("#editarTipoProducto").val().trim().toLowerCase())){
                valTipoProducto($("#editarTipoProducto").val().trim().toLowerCase());
            }
        });
    }
    function valTipoProducto(valor){
        var datos = new FormData();
        datos.append("tipoProductoVal",valor);
        $.ajax({
            url:"ajax/tipoproducto/validarTipoProducto.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    $("#editarTipoProducto").after('<div class="text text-danger errorTipoProducto" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                    $("#editarTipoProducto").val("");
                }else{
                    if(respuesta != false){
                        $("#editarTipoProducto").after('<div class="text text-danger errorTipoProducto" style="color:blue;font-weight:bold">Tipo producto ya existe</div>');
                        document.getElementById("btn-submit_upd_TipoProducto").disabled=true;
                    }else{
                        document.getElementById("btn-submit_upd_TipoProducto").disabled=false;
                    }
                }
            }
        });
    }
});