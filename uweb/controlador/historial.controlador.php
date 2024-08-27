<?php
    class ControladorHistorial{

        //nuevo movimiento
        static public function ctrNuevoHistorial($datos){
            $tabla="historial";
            $respuesta = ModeloHistorial::MdlNuevoHistorial($tabla,$datos);
            return $respuesta;
        }

        //eliminar usuario
        static public function ctrEliminarHistorial(){
            $tabla = "historial";
            $respuesta = ModeloHistorial::MdlEliminarHistorial($tabla);
            return $respuesta;
        }

        //mostrar historial
        static public function ctrVerHistorial(){
            $respuesta = ModeloHistorial::MdlVerHistorial();
            return $respuesta;
        }
    }
?>