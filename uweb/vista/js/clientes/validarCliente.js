/*validar cliente y nit (crear)*/
$("#frmClienteNuevo").on('keyup', function(){
    $("#nuevoCedulaCliente").on('keyup', function(){
        $(".errorCedulaCliente").remove();
    });
    if($("#nuevoCedulaCliente").val().length > 0){
        valCliente('cedula', $("#nuevoCedulaCliente").val().trim().toLowerCase());
    }
    if($("#nuevoNitCliente").val().length > 0){
        valCliente('nit', $("#nuevoNitCliente").val().trim()+' - '+document.getElementById("dv").textContent.toLowerCase());
    }
    function valCliente(opcion, valor){
        var datos = new FormData();
        datos.append(opcion, valor);
        $.ajax({
            url:"ajax/clientes/validarCliente.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    if(opcion == "cedula"){
                        $(".errorCedulaCliente").remove();
                        $("#nuevoCedulaCliente").after('<div class="text text-danger errorCedulaCliente" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#nuevoCedulaCliente").val("");
                    }
                    if(opcion == "nit"){
                        $(".errorNitCliente").remove();
                        $("#nuevoNitCliente").after('<div class="text text-danger errorNitCliente" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#nuevoNitCliente").val("");
                    }
                }else{
                    if(opcion == "cedula"){
                        if(respuesta != false){
                            $("#nuevoCedulaCliente").after('<div class="text text-danger errorCedulaCliente" style="color:blue;font-weight:bold">La cédula ya esta registrada</div>');
                            $("#nuevoCedulaCliente").val("");
                        }
                    }
                    if(opcion == "nit"){
                        if(respuesta != false){
                            $("#nuevoNitCliente").after('<div class="text text-danger errorCedulaCliente" style="color:blue;font-weight:bold">El nit ya esta registrado</div>');
                            $("#nuevoNitCliente").val("");
                        }
                    }
                }
            }
        });
    }
});
//validar cliente <cedula - nit> (actualizar)
$("#frmEditarCliente").on('keyup', function(){
    $("#editarCedulaClie").on('keyup', function(){
        $(".errorCedulaClie").remove();
        if($("#editarCedulaClie").val().length == 0){
            document.getElementById('btn-upd-cliente').disabled = true;
        }else{
            document.getElementById('btn-upd-cliente').disabled = false;
        }
        if($("#editarCedulaClie").val().length > 0){
            $.getScript("vista/js/clientes/editarClienteSel.js", function(e){
                if(objCliente()[1] != $("#editarCedulaClie").val().trim().toLowerCase()){
                    valCliente('cedula', $("#editarCedulaClie").val().trim().toLowerCase());
                }
            });
        }
    });
    $("#editarNitClie").on('keyup', function(){
        $(".errorNitClie").remove();
        if($("#editarNitClie").val().length == 0){
            document.getElementById('btn-upd-cliente').disabled = true;
        }else{
            document.getElementById('btn-upd-cliente').disabled = false;
        }
        if($("#editarNitClie").val().length > 0){
            var nit = $("#editarNitClie").val().trim()+' - '+document.getElementById("dv").textContent.toLowerCase();
            if(objCliente()[2] != nit){
                valCliente('nit', nit);
            }
        }
    });
    function valCliente(opcion, valor){
        var datos = new FormData();
        datos.append(opcion, valor);
        $.ajax({
            url:"ajax/clientes/validarCliente.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    if(opcion == "cedula"){
                        $("#editarCedulaClie").after('<div class="text text-danger errorCedulaClie" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#editarCedulaClie").val("");
                    }
                    if(opcion == "nit"){
                        $("#editarNitClie").after('<div class="text text-danger errorNitClie" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#editarNitClie").val("");
                    }
                }else{
                    if(opcion == "cedula"){
                        if(respuesta != false){
                            $(".errorCedulaClie").remove();
                            $("#editarCedulaClie").after('<div class="text text-danger errorCedulaClie" style="color:blue;font-weight:bold">La cédula ya esta registrada</div>');
                            $("#editarCedulaClie").val("");
                            document.getElementById('btn-upd-cliente').disabled = true;
                        }else{
                            document.getElementById('btn-upd-cliente').disabled = false;
                        }
                    }
                    if(opcion == "nit"){
                        if(respuesta != false){
                            $(".errorNitClie").remove();
                            $("#editarNitClie").after('<div class="text text-danger errorNitClie" style="color:blue;font-weight:bold">El nit ya está registrado</div>');
                            $("#editarNitClie").val("");
                            document.getElementById('btn-upd-cliente').disabled = true;
                        }else{
                            document.getElementById('btn-upd-cliente').disabled = false;
                        }
                    }
                }
            }
        });
    }
});