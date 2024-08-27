<?php
require_once "../../controlador/tipoCliente.controlador.php";
require_once "../../modelo/tipoCliente.modelo.php";

class AjaxTipoClienteSel{

    //seleccionar Categoria para actualizar
    public $idSelTipoCliente;
    public function SelTipoCliente(){
        
        $item = "idtipocliente";
        $valor = $this->idSelTipoCliente;
        $respuesta = controladorTipocliente::ctrMostrarTipoCliente($item,$valor);
        echo json_encode($respuesta);
    }
}

//seleccionar Categoria para actualizar
if(isset($_POST["idSelTipoCliente"])){

    $selTipoClienteEd = new AjaxTipoClienteSel();
    $selTipoClienteEd -> idSelTipoCliente = $_POST["idSelTipoCliente"];
    $selTipoClienteEd -> SelTipoCliente();
}
?>