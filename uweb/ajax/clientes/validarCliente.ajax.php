<?php
    require_once "../../controlador/cliente.controlador.php";
    require_once "../../modelo/cliente.modelo.php";

    class AjaxClienteValidar{

        public $val,$item;
        public function ajaxVerCliente(){
            $item = $this->item;
            $valor = $this->val;
            $respuesta = ControladorCliente::ctrVerClientes($item,$valor);
            echo json_encode($respuesta);
        }
    }
    
    //validar cedula cliente
    if(isset($_POST["cedula"])){
        $validar = new AjaxClienteValidar();
        $validar -> item = "cedula";
        $validar -> val = $_POST["cedula"];
        $validar -> ajaxVerCliente();
    }
    //validar nit cliente
    if(isset($_POST["nit"])){
        $validar = new AjaxClienteValidar();
        $validar -> item = "nit";
        $validar -> val = $_POST["nit"];
        $validar -> ajaxVerCliente();
    }
?>