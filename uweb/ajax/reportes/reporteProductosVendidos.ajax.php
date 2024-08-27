<?php
require_once "../../modelo/reportes.modelo.php";
require_once "../../controlador/reportes.controlador.php";

class reporteProductos{

    public function productoReporte(){
        $reportesPr = ControladorReportes::CtrCotizacionReporteProductos();
        echo json_encode($reportesPr);
    }
}
if(isset($_POST["reporteProducto"])){
    $activarP = new reporteProductos();
    $activarP -> productoReporte();
}
?>