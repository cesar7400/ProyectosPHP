<?php
require_once "../../controlador/tipoProducto.controlador.php";
require_once "../../modelo/tipoProducto.modelo.php";

class AjaxTipoProductoSel{

    //seleccionar Categoria para actualizar
    public $idSelTipoProducto;
    public function SelTipoProducto(){
        
        $item = "idtipoproducto";
        $valor = $this->idSelTipoProducto;
        $respuesta = controladorTipoProducto::ctrMostrarTipoProducto($item,$valor);
        echo json_encode($respuesta);
    }
}

//seleccionar tipo producto para actualizar
if(isset($_POST["idSelTipoProducto"])){

    $selTipoProductoEd = new AjaxTipoProductoSel();
    $selTipoProductoEd -> idSelTipoProducto = $_POST["idSelTipoProducto"];
    $selTipoProductoEd -> SelTipoProducto();
}
?>