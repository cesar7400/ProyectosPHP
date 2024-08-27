<?php
    require_once "../../controlador/producto.controlador.php";
    require_once "../../modelo/producto.modelo.php";

    class AjaxProductoValidar{

        public $codigoPr,$item;
        public function validarProducto(){
            $item = $this->item;
            $valor = $this->codigoPr;
            $respuesta = ControladorProducto::ctrVerProductos($item,$valor);
            echo json_encode($respuesta);
        }
    }
    
    //validar código producto
    if(isset($_POST["codigoPr"])){
        $validar = new AjaxProductoValidar();
        $validar -> item = "codigo";
        $validar -> codigoPr = $_POST["codigoPr"];
        $validar -> validarProducto();
    }
?>