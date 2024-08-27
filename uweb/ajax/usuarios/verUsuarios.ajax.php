<?php

require_once "../../modelo/usuarios.modelo.php";
require_once "../../controlador/usuarios.controlador.php";

class TablaUsuarios{

    public function mostrarTablaUsuarios(){

        $item = null;
        $valor = null;
        $usuarios = ControladorUsuario::ctrVerUsuarios($item, $valor);
        if(count($usuarios)>0){
            echo'{
                "data": [';
                for($i=0; $i <count($usuarios)-1; $i++){
                    echo '[
                        "'.($i+1).'",
                        "'.$usuarios[$i]["nombres"].'",
                        "'.$usuarios[$i]["apellidos"].'",
                        "'.$usuarios[$i]["email"].'",
                        "'.$usuarios[$i]["usuario"].'",
                        "'.$usuarios[$i]["fechaingreso"].'",
                        "'.$usuarios[$i]["fechamodificacion"].'",
                        "'.$usuarios[$i]["imagen"].'",
                        "'.$usuarios[$i]["estado"].'",
                        "'.$usuarios[$i]["ultimo_login"].'",
                        "'.$usuarios[$i]["idusuario"].'"
                    ],';
                }
                echo '[
                    "'.count($usuarios).'",
                    "'.$usuarios[count($usuarios)-1]["nombres"].'",
                    "'.$usuarios[count($usuarios)-1]["apellidos"].'",
                    "'.$usuarios[count($usuarios)-1]["email"].'",
                    "'.$usuarios[count($usuarios)-1]["usuario"].'",
                    "'.$usuarios[count($usuarios)-1]["fechaingreso"].'",
                    "'.$usuarios[count($usuarios)-1]["fechamodificacion"].'",
                    "'.$usuarios[count($usuarios)-1]["imagen"].'",
                    "'.$usuarios[count($usuarios)-1]["estado"].'",
                    "'.$usuarios[count($usuarios)-1]["ultimo_login"].'",
                    "'.$usuarios[count($usuarios)-1]["idusuario"].'"
                    ]
               ]
            }';
        }else{
            echo'{"data": []}';
        }
    }
    
}

//activa tabla productos
$activar = new TablaUsuarios();
$activar -> mostrarTablaUsuarios();
?>