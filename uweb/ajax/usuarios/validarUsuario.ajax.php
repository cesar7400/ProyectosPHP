<?php
    require_once "../../controlador/usuarios.controlador.php";
    require_once "../../modelo/usuarios.modelo.php";

    class AjaxUsuarioValidar{

        public $val,$item;
        public function ajaxVerUsuario(){
            $item = $this->item;
            $valor = $this->val;
            $respuesta = ControladorUsuario::ctrVerUsuarios($item,$valor);
            echo json_encode($respuesta);
        }
    }
    
    //validar usuario email
    if(isset($_POST["email"])){
        $validar = new AjaxUsuarioValidar();
        $validar -> item = "email";
        $validar -> val = $_POST["email"];
        $validar -> ajaxVerUsuario();
    }
    //validar email usuario
    if(isset($_POST["usuario"])){
        $validar = new AjaxUsuarioValidar();
        $validar -> item = "usuario";
        $validar -> val = $_POST["usuario"];
        $validar -> ajaxVerUsuario();
    }
?>