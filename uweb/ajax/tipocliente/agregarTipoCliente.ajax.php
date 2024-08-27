<?php
session_start();
require_once "../../controlador/tipoCliente.controlador.php";
require_once "../../modelo/tipoCliente.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxNuevoTipocliente{

    public $nuevoTipoCliente;
    public function NuevoTipoCliente(){
        $valor = $this->nuevoTipoCliente;
        $respuesta=controladorTipocliente::ctrCrearTipoCliente($valor);
        echo json_encode($respuesta);
    }
}

//ingresar tipo cliente
if(isset($_POST["nuevoTipoCliente"])){

    $nuevoTipoCliente = new AjaxNuevoTipocliente();
    $nuevoTipoCliente -> nuevoTipoCliente = $_POST["nuevoTipoCliente"];
    $nuevoTipoCliente -> NuevoTipoCliente();
}
?>