<?php
class controladorTipoProducto{

    //crear tipo producto
    static public function ctrCrearTipoProducto($valor){
        
        $tabla = "tipoproducto";
        $respuesta = ModeloTipoProducto::mdlIngresarTipoProducto($tabla,$valor);
        $datos = array("idusuario" => $_SESSION["idUsuario"],
                       "tipomovimiento" => "tipoproducto",
                       "estado_actual" => "Nuevo tipo producto",
                       "id" => $_SESSION['idTpr']);
        ControladorHistorial::ctrNuevoHistorial($datos);
        return $respuesta;
    }
    /*Mostrar tipo producto*/
    static public function ctrMostrarTipoProducto($item,$valor){
        $tabla="tipoproducto";
        $respuesta = ModeloTipoProducto::MdlMostrarTipoProducto($tabla,$item,$valor);
        return $respuesta;
    }
    //editar tipo producto
    static public function ctrEditarTipoProducto($datos){

        $tabla = "tipoproducto";
        $respuesta = ModeloTipoProducto::mdlEditarTipoProducto($tabla,$datos);
        $datos = array("idusuario" => $_SESSION["idUsuario"],
                       "tipomovimiento" => "tipoproducto",
                       "estado_actual" => "Actualizo tipo producto",
                       "id" => $datos["idtipoproducto"]);
        ControladorHistorial::ctrNuevoHistorial($datos);
        return $respuesta;
    }
    //eliminar tipoproducto
    static public function ctrEliminarTipoProducto($datos){

        $tabla="tipoproducto";
        $respuesta = ModeloTipoProducto::mdlEliminarTipoProducto($tabla,$datos);
        $datos = array("idusuario" => $_SESSION["idUsuario"],
                       "tipomovimiento" => "tipoproducto",
                       "estado_actual" => "Elimino tipo producto:' ".$datos['tipoproducto']."'",
                       "id" => $datos["idtipoproducto"]);
        ControladorHistorial::ctrNuevoHistorial($datos);
        return $respuesta;
    }
}

?>