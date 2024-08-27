<?php
require_once "../../controlador/usuarios.controlador.php";
require_once "../../modelo/usuarios.modelo.php";

class AjaxUsuarios{

    public $idVerUsuarioSel;
    public function ajaxVerUsuario(){
        $item = "idusuario";
        $valor = $this->idVerUsuarioSel;
        $respuesta = ControladorUsuario::ctrVerUsuarios($item,$valor);
        echo json_encode($respuesta);
    }
}

//ver usuario
if(isset($_POST["idVerUsuarioSel"])){
    $ver = new AjaxUsuarios();
    $ver -> idVerUsuarioSel = $_POST["idVerUsuarioSel"];
    $ver -> ajaxVerUsuario();
}

?>