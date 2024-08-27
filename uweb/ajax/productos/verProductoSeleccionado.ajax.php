<?php
require_once "../../controlador/producto.controlador.php";
require_once "../../modelo/producto.modelo.php";

class AjaxProducto{

    public $idVerClienteSel;
    public function VerProducto(){
        $item = "idproducto";
        $valor = $this->idverProudctoSel;
        $respuesta = ControladorProducto::ctrVerProductos($item,$valor);
        echo json_encode($respuesta);
    }
}

//ver usuario
if(isset($_POST["idverProudctoSel"])){
    $verProducto = new AjaxProducto();
    $verProducto -> idverProudctoSel = $_POST["idverProudctoSel"];
    $verProducto -> VerProducto();
}

?>