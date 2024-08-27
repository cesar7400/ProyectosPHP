//validaciones crearcion usuario
$('#usuarioNuevo').on('click',function(e){

    $.validator.addMethod("letrasespacios", function(value, element){
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ\s\\áéíóúÁÉÍÓÚ]{1,}$/);
    });
    $.validator.addMethod("letrasnumeros", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9]{1,}$/);
    });
    //validaciones
    $("#usuarioNuevo").validate({
        rules:
        {
            nuevoNombre: { required: true, letrasespacios: true },
            nuevoApellido: { required: true, letrasespacios: true },
            nuevoEmail: { required: true, email: true },
            nuevoUsuario: { required: true, letrasnumeros: true,minlength: 8, maxlength: 15},
            nuevoPassword: {required: true, letrasnumeros: true, minlength: 8},  
            nuevoPassword2: {required: true, letrasnumeros: true, minlength: 8, equalTo: "#nuevoPassword"}, 
        },
        messages:{
            nuevoNombre:{ required: "Ingresar nombre(s)", letrasespacios:"Ingresar solo letras" },
            nuevoApellido:{ required: "Ingresar apellidos", letrasespacios:"Ingresar solo letras" },
            nuevoEmail:{  required: "Ingresar email", email: "Ingresar email valido" },
            nuevoUsuario:{ required: "Ingresar usuario", letrasnumeros:"Ingresar solo letras y n&uacute;meros", minlength: "Ingresar 8 caracteres como m&iacute;nimo"},
            nuevoPassword:{ required: "Ingresar contraseña de acceso", letrasnumeros:"Ingresar solo letras y n&uacute;meros", minlength: "Ingresar 8 caracteres como m&iacute;nimo" },
            nuevoPassword2:{ required: "Repita contraseña de acceso", letrasnumeros:"Ingresar solo letras y n&uacute;meros", minlength: "Ingresar 8 caracteres como m&iacute;nimo", equalTo: " Contraseña no coincide" },

        },
        submitHandler: submitForm
    });

    function submitForm(){

        var datos = new FormData();
        datos.append("nuevoNombre",$("#nuevoNombre").val().trim());
        datos.append("nuevoApellido",$("#nuevoApellido").val().trim().toLowerCase());
        datos.append("nuevoEmail",$("#nuevoEmail").val().trim().toLowerCase());
        datos.append("nuevoUsuario",$("#nuevoUsuario").val().trim());
        datos.append("nuevoPassword",$("#nuevoPassword").val().trim());
        datos.append("estado","1");
        datos.append("nuevaImagen",$("#nuevaImagen").prop('files')[0]);
        $.ajax({
            type : 'POST',
            url  : "ajax/usuarios/agregarUsuario.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $("#btn-submit_add_user").html('<i class="fa fa-refresh"></i> Verificando...');
            },
            success: function(respuesta){
                if(respuesta == "errorConexion"){
                    $("#btn-submit_add_user").html('<span class="fa fa-save"></span> Registrar');
                    swal({
                        type: "error",
                        title: "No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
                if(respuesta == "errorAgregar"){
                    $("#btn-submit_add_user").html('<span class="fa fa-save"></span> Registrar');
                    swal({
                        type: "error",
                        title: "Error al ingresar el usuario.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
                if(respuesta == "ok"){
                    var cont = ["nuevoNombre", "nuevoApellido", "nuevoEmail", "nuevoUsuario", "nuevoPassword", "nuevoPassword2", "nuevaImagen"];
                    for (var i = 0; i < cont.length; i++){
                        document.getElementById(String(cont[i])).value="";
                        $(String(cont[i]).replace("nuevo","#error")).html('');
                    }
                    $("#btn-submit_add_user").html('<span class="fa fa-save"></span> Registrar');
                    $(".previsualizar").attr("src","vista/img/usuarios/default user.png");
                    swal({
                        type: "success",
                        title: "El usuario ha sido registrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                    e.preventDefault();
                    return;
                }
            }
        });
    }
});
//limpiar form
$('#btn-cancelar-user-add').on('click',function(e){
    var cont = ["nuevoNombre", "nuevoApellido", "nuevoEmail", "nuevoUsuario", "nuevoPassword", "nuevoPassword2", "nuevaImagen"];
    for (var i = 0; i < cont.length; i++){
        document.getElementById(String(cont[i])).value="";
        $(String("#"+cont[i])+"-error").remove();
    }
    $(".previsualizar").attr("src","vista/img/usuarios/default user.png");
    return false;
});