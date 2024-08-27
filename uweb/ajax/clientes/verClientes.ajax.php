<?php

require_once "../../modelo/cliente.modelo.php";
require_once "../../controlador/cliente.controlador.php";

class TablaUsuarios{

    public function mostrarTablaClientes(){

        $item = null;
        $valor = null;
        $clientes = ControladorCliente::ctrVerClientes($item, $valor);
        if(count($clientes)>0){
            echo'{
                "data": [';
                for($i=0; $i <count($clientes)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$clientes[$i]["nombres"].'",
                        "'.$clientes[$i]["apellidos"].'",
                        "'.$clientes[$i]["cedula"].'",
                        "'.$clientes[$i]["nit"].'",
                        "'.$clientes[$i]["email"].'",
                        "'.$clientes[$i]["tipocliente"].'",
                        "'.$clientes[$i]["telefono"].'",
                        "'.$clientes[$i]["celular"].'",
                        "'.$clientes[$i]["ciudad"].'",
                        "'.$clientes[$i]["direccion"].'",
                        "'.$clientes[$i]["idcliente"].'"
                    ],';
                }
                echo '[
                    "'.count($clientes).'",
                    "'.$clientes[count($clientes)-1]["nombres"].'",
                    "'.$clientes[count($clientes)-1]["apellidos"].'",
                    "'.$clientes[count($clientes)-1]["cedula"].'",
                    "'.$clientes[count($clientes)-1]["nit"].'",
                    "'.$clientes[count($clientes)-1]["email"].'",
                    "'.$clientes[count($clientes)-1]["tipocliente"].'",
                    "'.$clientes[count($clientes)-1]["telefono"].'",
                    "'.$clientes[count($clientes)-1]["celular"].'",
                    "'.$clientes[count($clientes)-1]["ciudad"].'",
                    "'.$clientes[count($clientes)-1]["direccion"].'",
                    "'.$clientes[count($clientes)-1]["idcliente"].'"
                    ]
               ]
            }';
        }else{
            echo'{"data": []}';
        }
    }
    
}

//activa tabla clientes
$activar = new TablaUsuarios();
$activar -> mostrarTablaClientes();
?>