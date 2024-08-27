/*validar usuario(login) y correo (crear)*/
$("#usuarioNuevo").on('keyup', function(){
    $("#nuevoEmail").on('keyup', function(){
        $(".errorEmail").remove();
    });
    $("#nuevoUsuario").on('keyup', function(){
        $(".errorUsuario").remove();
        if($("#nuevoUsuario").val().length == 0){
            document.getElementById('btn-submit_add_user').disabled = false;
        }
    });
    if($("#nuevoUsuario").val().length > 0){
        valusuario('usuario', $("#nuevoUsuario").val().trim().toLowerCase());
    }
    if($("#nuevoEmail").val().length > 0){
        valusuario('email', $("#nuevoEmail").val().trim().toLowerCase());
    }
    function valusuario(opcion, valor){
        var datos = new FormData();
        datos.append(opcion, valor);
        $.ajax({
            url:"ajax/usuarios/validarUsuario.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    if(opcion == "email"){
                        $(".errorEmail").remove();
                        $("#nuevoEmail").after('<div class="text text-danger errorEmail" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#nuevoEmail").val("");
                    }
                    if(opcion == "usuario"){
                        $(".errorUsuario").remove();
                        $("#nuevoUsuario").after('<div class="text text-danger errorUsuario" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#nuevoUsuario").val("");
                    }
                }else{
                    if(opcion == "email"){
                        if(respuesta != false){
                            $("#nuevoEmail").after('<div class="text text-danger errorEmail" style="color:blue;font-weight:bold">El correo ya esta registrado</div>');
                            $("#nuevoEmail").val("");
                        }
                    }
                    if(opcion == "usuario"){
                        if(respuesta != false){
                            $(".errorUsuario").remove();
                            $("#nuevoUsuario").after('<div class="text text-danger errorUsuario" style="color:blue;font-weight:bold">Este usuario ya esta en uso, selecciona otro usuario</div>');
                            document.getElementById('btn-submit_add_user').disabled = true;
                        }else{
                            document.getElementById('btn-submit_add_user').disabled = false;
                        }
                    }
                }
            }
        });
    }
});
/*validar usuario(login) y correo (actualizar)*/
$("#frmEditarUsuario").on('keyup', function(){
    $("#editarEmail").on('keyup', function(){
        $(".errorUsremail").remove();
    });
    $("#editaUsuario").on('keyup', function(){
        $(".errorUsr").remove();
        if($("#editaUsuario").val().length == 0){
            document.getElementById('btn-upd-usuario').disabled = true;
        }else{
            document.getElementById('btn-upd-usuario').disabled = false;
        }
    });
    if($("#editarEmail").val().length > 0){
        $.getScript("vista/js/usuarios/editarUsuarioSel.js", function(e){
            if(objUsuario()[4] != $("#editarEmail").val().trim().toLowerCase()){
                valusuario('email', $("#editarEmail").val().trim().toLowerCase());
            }
        });
    }
    if($("#editaUsuario").val().length > 0){
        $.getScript("vista/js/usuarios/editarUsuarioSel.js", function(e){
            if(objUsuario()[5] != $("#editaUsuario").val().trim().toLowerCase()){
                valusuario('usuario', $("#editaUsuario").val().trim().toLowerCase());
            }
        });
    }
    function valusuario(opcion, valor){
        var datos = new FormData();
        datos.append(opcion, valor);
        $.ajax({
            url:"ajax/usuarios/validarUsuario.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                if(respuesta =="errorConsulta" || respuesta =="errorConexion"){
                    if(opcion == "email"){
                        $("#editarEmail").after('<div class="text text-danger errorUsremail" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#editarEmail").val("");
                    }
                    if(opcion == "usuario"){
                        $("#editaUsuario").after('<div class="text text-danger errorUsr" style="color:blue;font-weight:bold">Error la consultar, no es posible la conexión con el servidor</div>');
                        $("#editaUsuario").val("");
                    }
                }else{
                    if(opcion == "email"){
                        if(respuesta != false){
                            $("#editarEmail").after('<div class="text text-danger errorUsremail" style="color:blue;font-weight:bold">El correo ya esta registrado</div>');
                            $("#editarEmail").val("");
                        }
                    }
                    if(opcion == "usuario"){
                        if(respuesta != false){
                            $(".errorUsr").remove();
                            $("#editaUsuario").after('<div class="text text-danger errorUsr" style="color:blue;font-weight:bold">Este usuario ya esta en uso, selecciona otro usuario</div>');
                            document.getElementById('btn-upd-usuario').disabled = true;
                        }else{
                            document.getElementById('btn-upd-usuario').disabled = false;
                        }
                    }
                }
            }
        });
    }
});