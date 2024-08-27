<?php
session_start();
require_once "../../controlador/usuarios.controlador.php";
require_once "../../modelo/usuarios.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxUsuarioActivar{

    public function ajaxActivarUsuario(){
        $item = "estado";
        $datos = array("idusuario" => $this->idusuario,
                       "estado" => $this->estado);
        $item ="estado";
        $respuesta = ControladorUsuario::ctrActivarDesactivar($item,$datos);
        echo json_encode($respuesta);
    }
}
//activar-desactivar usuario
if(isset($_POST["idUsuario"]) && isset($_POST["estadoUsuario"])){
    $activarUsuario = new AjaxUsuarioActivar();
    $activarUsuario -> idusuario = $_POST["idUsuario"];
    $activarUsuario -> estado = $_POST["estadoUsuario"];
    $activarUsuario -> ajaxActivarUsuario();
}
?>