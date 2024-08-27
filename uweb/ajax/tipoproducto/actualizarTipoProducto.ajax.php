<?php
session_start();
require_once "../../controlador/tipoProducto.controlador.php";
require_once "../../modelo/tipoProducto.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxTipProductoEd{

    //editar Categoria
    public $idTipoProducto;
    public $editarTipoProducto;
    public function editarTipoProducto(){

        $datos = array("idtipoproducto" => $this->idTipoProducto,
                       "tipoproducto" => $this->editarTipoProducto);
        $respuesta = controladorTipoProducto::ctrEditarTipoProducto($datos);
        echo json_encode($respuesta);
    }
}

//editar tipo cliente
if(isset($_POST["idTipoProductoEd"]) && isset($_POST["editarTipoProducto"])){

    $editarTipoProducto = new AjaxTipProductoEd();
    $editarTipoProducto -> idTipoProducto = $_POST["idTipoProductoEd"];
    $editarTipoProducto -> editarTipoProducto = $_POST["editarTipoProducto"];
    $editarTipoProducto -> editarTipoProducto();
}
?>
