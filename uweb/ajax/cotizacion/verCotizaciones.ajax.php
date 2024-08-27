<?php

require_once "../../modelo/cotizacion.modelo.php";
require_once "../../controlador/cotizacion.controlador.php";

class TablaCotizaciones{

    public function mostrarTablaCotizaciones(){
        $fechaInicial = $this->fechaInicial;
        $fechaFinal = $this->fechaFinal;
        $opcion = $this->opcion;
        $cotizaciones = ControladorCotizacion::ctrCotizacionConsultarVentas($fechaInicial,$fechaFinal,$opcion);
        if(count($cotizaciones)>0){
            echo'{
                "data": [';
                for($i=0; $i <count($cotizaciones)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$cotizaciones[$i]["idcotizacion"].'",
                        "'.$cotizaciones[$i]["cliente"].'",
                        "'.$cotizaciones[$i]["cedula"].'",
                        "'.$cotizaciones[$i]["vendedor"].'",
                        "'.$cotizaciones[$i]["formapago"].'",
                        "'.number_format($cotizaciones[$i]["totalcotizacion"], 0, ',', '.').'",
                        "'.$cotizaciones[$i]["fechainicial"].'",
                        "'.$cotizaciones[$i]["fechamovimiento"].'",
                        "'.$cotizaciones[$i]["estado"].'",
                        "'.$cotizaciones[$i]["idcliente"].'"
                    ],';
                }
                echo '[
                    "'.count($cotizaciones).'",
                    "'.$cotizaciones[count($cotizaciones)-1]["idcotizacion"].'",
                    "'.$cotizaciones[count($cotizaciones)-1]["cliente"].'",
                    "'.$cotizaciones[count($cotizaciones)-1]["cedula"].'",
                    "'.$cotizaciones[count($cotizaciones)-1]["vendedor"].'",
                    "'.$cotizaciones[count($cotizaciones)-1]["formapago"].'",
                    "'.number_format($cotizaciones[count($cotizaciones)-1]["totalcotizacion"], 0, ',', '.').'",
                    "'.$cotizaciones[count($cotizaciones)-1]["fechainicial"].'",
                    "'.$cotizaciones[count($cotizaciones)-1]["fechamovimiento"].'",
                    "'.$cotizaciones[count($cotizaciones)-1]["estado"].'",
                    "'.$cotizaciones[count($cotizaciones)-1]["idcliente"].'"
                    ]
               ]
            }';
        }else{
            echo'{"data": []}';
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