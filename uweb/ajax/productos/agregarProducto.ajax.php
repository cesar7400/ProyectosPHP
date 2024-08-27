<?php
session_start();
require_once "../../controlador/producto.controlador.php";
require_once "../../modelo/producto.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxProducto{
    
    public function IngresarProducto(){
        $datos = array("codigo" => $this->codigoP,
                       "nombre" => $this->nombreP,
                       "descripcion" => $this->descripcionP,
                       "valor" => $this->valorP,
                       "iva" => $this->ivaP,
                       "valoriva" => $this->valorivaP,
                       "idtipoproducto" => $this->idtipoproductoP);
        $respuesta=ControladorProducto::ctrNuevoProducto($datos);
        echo json_encode($respuesta);
    }
}
//ingresar producto
if(isset($_POST["codigoP"]) && isset($_POST["nombreP"]) && isset($_POST["descripcionP"]) && isset($_POST["valorP"]) && 
   isset($_POST["ivaP"]) && isset($_POST["valorivaP"]) && isset($_POST["idtipoproductoP"])){

    $ingresarProducto = new AjaxProducto();
    $ingresarProducto -> codigoP = $_POST["codigoP"];
    $ingresarProducto -> nombreP = $_POST["nombreP"];
    $ingresarProducto -> descripcionP = $_POST["descripcionP"];
    $ingresarProducto -> valorP = $_POST["valorP"];
    $ingresarProducto -> ivaP = $_POST["ivaP"];
    $ingresarProducto -> valorivaP = $_POST["valorivaP"];
    $ingresarProducto -> idtipoproductoP = $_POST["idtipoproductoP"];
    $ingresarProducto -> IngresarProducto();
}

?>