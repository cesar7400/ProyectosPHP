<?php
session_start();
require_once "../../controlador/producto.controlador.php";
require_once "../../modelo/producto.modelo.php";
require_once "../../controlador/tipoProducto.controlador.php";
require_once "../../modelo/tipoProducto.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class ajaxTipoproEl{

    //eliminar tipo cliente
    public function EliminarTipoProducto(){

        $valor = $this->idTipoProEl;
        $valoRpta = ControladorProducto::ctrVerfTipoProducto($valor);
        if($valoRpta == ""){
            $datos = array("idtipoproducto" => $this->idTipoProEl,
                           "tipoproducto" => $this->tipoProEl);
            $respuesta = controladorTipoProducto::ctrEliminarTipoProducto($datos);
            echo json_encode($respuesta);
        }else{
            echo json_encode($valoRpta);
        }
    }
}

//eliminar tipo producto
if(isset($_POST["idTipoProEl"]) && isset($_POST["tipoProEl"])){

    $eliminarTipoPro = new ajaxTipoproEl();
    $eliminarTipoPro -> idTipoProEl = $_POST["idTipoProEl"];
    $eliminarTipoPro -> tipoProEl = $_POST["tipoProEl"];
    $eliminarTipoPro -> EliminarTipoProducto();
}

?>