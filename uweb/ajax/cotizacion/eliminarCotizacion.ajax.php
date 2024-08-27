<?php
session_start();
require_once "../../controlador/cotizacion.controlador.php";
require_once "../../modelo/cotizacion.modelo.php";

class EliminarCotizacion{

    public function ajaxEliminarCotizacion(){
        $datos = array("idcotizacion" => $this->IdCotizacionEliminar);
        $respuesta=ControladorCotizacion::CtrEliminaCot($datos);
        echo json_encode($respuesta);
    }
}
//eliminar producto cotizacion
if(isset($_POST["IdCotizacionEliminar"])){

    $eliminarCotizacion = new EliminarCotizacion();
    $eliminarCotizacion -> IdCotizacionEliminar = $_POST["IdCotizacionEliminar"];
    $eliminarCotizacion -> ajaxEliminarCotizacion();
}
?>