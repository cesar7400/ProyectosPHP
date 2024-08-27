<?php
session_start();
require_once "../../controlador/cliente.controlador.php";
require_once "../../modelo/cliente.modelo.php";
require_once "../../controlador/tipoCliente.controlador.php";
require_once "../../modelo/tipoCliente.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class ajaxTipocliEl{

    //eliminar tipo cliente
    public function EliminarTipoCliente(){

        $valor = $this->idTipoCliEl;
        $valoRpta = ControladorCliente::ctrVerfTipoCliente($valor);
        if($valoRpta == ""){
            $datos = array("idtipocliente" => $this->idTipoCliEl,
                           "tipocliente" => $this->tipoClieEl);
            $respuesta = controladorTipocliente::ctrEliminarTipoCliente($datos);
            echo json_encode($respuesta);
        }else{
            echo json_encode($valoRpta);
        }
    }
}

//eliminar tipo cliente
if(isset($_POST["idTipoCliEl"]) && isset($_POST["tipoClieEl"])){

    $eliminarTipoCli = new ajaxTipocliEl();
    $eliminarTipoCli -> idTipoCliEl = $_POST["idTipoCliEl"];
    $eliminarTipoCli -> tipoClieEl = $_POST["tipoClieEl"];
    $eliminarTipoCli -> EliminarTipoCliente();
}

?>