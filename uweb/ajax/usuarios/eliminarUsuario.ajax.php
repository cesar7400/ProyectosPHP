<?php
session_start();
require_once "../../controlador/usuarios.controlador.php";
require_once "../../modelo/usuarios.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxUsuarios{

    //eliminar usuario
    public function ajaxEliminarUsuario(){

        $datos = array("idusuario" => $this->idusuario,
                       "imagen" => $this->imagen,
                       "usuario" => $this->usuario);
        $respuesta=ControladorUsuario::ctrEliminarUsuario($datos);
        echo json_encode($respuesta);
    }
}
//eliminar usuario
if(isset($_POST["idUsuario"]) && isset($_POST["imagenUsuario"]) && isset($_POST["nombreUsuario"])){

    $eliminarUsuario = new AjaxUsuarios();
    $eliminarUsuario -> idusuario = $_POST["idUsuario"];
    $eliminarUsuario -> imagen = $_POST["imagenUsuario"];
    $eliminarUsuario -> usuario = $_POST["nombreUsuario"];
    $eliminarUsuario -> ajaxEliminarUsuario();
}

?>