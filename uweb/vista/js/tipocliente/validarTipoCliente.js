$("#modalTipoClienteAgregar").on('keyup', function(){

    $("#nuevoTipoCliente").on('keyup', function(){
        $(".errorTipoCliente").remove();
    });
    
    if($("#nuevoTipoCliente").val().length > 0){
        valTipoCliente($("#nuevoTipoCliente").val().trim().toLowerCase());
    }
});

function valTipoCliente(valor){
    var datos = new FormData();
    datos.append("tipoClienteVal",valor);
    $.ajax({
        url:"ajax/tipocliente/validarTipocliente.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                $("#nuevoTipoCliente").after('<div class="text text-danger errorTipoCliente" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                $("#nuevoTipoCliente").val("");
            }else{
                if(respuesta != false){
                    $("#nuevoTipoCliente").after('<div class="text text-danger errorTipoCliente" style="color:blue;font-weight:bold">Tipo cliente ya existe</div>');
                    document.getElementById("btn-submit_add_TipoCliente").disabled=true;
                }else{
                    document.getElementById("btn-submit_add_TipoCliente").disabled=false;
                }
            }
        }
    });
}
$("#modalTipoClienteEditar").on('keyup', function(){
    
    $('#editarTipoCliente').on('keyup', function(){
        $(".errorTipoCliente").remove();
    });
    if($("#editarTipoCliente").val().length > 0){
        $.getScript("vista/js/tipocliente/editarTipoCliente.js", function(e){
            if((objTipoCliente()[1].trim().toLowerCase() != $("#editarTipoCliente").val().trim().toLowerCase())){
                valTipoCliente($("#editarTipoCliente").val().trim().toLowerCase());
            }
        });
    }
    function valTipoCliente(valor){
        var datos = new FormData();
        datos.append("tipoClienteVal",valor);
        $.ajax({
            url:"ajax/tipocliente/validarTipocliente.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    $("#editarTipoCliente").after('<div class="text text-danger errorTipoCliente" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                    $("#editarTipoCliente").val("");
                }else{
                    if(respuesta != false){
                        $("#editarTipoCliente").after('<div class="text text-danger errorTipoCliente" style="color:blue;font-weight:bold">Tipo cliente ya existe</div>');
                        document.getElementById("btn-submit_upd_TipoCliente").disabled=true;
                    }else{
                        document.getElementById("btn-submit_upd_TipoCliente").disabled=false;
                    }
                }
            }
        });
    }
});