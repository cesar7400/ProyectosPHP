<?php
    class ControladorReportes{

        //consular reporte ventas cotizacion
        static public function CtrCotizacionReporteVentas($fechaInicio,$fechaFin,$opcion){
            $respuesta = ModeloReportes::MdlCotizacionReporteVentas($fechaInicio,$fechaFin,$opcion);
            return $respuesta;
        }
        //consular reporte ventas cotizacion
        static public function CtrCotizacionReporteProductos(){
            $respuesta = ModeloReportes::MdlCotizacionReporteProductos();
            return $respuesta;
        }
        //reporte excel
        static public function CtrreorteExcel($fechaInicial,$fechaFinal,$opcion){
            $reporteExcel = ModeloReportes::MdlCotizacionReporteVentasExcel($fechaInicial,$fechaFinal,$opcion);
            return $reporteExcel;
        }
        //reporte productos excel 
        static public function CtrCotizacionReporteVentasExcelProductods($idcotizacion){
            $reporteExcel = ModeloReportes::MdlCotizacionReporteVentasExcelProductods($idcotizacion);
            return $reporteExcel;
        }
        //reporte productos excel 
        static public function CtrcantidadReportes(){
            $tabla="cotizacion";
            $cant = ModeloReportes::MdlcantidadReportes($tabla);
            return $cant;
        }
    }
?>