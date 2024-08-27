<?php
    class ControladorCliente{

        //nuevo cliente
        static public function ctrNuevoCliente($datos){ 
            $tabla="clientes";
            $respuesta = ModeloCliente::MdlNuevoCliente($tabla,$datos);
            $datos = array("idusuario" => $_SESSION["idUsuario"],
                           "tipomovimiento" => "cliente",
                           "estado_actual" => "Nuevo cliente",
                           "id" => $_SESSION['insertID']);
            ControladorHistorial::ctrNuevoHistorial($datos);
            return $respuesta;
        }

        /*Mostrar tipo cliente*/
        static public function ctrVerTipoCliente(){
            $tabla="tipocliente";
            $respuesta = ModeloCliente::MdlMostrarTipoCliente($tabla);
            return $respuesta;
        }
        /*mostrar uso idtipocliente(verificar)*/
        static public function ctrVerfTipoCliente($valor){
            $tabla="clientes";
            $respuesta = ModeloCliente::MdlVerfTipoCliente($tabla,$valor);
            return $respuesta;
        }
        /*Mostrar clientes*/
        static public function ctrVerClientes($item,$valor){
            $tabla="clientes";
            $respuesta = ModeloCliente::MdlVerClientes($tabla,$item,$valor);
            return $respuesta;
        }
        //actualiza cliente seleccionado
        static public function ctreditarClienteSel($datos){
            $tabla = "clientes";
            $respuesta = ModeloCliente::MdleditarClienteSel($tabla, $datos);
            $datos = array("idusuario" => $_SESSION["idUsuario"],
                           "tipomovimiento" => "cliente",
                           "estado_actual" => "Edito cliente",
                           "id" => $datos['idcliente']);
            ControladorHistorial::ctrNuevoHistorial($datos);
            return $respuesta;
        }
        /*antidad clientes*/
        static public function ctrCantClientes(){
            $tabla="clientes";
            $respuesta = ModeloCliente::MdlCantlientes($tabla);
            return $respuesta;
        }
    }
?>