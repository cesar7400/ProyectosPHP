<?php
session_start();
require_once "../../controlador/producto.controlador.php";
require_once "../../modelo/producto.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxProductoEditar{

    public function EditarProducto(){
        $datos = array("idproducto" => $this->idproductoPed,
                       "codigo" => $this->codigoPed,
                       "nombre" => $this->nombrePed,
                       "descripcion" => $this->descripcionPed,
                       "valor" => $this->valorPed,
                       "iva" => $this->ivaPed,
                       "valoriva" => $this->valorivaPed,
                       "idtipoproducto" => $this->idtipoproductoPed,
                       "fechamodificacion" => $this->fechamodificacion);
                       $respuesta=ControladorProducto::ctreditarProductoSel($datos);
                       echo json_encode($respuesta); 
    }
}
//actualizar producto
if(isset($_POST["codigoPed"]) && isset($_POST["nombrePed"]) && isset($_POST["descripcionPed"]) && isset($_POST["valorPed"])
    && isset($_POST["ivaPed"]) && isset($_POST["valorivaPed"]) && isset($_POST["idtipoproductoPed"]) 
    && isset($_POST["idproductoPed"])){
   //registro fecha ultimo login
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;
    $editarProducto = new AjaxProductoEditar();
    $editarProducto -> codigoPed = $_POST["codigoPed"];
    $editarProducto -> nombrePed = $_POST["nombrePed"];
    $editarProducto -> descripcionPed = $_POST["descripcionPed"];
    $editarProducto -> valorPed = $_POST["valorPed"];
    $editarProducto -> ivaPed = $_POST["ivaPed"];
    $editarProducto -> valorivaPed = $_POST["valorivaPed"];
    $editarProducto -> idtipoproductoPed = $_POST["idtipoproductoPed"];
    $editarProducto -> idproductoPed = $_POST["idproductoPed"];
    $editarProducto -> fechamodificacion = $fechaActual; 

    $editarProducto -> EditarProducto();
}
?>