<?php

require_once "../../modelo/producto.modelo.php";
require_once "../../controlador/producto.controlador.php";

class TablaProductos{

    public function mostrarTablaProductos(){

        $item = null;
        $valor = null;
        $productos = ControladorProducto::ctrVerProductos($item, $valor);
        if(count($productos)>0){
            echo'{
                "data": [';
                for($i=0; $i <count($productos)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$productos[$i]["codigo"].'",
                        "'.$productos[$i]["nombre"].'",
                        "'.$productos[$i]["descripcion"].'",
                        "'.$productos[$i]["valor"].'",
                        "'.(($productos[$i]["iva"] == "1")?"si":"no").'",
                        "'.$productos[$i]["valoriva"].'",
                        "'.$productos[$i]["tipoproducto"].'",
                        "'.$productos[$i]["fechaingreso"].'",
                        "'.$productos[$i]["fechamodificacion"].'",
                        "'.$productos[$i]["idproducto"].'"
                    ],';
                }
                echo '[
                    "'.count($productos).'",
                    "'.$productos[count($productos)-1]["codigo"].'",
                    "'.$productos[count($productos)-1]["nombre"].'",
                    "'.$productos[count($productos)-1]["descripcion"].'",
                    "'.$productos[count($productos)-1]["valor"].'",
                    "'.(($productos[$i]["iva"] == "1")? "si":"no").'",
                    "'.$productos[count($productos)-1]["valoriva"].'",
                    "'.$productos[count($productos)-1]["tipoproducto"].'",
                    "'.$productos[count($productos)-1]["fechaingreso"].'",
                    "'.$productos[count($productos)-1]["fechamodificacion"].'",
                    "'.$productos[count($productos)-1]["idproducto"].'"
                    ]
               ]
            }';
        }else{
            echo'{"data": []}';
        }
    }
    
}

//activa tabla productos
$activar = new TablaProductos();
$activar -> mostrarTablaProductos();
?>