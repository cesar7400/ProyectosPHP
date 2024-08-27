
<?php
    require_once "../../controlador/tipoProducto.controlador.php";
    require_once "../../modelo/tipoProducto.modelo.php";

    class AjaxtipoProductoValidar{

        public $tipoProductoVal;
        public function VertipoProducto(){
            $item = "tipoproducto";
            $valor = $this->tipoProductoVal;
            $respuesta = controladorTipoProducto::ctrMostrarTipoProducto($item,$valor);
            echo json_encode($respuesta);
        }
    }
    
    //validar categoría
    if(isset($_POST["tipoProductoVal"])){
        $tipoProductoVal = new AjaxtipoProductoValidar();
        $tipoProductoVal -> tipoProductoVal = $_POST["tipoProductoVal"];
        $tipoProductoVal -> VertipoProducto();
    }
?>