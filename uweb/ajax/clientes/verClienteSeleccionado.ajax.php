<?php
require_once "../../controlador/cliente.controlador.php";
require_once "../../modelo/cliente.modelo.php";

class AjaxCliente{

    public $idVerClienteSel;
    public function ajaxVerCliente(){
        $item = "idcliente";
        $valor = $this->idVerClienteSel;
        $respuesta = ControladorCliente::ctrVerClientes($item,$valor);
        echo json_encode($respuesta);
    }
}

//ver usuario
if(isset($_POST["idVerClienteSel"])){
    $verCliente = new AjaxCliente();
    $verCliente -> idVerClienteSel = $_POST["idVerClienteSel"];
    $verCliente -> ajaxVerCliente();
}

?>