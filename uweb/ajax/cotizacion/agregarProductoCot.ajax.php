<?php
session_start();
require_once "../../controlador/cotizacion.controlador.php";
require_once "../../modelo/cotizacion.modelo.php";

class AjaxProductoCot{

    public $opcion;
    public function IngresarProductoCot(){
        $valor = $this->opcion;
        $datos = array("idcotizacion" => $this->IdCotizacion,
                       "idproducto" => $this->idProcot,
                       "detalle" => $this->detalleProdCot,
                       "cantidad" => $this->cantidadProdCot,
                       "valorunitario" => $this->valorProCot,
                       "total" => $this->valorProCot);
        $respuesta=ControladorCotizacion::ctrCotizacionProdctoVer($datos,$valor);
        if($respuesta != ""){
            echo json_encode($respuesta);
        }else{
            $respuesta=ControladorCotizacion::ctrNuevoCotizacionDetalle($datos);
            echo json_encode($respuesta);
        }
    }
}
//ingresar producto
if(isset($_POST["IdCotizacion"]) && isset($_POST["idProcot"]) && isset($_POST["detalleProdCot"])
   && isset($_POST["cantidadProdCot"]) && isset($_POST["valorProCot"]) && isset($_POST["opcion"])){

    $ingresarCot = new AjaxProductoCot();
    $ingresarCot -> IdCotizacion = $_POST["IdCotizacion"];
    $ingresarCot -> idProcot = $_POST["idProcot"];
    $ingresarCot -> detalleProdCot = $_POST["detalleProdCot"]; 
    $ingresarCot -> cantidadProdCot = $_POST["cantidadProdCot"]; 
    $ingresarCot -> valorProCot = $_POST["valorProCot"]; 
    $ingresarCot -> opcion = $_POST["opcion"]; 
    $ingresarCot -> IngresarProductoCot();
}

?>