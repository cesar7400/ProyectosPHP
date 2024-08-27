<?php
    class ControladorCotizacion{

        //nuevo cotizacion cliente
        static public function ctrNuevoCotizacion($datos){
            $tabla="cotizacion";
            $respuesta = ModeloCotizacion::MdlNuevoCotizacion($tabla,$datos);
            $datos = array("idusuario" => $_SESSION["idUsuario"],
                           "tipomovimiento" => "cotizacion",
                           "estado_actual" => "Nuevo cotizacion",
                           "id" => $respuesta);
            ControladorHistorial::ctrNuevoHistorial($datos);
            return $respuesta;
        }
        //recuperar estado cotizacion
        static public function ctrCotizacionEstado($idCliente){
            $tabla="cotizacion";
            $respuesta = ModeloCotizacion::MdlCotizacionEstado($tabla,$idCliente);
            return $respuesta;
        }
        //nuevo cotizacion productos
        static public function ctrNuevoCotizacionDetalle($datos){
            $tabla="detallecotizacion";
            $respuesta = ModeloCotizacion::MdlNuevoCotizacionDetalle($tabla,$datos);
            return $respuesta;
        }
        //eliminar cotización/eliminar productos cotizacion abierta
        static public function ctrEliminarCotizacion($datos){
            $tabla="detallecotizacion";
            $respuesta = ModeloCotizacion::MdlEliminarCotizacion($tabla,$datos);
            return $respuesta;
        }
        //evitar producto 2 veces en la cotización
        static public function CtrCotizacionProdctoVer($datos,$opcion){
            $tabla="detallecotizacion";
            $respuesta = ModeloCotizacion::MdlCotizacionProdctoVer($tabla,$datos,$opcion);
            return $respuesta;
        }
        //guardar cotizacion
        static public function CtrGuardarCotizacion($opcion,$datos){

            if($opcion =="guardarcambios"){
                $tabla="detallecotizacion";
                $respuesta = ModeloCotizacion::MdlGuardarCotizacion($tabla,$datos,$opcion);
                return $respuesta;
            }else{
                $tabla="cotizacion";
                $opcion="guardarcotizacion";
                $respuesta = ModeloCotizacion::MdlGuardarCotizacion($tabla,$datos,$opcion);
                $datosHis = array("idusuario" => $_SESSION["idUsuario"],
                                  "tipomovimiento" => "cotizacion",
                                  "estado_actual" => "guardar cotizacion",
                                  "id" => $datos['idcotizacion']);
                ControladorHistorial::ctrNuevoHistorial($datosHis);
                return $respuesta;
            }
        }
        //ver cotizaciones
        static public function CtrMdlCotizacionesVer($opcion,$idcotizacion){
            $respuesta = ModeloCotizacion::MdlCotizacionesVer($opcion,$idcotizacion);
            return $respuesta;
        }
        //consular ventas cotizacion
        static public function ctrCotizacionConsultarVentas($fechaInicio,$fechaFin,$opcion){
            $respuesta = ModeloCotizacion::MdlCotizacionConsultarVentas($fechaInicio,$fechaFin,$opcion);
            return $respuesta;
        }
        //ver cotizaciones 
        static public function CtrCotizacionValorDetalle($idcotizacion){
            $tabla="cotizacion";
            $respuesta = ModeloCotizacion::MdlCotizacionValorDetalle($tabla,$idcotizacion);
            return $respuesta;
        }
        //eliminar cotización/eliminar productos cotizacion abierta
        static public function CtrEliminaCot($datos){
            $tabla="cotizacion";
            $respuesta = ModeloCotizacion::MdlEliminaCot($tabla,$datos);
            return $respuesta;
        }
        //eliminar cotización/eliminar productos cotizacion abierta
        static public function CtrTotalVentas(){
            $tabla="cotizacion";
            $respuesta = ModeloCotizacion::MdlCotizacionTotalVentas($tabla);
            return $respuesta;
        }
    }
?>