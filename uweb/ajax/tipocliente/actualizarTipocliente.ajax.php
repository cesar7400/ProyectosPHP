<?php
session_start();
require_once "../../controlador/tipoCliente.controlador.php";
require_once "../../modelo/tipoCliente.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxTipClienteEd{

    //editar Categoria
    public $idTipoCliente;
    public $editarTipoCliente;
    public function editarTipoCliente(){

        $datos = array("idtipocliente" => $this->idTipoCliente,
                       "tipocliente" => $this->editarTipoCliente);
        $respuesta = controladorTipocliente::ctrEditarTipoCliente($datos);
        echo json_encode($respuesta);
    }
}

//editar tipo cliente
if(isset($_POST["idTipoClienteEd"]) && isset($_POST["editarTipoCliente"])){

    $editarTipoCliente = new AjaxTipClienteEd();
    $editarTipoCliente -> idTipoCliente = $_POST["idTipoClienteEd"];
    $editarTipoCliente -> editarTipoCliente = $_POST["editarTipoCliente"];
    $editarTipoCliente -> editarTipoCliente();
}
?>
