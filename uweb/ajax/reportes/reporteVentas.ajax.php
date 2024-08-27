<?php

require_once "../../modelo/reportes.modelo.php";
require_once "../../controlador/reportes.controlador.php";

class TablaCotizaciones{

    public function mostrarTablaCotizaciones(){
        $fechaInicial = $this->fechaInicial;
        $fechaFinal = $this->fechaFinal;
        $opcion = $this->opcion;
        $cotizaciones = ControladorReportes::CtrCotizacionReporteVentas($fechaInicial,$fechaFinal,$opcion);
        if(count($cotizaciones)>0){
            error_reporting(0);
            $fechas = array();
            $ventas = array();
            $sumaMes = array();
            foreach($cotizaciones as $key => $value){
                //se obtiene fecha, año
                $fecha = substr($value["fechamovimiento"],0,7);
                //agregar fechas array
                array_push($fechas, $fecha);
                //obtiene las ventas
                $ventas = array($fecha => $value['totalcotizacion']);

                foreach($ventas as $key => $value){
                    $sumaMes[$key] += $value;
                }
            }
            echo json_encode($sumaMes);
        }
    }
}

if(isset($_POST["fechaInicial"]) && isset($_POST["fechaFinal"]) && isset($_POST["opcion"])){

    $activar = new TablaCotizaciones();
    $activar -> fechaInicial = $_POST["fechaInicial"];
    $activar -> fechaFinal = $_POST["fechaFinal"];
    $activar -> opcion =$_POST["opcion"];
    $activar -> mostrarTablaCotizaciones();
}else{
    $activar = new TablaCotizaciones();
    $activar -> fechaInicial = "";
    $activar -> fechaFinal = "";
    $activar -> opcion = "";
    $activar -> mostrarTablaCotizaciones();
}
?>