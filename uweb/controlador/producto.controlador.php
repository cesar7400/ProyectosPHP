<?php
    class ControladorProducto{

        //nuevo producto
        static public function ctrNuevoProducto($datos){ 
            $tabla="productos";
            $respuesta = ModeloProducto::MdlNuevoProducto($tabla,$datos);
            $datos = array("idusuario" => $_SESSION["idUsuario"],
                           "tipomovimiento" => "producto",
                           "estado_actual" => "Nuevo producto",
                           "id" => $_SESSION['IDPrd']);
            ControladorHistorial::ctrNuevoHistorial($datos);
            return $respuesta;
        }
        /*Mostrar productos*/
        static public function ctrVerProductos($item,$valor){
            $tabla="productos";
            $respuesta = ModeloProducto::MdlVerProductos($tabla,$item,$valor);
            return $respuesta;
        }
        //actualiza producto seleccionado
        static public function ctreditarProductoSel($datos){ 
            $tabla = "productos";
            $respuesta = ModeloProducto::MdleditarProductoSel($tabla, $datos);
            $datos = array("idusuario" => $_SESSION["idUsuario"],
                           "tipomovimiento" => "producto",
                           "estado_actual" => "Edito producto",
                           "id" => $datos['idproducto']);
            ControladorHistorial::ctrNuevoHistorial($datos);
            return $respuesta;
        }
        /*mostrar uso idtipoproducto(verificar)*/
        static public function ctrVerfTipoProducto($valor){
            $tabla="productos";
            $respuesta = ModeloProducto::MdlVerfTipoProducto($tabla,$valor);
            return $respuesta;
        }
        /*cantidad productos*/
        static public function ctrCantProducto(){
            $tabla="productos";
            $respuesta = ModeloProducto::MdlCantProducto($tabla);
            return $respuesta;
        }
    }
?>