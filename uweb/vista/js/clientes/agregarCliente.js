//agregar cliente
$('frmClienteNuevo').ready(function(){

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
    /*validation */
    $("#frmClienteNuevo").validate({
        rules:
        {
            nuevoNombreCliente: { required: true, letrasespacios: true },
            nuevoApellidoCliente: { required: true, letrasespacios: true },
            nuevoCedulaCliente: { required: true,  digits : true, minlength: 7 },
            nuevoNitCliente: { required: true,  digits : true, minlength: 7 },
            nuevoTipoCliente: { valor: "" },
            nuevoEmailCliente: { required: true, email: true },
            nuevoTelefonoCliente: { required: true, minlength: 13, telefono:true },
            nuevoCelularCliente: { required: true, minlength: 19, celular: true },
            nuevoCiudadCliente: { required: true, letrasespacios: true },
            nuevoDireccionCliente: { required: true, direccion: true }, 
	   },
        messages:
	   {
            nuevoNombreCliente:{ required: "Ingresar nombre(s)", letrasespacios:"Ingresar solo letras" },
            nuevoApellidoCliente:{ required: "Ingresar apellidos", letrasespacios:"Ingresar solo letras" },
			nuevoCedulaCliente:{ required: "Ingresar c&eacute;dula", digits: "Ingresar solo digitos para para la c&eacute;dula", minlength: "Ingresar 7 digitos como m&iacute;nimo" },
            nuevoNitCliente:{ required: "Ingresar nit", digits: "Ingresar solo digitos para para el nit", minlength: "Ingresar 7 digitos como m&iacute;nimo" },
            nuevoTipoCliente: { required: "Seleccionar tipo cliente", valueNotEquals: "Seleccionar tipo cliente" },
            nuevoEmailCliente:{  required: "Ingresar email", email: "Ingresar un email valido" },
            nuevoTelefonoCliente: { required: "Ingresar número teléfono",  minlength: "N&uacute;mero de teléfono no v&aacute;lido", telefono: "Formato no válido" },
            nuevoCelularCliente: { required: "Ingresar número celular" ,minlength: "N&uacute;mero de celular no v&aacute;lido",  celular: "Formato no válido"},
            nuevoCiudadCliente:{ required: "Ingresar ciudad", letrasespacios:"Ingresar solo letras" },
            nuevoDireccionCliente: { required: "Ingresar dirección", direccion:"Ingresar dirección valida" },
       },
	   submitHandler: submitForm	
       });  

	    function submitForm(){
            
            var datos = new FormData();
            datos.append("nombresCliente",$("#nuevoNombreCliente").val().trim());
            datos.append("apellidosCliente",$("#nuevoApellidoCliente").val().trim());
            datos.append("cedulaCliente",$("#nuevoCedulaCliente").val().trim());
            datos.append("nitCliente",$("#nuevoNitCliente").val().trim()+' - '+document.getElementById("dv").textContent);
            datos.append("emailCliente",$("#nuevoEmailCliente").val().trim());
            datos.append("idtipocliente",$("#nuevoTipoCliente").val().trim());
            datos.append("telefonoCliente",$("#nuevoTelefonoCliente").val().trim());
            datos.append("celularCliente",$("#nuevoCelularCliente").val().trim());
            datos.append("ciudadCliente",$("#nuevoCiudadCliente").val().trim());
            datos.append("direccionCliente",$("#nuevoDireccionCliente").val().trim());
			$.ajax({
			type : 'POST',
			url  : "ajax/clientes/agregarCliente.ajax.php",
			data : datos,
			//para subir archivos por ajax
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
			beforeSend: function(){
				$("#btn-submit_add_cliente").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success: function(respuesta){
                if(respuesta == "errorConexion"){
                    $("#btn-submit_add_cliente").html('<span class="fa fa-save"></span> Ingresar');
                    swal({
                        type: "error",
                        title: "No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
                if(respuesta == "errorAgregar"){
                    $("#btn-submit_add_cliente").html('<span class="fa fa-save"></span> Ingresar');
                    swal({
                        type: "error",
                        title: "Error al ingresar el cliente.<br>No es posible la conexión con el servidor.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
                if(respuesta == "ok"){
                    var cont = ["nuevoTipoCliente", "nuevoNombreCliente", "nuevoApellidoCliente", "nuevoCedulaCliente", "nuevoNitCliente", "nuevoEmailCliente", "nuevoTelefonoCliente", "nuevoCelularCliente", "nuevoCiudadCliente", "nuevoDireccionCliente"];
                    for (var i = 0; i < cont.length; i++){
                        document.getElementById(String(cont[i])).value="";
                        $(String(cont[i]).replace("nuevo","#error")).html('');
                    }
                    $("#btn-submit_add_cliente").html('<span class="fa fa-save"></span> Ingresar');
                    swal({
                        type: "success",
                        title: "El cliente ha sido registrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
			}
		});
    }
});
//limpiar form
$('#btn-cancelar-cliente-add').on('click',function(e){
    var cont = ["nuevoTipoCliente", "nuevoNombreCliente", "nuevoApellidoCliente", "nuevoCedulaCliente", "nuevoNitCliente", "nuevoEmailCliente", "nuevoTelefonoCliente", "nuevoCelularCliente", "nuevoCiudadCliente", "nuevoDireccionCliente"];
    for (var i = 0; i < cont.length; i++){
        document.getElementById(String(cont[i])).value="";
        $(String("#"+cont[i])+"-error").remove();
    }
    document.getElementById('btn-cancelar-cliente-add').disabled = false;
    $(".errorProvCed").remove();
    $(".errorProvcorreo").remove();
    return false;
});