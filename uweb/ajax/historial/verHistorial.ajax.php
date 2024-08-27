<?php

require_once "../../modelo/historial.modelo.php";
require_once "../../controlador/historial.controlador.php";

class TablaHistorial{

    public function mostrarTablaHistorial(){

        $historial = ControladorHistorial::ctrVerHistorial();
        if(count($historial)>0){
            echo'{
                "data": [';
                for($i=0; $i <count($historial)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$historial[$i]["Usuario"].'",
                        "'.$historial[$i]["tipo_movimiento"].'",
                        "'.$historial[$i]["Usuario_movimiento"].'",
                        "'.$historial[$i]["fecha"].'"
                    ],';
                }
                echo '[
                    "'.count($historial).'",
                    "'.$historial[count($historial)-1]["Usuario"].'",
                    "'.$historial[count($historial)-1]["tipo_movimiento"].'",
                    "'.$historial[count($historial)-1]["Usuario_movimiento"].'",
                    "'.$historial[count($historial)-1]["fecha"].'"
                    ]
               ]
            }';
        }else{
            echo'{"data": []}';
        }
    }
}

//activa tabla productos
$activar = new TablaHistorial();
$activar -> mostrarTablaHistorial();
?>