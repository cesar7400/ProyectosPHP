<?php
session_start();
require_once "../../controlador/usuarios.controlador.php";
require_once "../../modelo/usuarios.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxUsuarios{

    public function ajaxEditarUsuario(){
        $datos = array("idusuario" => $this->idUsuarioupd,
                       "nombres" => $this->editarNombres,
                       "apellidos" => $this->editarApellidos,
                       "email" => $this->editarEmail,
                       "editaUsuario" => $this->editaUsuario,
                       "editarPassword" => $this->editarPassword,
                       "imagenEditar" => $this->imagenEditar,
                       "imagenActual" => $this->imagenActual,
                       "usuarioActual" => $this->usuarioActual,
                       "passworActual" => $this->passworActual,
                       "fechamodificacion" => $this->fechamodificacion);
                       $respuesta=ControladorUsuario::ctrEditarUsuario($datos);
                       echo json_encode($respuesta); 
    }
}
//actualizar usuario
if(isset($_POST["idUsuarioupd"]) && isset($_POST["editarNombres"]) && isset($_POST["editarApellidos"]) && isset($_POST["editarEmail"]) 
   && isset($_POST["imagenActual"]) && isset($_POST["usuarioActual"]) && isset($_POST["passworActual"])
   && isset($_POST["editaUsuario"])){
   //registro fecha ultimo login
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;
    $editarsuario = new AjaxUsuarios();
    $editarsuario -> idUsuarioupd = $_POST["idUsuarioupd"];
    $editarsuario -> editarNombres = $_POST["editarNombres"];
    $editarsuario -> editarApellidos = $_POST["editarApellidos"];
    $editarsuario -> editarEmail = $_POST["editarEmail"];
    $editarsuario -> editaUsuario = $_POST["editaUsuario"];
    $editarsuario -> editarPassword = $_POST["editarPassword"];
    $editarsuario -> imagenActual = $_POST["imagenActual"];
    $editarsuario -> usuarioActual = $_POST["usuarioActual"];
    $editarsuario -> passworActual = $_POST["passworActual"]; 
    $editarsuario -> fechamodificacion = $fechaActual; 
    if(isset($_FILES["imagenEditar"]['tmp_name'])){
        $editarsuario -> imagenEditar = $_FILES["imagenEditar"];
    }else{
        $editarsuario -> imagenEditar = "";
    }
    $editarsuario -> ajaxEditarUsuario();
}
?>