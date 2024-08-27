<?php
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class TablaHistorialBorrar{

    //eliminar usuario
    public function borrarTablaHistorial(){

        $respuesta=ControladorHistorial::ctrEliminarHistorial();
        echo json_encode($respuesta);
    }
}

//activa tabla productos
$borrarHistorial = new TablaHistorialBorrar();
$borrarHistorial -> borrarTablaHistorial();

?>