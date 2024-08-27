var valUsuario;
//editar usuario-seleccionado
function editarUsuario(id_usuario){
    var datos = new FormData();
    datos.append("idVerUsuarioSel",id_usuario);
    $.ajax({
        type : 'POST',
        url  : "ajax/usuarios/verUsuarioSeleccionado.ajax.php",
        data : datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta=="errorConsulta" || respuesta=="errorConexion"){
                swal({
                    type: "error",
                    title: "Error al consultar el usuario.<br>No es posible la conexión con el servidor.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
            }else{
                //se muestra el form modal con la informacion del usuario seleccionado
                $("#modalEditarUsuario").modal("show");
                $(".errorUsremail").remove();
                $(".errorUsr").remove();
                $("#editarNombres").val(respuesta["nombres"]);
                $("#editarApellidos").val(respuesta["apellidos"]);
                $("#editarEmail").val(respuesta["email"]);
                $("#editaUsuario").val(respuesta["usuario"]);
                $("#editarPassword").val("");
                $("#editarPassword1").val("");
                if(respuesta["imagen"] != ""){
                    $(".previsualizar").attr("src", respuesta["imagen"]);
                }else{
                    $(".previsualizar").attr("src","vista/img/usuarios/default user.png");
                }
                valUsuario = new Array(respuesta["idusuario"], respuesta["usuario"], respuesta["password"],respuesta["imagen"],respuesta["email"],respuesta["usuario"]);
                $(".errorUsremail").remove();
            }
        }
    });
}
$('.tablaUsuarios tbody').on('click','button.btnSeleccionarUsuarioEditar',function(){
    $('#nuevaImagen').val('');
    id_usuario = $(this).attr("idselUsuarioEditar");
    editarUsuario(id_usuario);
});
function objUsuario(){
    return valUsuario;
}
$('#frmEditarUsuario').ready(function(){

    $.validator.addMethod("letrasespacios", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ\s\\áéíóúÁÉÍÓÚ]{1,}$/);
    });
    $.validator.addMethod("letrasnumeros", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9]{1,}$/);
    });
    $('#frmEditarUsuario').validate({
        rules:
        {
            editarNombres: { required: true, letrasespacios: true },
            editarApellidos: { required: true, letrasespacios: true },
            editarEmail: { required: true, email: true },
            editaUsuario: { required: true, letrasnumeros: true,minlength: 8, maxlength: 15},
            editarPassword: {required: false, letrasnumeros: true, minlength: 8},  
            editarPassword1: {required: false, letrasnumeros: true, minlength: 8, equalTo: "#editarPassword"}, 
        },
        messages:{
            editarNombres:{ required: "Ingresar nombre(s)", letrasespacios:"Ingresar solo letras" },
            editarApellidos:{ required: "Ingresar apellidos", letrasespacios:"Ingresar solo letras" },
            editarEmail:{ required: "Ingresar email de usuario", email: "Ingresar un email valido" },
            editaUsuario: { required: "Ingresar usuario", letrasnumeros:"Ingresar solo letras y n&uacute;meros", minlength: "Ingresar 8 caracteres como m&iacute;nimo" },
            editarPassword:{ required: "Ingresar contraseña de acceso", letrasnumeros:"Ingresar solo letras y n&uacute;meros", minlength: "Ingresar 8 caracteres como m&iacute;nimo" },
            editarPassword1:{ required: "Repita contraseña de acceso", letrasnumeros:"Ingresar solo letras y n&uacute;meros", minlength: "Ingresar 8 caracteres como m&iacute;nimo", equalTo: " Contraseña no coincide" },

        },
        submitHandler: submitForm
    });
    function submitForm(){
        //cargamos el script para uso de variables de este 
        var datos = new FormData();
        datos.append("idUsuarioupd",objUsuario()[0]);
        datos.append("editarNombres",$("#editarNombres").val().trim());
        datos.append("editarApellidos",$("#editarApellidos").val().trim());
        datos.append("editarEmail",$("#editarEmail").val().trim().toLowerCase());
        datos.append("editaUsuario",$("#editaUsuario").val().trim().toLowerCase());
        datos.append("editarPassword",$("#editarPassword").val().trim());
        datos.append("passworActual",objUsuario()[2]);
        datos.append("usuarioActual",objUsuario()[1]);
        datos.append("imagenEditar",$("#nuevaImagen").prop('files')[0]);
        datos.append("imagenActual",objUsuario()[3]);
        $.ajax({
            type : 'POST',
            url  : "ajax/usuarios/actualizarUsuario.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $(".btn-upd-usuario").html('<i class="fa fa-refresh"></i> Verificando...');
            },
            success: function(respuesta){
                if(respuesta == "errorConexion" || respuesta == "errorActualizar"){
                    $(".btn-upd-usuario").html('<span class="fa fa-pencil"></span> Registrar');
                    swal({
                        type: "error",
                        title: "Error al actualizar el usuario\nNo es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
                if(respuesta == "ok"){
                    swal({
                        type: "success",
                        title: "¡El usuario ha sido modificado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(function(result){
                        if(result.value){
                            window.location = "VerUsuarios";
                        }
                    });
                }
            }
        });
    };
});
//restablecer
$('.btn-cancelar-upd-user').on('click',function(e){
    editarUsuario(objUsuario()[0]);
    var cont = ["editarNombres", "editarApellidos", "editarEmail", "editaUsuario", "editarPassword", "editarPassword1"];
    for (var i = 0; i < cont.length; i++){
        document.getElementById(String(cont[i])).value="";
        $(String("#"+cont[i])+"-error").remove();
    }
    document.getElementById('btn-upd-usuario').disabled = false;
    $("#nuevaImagen").val('');
 })