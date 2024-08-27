<?php
session_start();
require_once "../../controlador/cotizacion.controlador.php";
require_once "../../modelo/cotizacion.modelo.php";


class EliminarCot{

    public function ajaxEliminaCotizacion(){
        $datos = array("idcotizacion" => $this->IdCotizacion,
                       "idproducto" => $this->idProductoCot);
        $respuesta=ControladorCotizacion::ctrEliminarCotizacion($datos);
        echo json_encode($respuesta);
    }
}
//eliminar producto cotizacion
if(isset($_POST["idProductoCot"]) && isset($_POST["IdCotizacion"])){

    $eliminaProductoCot = new EliminarCot();
    $eliminaProductoCot -> idProductoCot = $_POST["idProductoCot"];
    $eliminaProductoCot -> IdCotizacion = $_POST["IdCotizacion"];
    $eliminaProductoCot -> ajaxEliminaCotizacion();
}

?>