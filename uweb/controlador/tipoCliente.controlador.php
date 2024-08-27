<?php
class controladorTipocliente{

    //crear tipo cliente
    static public function ctrCrearTipoCliente($valor){
        
        $tabla = "tipocliente";
        $respuesta = ModeloTipocliente::mdlIngresarTipoCliente($tabla,$valor);
        $datos = array("idusuario" => $_SESSION["idUsuario"],
                       "tipomovimiento" => "tipocliente",
                       "estado_actual" => "Nuevo tipo cliente",
                       "id" => $_SESSION['idTp']);
        ControladorHistorial::ctrNuevoHistorial($datos);
        return $respuesta;
    }
    /*Mostrar tipo cliente*/
    static public function ctrMostrarTipoCliente($item,$valor){
        $tabla="tipocliente";
        $respuesta = ModeloTipocliente::MdlMostrarTipoCliente($tabla,$item,$valor);
        return $respuesta;
    }
    //editar tipo cliente
    static public function ctrEditarTipoCliente($datos){

        $tabla = "tipocliente";
        $respuesta = ModeloTipocliente::mdlEditarTipoCliente($tabla,$datos);
        $datos = array("idusuario" => $_SESSION["idUsuario"],
                       "tipomovimiento" => "tipocliente",
                       "estado_actual" => "Actualizo tipo cliente",
                       "id" => $datos["idtipocliente"]);
        ControladorHistorial::ctrNuevoHistorial($datos);
        return $respuesta;
    }
    //eliminar categoria
    static public function ctrEliminarTipoCliente($datos){

        $tabla="tipocliente";
        $respuesta = ModeloTipocliente::mdlEliminarTipoCliente($tabla,$datos);
        $datos = array("idusuario" => $_SESSION["idUsuario"],
                       "tipomovimiento" => "tipocliente",
                       "estado_actual" => "Elimino tipo cliente:' ".$datos['tipocliente']."'",
                       "id" => $datos["idtipocliente"]);
        ControladorHistorial::ctrNuevoHistorial($datos);
        return $respuesta;
    }
}

?>