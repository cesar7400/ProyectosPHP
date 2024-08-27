<?php
session_start();
require_once "../../controlador/usuarios.controlador.php";
require_once "../../modelo/usuarios.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxUsuarios{
    
    public function ajaxNuevoUsuario(){
        $datos = array("nombres" => $this->nuevoNombre,
                       "apellidos" => $this->nuevoApellido,
                       "email" => $this->nuevoEmail,
                       "usuario" => $this->nuevoUsuario,
                       "password" => $this->nuevoPassword,
                       "imagen" => $this->imagen,
                       "estado" => $this->estado);
        $respuesta=ControladorUsuario::ctrNuevoUsuario($datos);
        echo json_encode($respuesta);
    }
}
//ingresar usuario
if(isset($_POST["nuevoNombre"]) && isset($_POST["nuevoApellido"]) && isset($_POST["nuevoEmail"]) && isset($_POST["nuevoUsuario"]) 
   && isset($_POST["nuevoPassword"])){

    $ingresarUsuario = new AjaxUsuarios();
    $ingresarUsuario -> nuevoNombre = $_POST["nuevoNombre"];
    $ingresarUsuario -> nuevoApellido = $_POST["nuevoApellido"];
    $ingresarUsuario -> nuevoEmail = $_POST["nuevoEmail"];
    $ingresarUsuario -> nuevoUsuario = $_POST["nuevoUsuario"];
    $ingresarUsuario -> nuevoPassword = $_POST["nuevoPassword"];
    $ingresarUsuario -> estado = $_POST["estado"];
    if(isset($_FILES["nuevaImagen"]['tmp_name'])){
        $ingresarUsuario -> imagen = $_FILES["nuevaImagen"];
    }else{
        $ingresarUsuario -> imagen = "";
    }
    $ingresarUsuario -> ajaxNuevoUsuario();
}
?>