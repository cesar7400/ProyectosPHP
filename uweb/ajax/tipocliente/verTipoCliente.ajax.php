<?php
require_once "../../controlador/tipoCliente.controlador.php";
require_once "../../modelo/tipoCliente.modelo.php";

class ajaxTipoClientes{

    public function verTipoClientes(){

        $item = null;
        $valor = null;
        $tipoclientes = controladorTipocliente::ctrMostrarTipoCliente($item, $valor);
        if(count($tipoclientes) > 0){

            echo'{
                "data": [';
                for($i=0; $i <count($tipoclientes)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$tipoclientes[$i]["tipocliente"].'",
                        "'.$tipoclientes[$i]["idtipocliente"].'"
                    ],';
                }
                echo '[
                    "'.count($tipoclientes).'",
                    "'.$tipoclientes[count($tipoclientes)-1]["tipocliente"].'",
                    "'.$tipoclientes[count($tipoclientes)-1]["idtipocliente"].'"
                    ]
               ]
       }';
        }else{
            echo'{"data": []}';
        }
    }

}

//ver tipo clientes
$tipoCliente = new ajaxTipoClientes();
$tipoCliente -> verTipoClientes();

?>