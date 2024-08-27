    //validaciones inicio sesion del usuario
$('.btninicioSesion').on('click',function(e){

    var valSesion = /^([a-zA-Z0-9@.]){1,}$/;
    var usuarioIng = document.forms['FrminicioSesion'].elements[0].value;
    var passwordIng = document.forms['FrminicioSesion'].elements[1].value;
    //comprobar si exite elemento en el DOM
    if ($('#loginError').length){
        document.getElementById("loginError").remove();
    }
    if(usuarioIng == ""){
        document.getElementById('errorLogin').innerHTML = '<div class="alert alert-info">El nombre de usuario no puede ir en blanco</div>';
        document.forms['FrminicioSesion'].elements[0].focus();
        e.preventDefault();
        return
    }
    if(valSesion.test(usuarioIng)==false){
        document.getElementById('errorLogin').innerHTML = '<div class="alert alert-info">El nombre de usuario tiene caracteres no válidos</div>';
        document.forms['FrminicioSesion'].elements[0].value="";
        document.forms['FrminicioSesion'].elements[0].focus();
        e.preventDefault();
        return;
    } 
    if(passwordIng == ""){
        document.getElementById('errorLogin').innerHTML = '<div class="alert alert-info">La contraseña no puede ir en blanco</div>';
        document.forms['FrminicioSesion'].elements[1].focus();
        e.preventDefault();
        return;
    }
    if(valSesion.test(passwordIng)==false){
        document.getElementById('errorLogin').innerHTML = '<div class="alert alert-info">La contraseña tiene caracteres no válidos</div>';
        document.forms['FrminicioSesion'].elements[1].value="";
        document.forms['FrminicioSesion'].elements[1].focus();
        e.preventDefault();
        return;
    } 
});