var valCliente;
$('.tablaCliente').ready(function(){

    $('.tablaCliente tbody').on('click','button.btnSeleccionarCliente',function(){
        id_cliente = $(this).attr("id_cliente");
        editarCliente(id_cliente);
    });

    //editar cliente seleccionado
    function editarCliente(id_cliente){
        var datos = new FormData();
        datos.append("idVerClienteSel",id_cliente);
        $.ajax({
            type : 'POST',
            url  : "ajax/clientes/verClienteSeleccionado.ajax.php",
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
                    $("#modalEditarCliente").modal("show");
                    $(".errorCedulaClie").remove();
                    $(".errorNitClie").remove();
                    $("#editarNombresClie").val(respuesta["nombres"]);
                    $("#editarApellidosClie").val(respuesta["apellidos"]);
                    $("#editarCedulaClie").val(respuesta["cedula"]);
                    $("#editarNitClie").val(respuesta["nit"].substring(0, respuesta["nit"].length-4));
                    document.getElementById("dv").textContent = respuesta["nit"].substring(respuesta["nit"].length-1, respuesta["nit"].length);
                    $("#editarEmailClie").val(respuesta["email"]);
                    $("#EditarTipoCliente").val(respuesta["tipocliente"]);
                    $("#editarTelefonoClie").val(respuesta["telefono"]);
                    $("#editarCelularClie").val(respuesta["celular"]);
                    $("#editarCiudadClie").val(respuesta["ciudad"]);
                    $("#editarDireccionClie").val(respuesta["direccion"]);
                    $("#EditarTipoCliente").val(respuesta["idtipocliente"]);
                    valCliente = new Array(respuesta["idcliente"], respuesta["cedula"], respuesta["nit"]);
                    $(".errorCedulaClie").remove();
                }
            }
        });
    }
    //restablecer
    $('.btn-cancelar-upd-cliente').on('click',function(e){
        var cont = ["editarNombresClie", "editarApellidosClie", "editarCedulaClie", "editarNitClie", "editarEmailClie", "EditarTipoCliente", "editarTelefonoClie", "editarCelularClie", "editarCiudadClie", "editarDireccionClie"];
        for (var i = 0; i < cont.length; i++){
            document.getElementById(String(cont[i])).value="";
            $(String("#"+cont[i])+"-error").remove();
        }
        editarCliente(objCliente()[0]);
        document.getElementById('btn-upd-cliente').disabled = false;
    })
});

function objCliente(){
    return valCliente;
}
$('#frmEditarCliente').ready(function(){

    $.validator.addMethod("letrasespacios", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zñA-ZÑ\s\\áéíóúÁÉÍÓÚ]{1,}$/);
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
    
    $('#frmEditarCliente').validate({
        rules:
        {
            editarNombresClie:{required: true, letrasespacios: true },
            editarApellidosClie:{required: true, letrasespacios: true },
            editarCedulaClie:{required: true,  digits : true, minlength: 7, maxlength: 15},
            editarNitClie:{required: true, digits: true, minlength: 7, maxlength: 15},
            editarEmailClie:{required: true, email: true},  
            EditarTipoCliente:{valor: "" }, 
            editarTelefonoClie:{ required: true, minlength: 13, telefono:true },
            editarCelularClie:{ required: true, minlength: 19, celular:true },
            editarCiudadClie: {required: false, letrasespacios: true},
            editarDireccionClie: {required: false, direccion: true},
        },
        messages:{
            editarNombresClie:{ required: "Ingresar nombre(s)", letrasespacios:"Ingresar solo letras" },
            editarApellidosClie:{ required: "Ingresar apellidos", letrasespacios:"Ingresar solo letras" },
            editarCedulaClie:{ required: "Ingresar c&eacute;dula", digits: "Ingresar solo digitos para para la c&eacute;dula", minlength: "Ingresar 7 digitos como m&iacute;nimo" },
            editarNitClie:{  required: "Ingresar nit", digits: "Ingresar solo digitos para para el nit", minlength: "Ingresar 7 digitos como m&iacute;nimo"  },
            editarEmailClie:{ required: "Ingresar email", email: "Ingresar un email valido"  },
            EditarTipoCliente:{ required: "Seleccionar tipo cliente", valueNotEquals: "Seleccionar tipo cliente"  },
            editarTelefonoClie:{ required: "Ingresar número teléfono",  minlength: "N&uacute;mero de teléfono no v&aacute;lido", telefono: "Formato no válido" },
            editarCelularClie:{ required: "Ingresar número celular" ,minlength: "N&uacute;mero de celular no v&aacute;lido",  celular: "Formato no válido" },
            editarCiudadClie:{ required: "Ingresar ciudad", letrasespacios:"Ingresar solo letras" },
            editarDireccionClie:{ required: "Ingresar dirección", direccion:"Ingresar dirección valida" },

        },
        submitHandler: submitForm
    });
    function submitForm(){
        //cargamos el script para uso de variables de este 
        var datos = new FormData();
        datos.append("idClienteupd",objCliente()[0]);
        datos.append("editarNombresClie",$("#editarNombresClie").val().trim());
        datos.append("editarApellidosClie",$("#editarApellidosClie").val().trim());
        datos.append("editarCedulaClie",$("#editarCedulaClie").val().trim().toLowerCase());
        datos.append("editarNitClie",$("#editarNitClie").val().trim().toLowerCase()+' - '+document.getElementById("dv").textContent);
        datos.append("editarEmailClie",$("#editarEmailClie").val().trim());
        datos.append("EditarTipoCliente",$("#EditarTipoCliente").val().trim());
        datos.append("editarTelefonoClie",$("#editarTelefonoClie").val().trim());
        datos.append("editarCelularClie",$("#editarCelularClie").val().trim());
        datos.append("editarCiudadClie",$("#editarCiudadClie").val().trim());
        datos.append("editarDireccionClie",$("#editarDireccionClie").val().trim());
        $.ajax({
            type : 'POST',
            url  : "ajax/clientes/actualizarCliente.ajax.php",
            data : datos,
            //para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $(".btn-upd-cliente").html('<i class="fa fa-refresh"></i> Verificando...');
            },
            success: function(respuesta){
                if(respuesta == "errorConexion" || respuesta == "errorActualizar"){
                    $(".btn-upd-cliente").html('<span class="fa fa-pencil"></span> Registrar');
                    swal({
                        type: "error",
                        title: "Error al actualizar el cliente\nNo es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
                if(respuesta == "ok"){
                    swal({
                        type: "success",
                        title: "¡El cliente ha sido modificado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(function(result){
                        if(result.value){
                            window.location = "verClientes";
                        }
                    });
                }
            }
        });
    };
});
