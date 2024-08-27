<?php
    require_once "../../controlador/tipoCliente.controlador.php";
    require_once "../../modelo/tipoCliente.modelo.php";

    class AjaxtipoClienteValidar{

        public $tipoClienteVal;
        public function ajaxVertipoCliente(){
            $item = "tipocliente";
            $valor = $this->tipoClienteVal;
            $respuesta = controladorTipocliente::ctrMostrarTipoCliente($item,$valor);
            echo json_encode($respuesta);
        }
    }
    
    //validar categoría
    if(isset($_POST["tipoClienteVal"])){
        $tipoclienteVal = new AjaxtipoClienteValidar();
        $tipoclienteVal -> tipoClienteVal = $_POST["tipoClienteVal"];
        $tipoclienteVal -> ajaxVertipoCliente();
    }
?>