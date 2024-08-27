<?php
session_start();
require_once "../../controlador/cotizacion.controlador.php";
require_once "../../modelo/cotizacion.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxClienteCot{
    
    public function IngresarClienteCot(){
        $datos = array("idcliente" => $this->idClienteCot,
                       "estado" => $this->estado);
        $respuesta=ControladorCotizacion::ctrCotizacionEstado($datos['idcliente']);
        if($respuesta != ""){
            echo json_encode($respuesta['idcotizacion']);
        }else{
            $respuesta=ControladorCotizacion::ctrNuevoCotizacion($datos);
            echo json_encode($respuesta);
        }
    }
}
//ingresar cliente seleccionado
if(isset($_POST["idClienteCot"])){

    $SeleccionarClienteCot = new AjaxClienteCot();
    $SeleccionarClienteCot -> idClienteCot = $_POST["idClienteCot"];
    $SeleccionarClienteCot -> estado = '0';
    $SeleccionarClienteCot -> IngresarClienteCot();
}

?>