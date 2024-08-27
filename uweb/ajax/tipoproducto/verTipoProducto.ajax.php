<?php
require_once "../../controlador/tipoProducto.controlador.php";
require_once "../../modelo/tipoProducto.modelo.php";

class ajaxTipoProducto{

    public function verTipoProducto(){

        $item = null;
        $valor = null;
        $tipoProductos = controladorTipoProducto::ctrMostrarTipoProducto($item, $valor);
        if(count($tipoProductos) > 0){

            echo'{
                "data": [';
                for($i=0; $i <count($tipoProductos)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$tipoProductos[$i]["tipoproducto"].'",
                        "'.$tipoProductos[$i]["idtipoproducto"].'"
                    ],';
                }
                echo '[
                    "'.count($tipoProductos).'",
                    "'.$tipoProductos[count($tipoProductos)-1]["tipoproducto"].'",
                    "'.$tipoProductos[count($tipoProductos)-1]["idtipoproducto"].'"
                    ]
               ]
       }';
        }else{
            echo'{"data": []}';
        }
    }

}

//ver tipo productos
$tipoProducto = new ajaxTipoProducto();
$tipoProducto -> verTipoProducto();
?>