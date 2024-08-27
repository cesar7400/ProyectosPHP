<?php
session_start();
require_once "../../controlador/tipoProducto.controlador.php";
require_once "../../modelo/tipoProducto.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxNuevoTiporoducto{

    public $nuevoTipoCliente;
    public function NuevoTipoProducto(){
        $valor = $this->nuevoTipoProducto;
        $respuesta=controladorTipoProducto::ctrCrearTipoProducto($valor);
        echo json_encode($respuesta);
    }
}

//ingresar tipo cliente
if(isset($_POST["nuevoTipoProducto"])){

    $nuevoTipoProducto = new AjaxNuevoTiporoducto();
    $nuevoTipoProducto -> nuevoTipoProducto = $_POST["nuevoTipoProducto"];
    $nuevoTipoProducto -> NuevoTipoProducto();
}
?>