<?php
session_start();
require_once "../../controlador/cliente.controlador.php";
require_once "../../modelo/cliente.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxCliente{
    
    public function ajaxIngresarCliente(){
        $datos = array("nombres" => $this->nombres,
                       "apellidos" => $this->apellidos,
                       "cedula" => $this->cedula,
                       "nit" => $this->nit,
                       "email" => $this->email,
                       "idtipocliente" => $this->idtipocliente,
                       "telefono" => $this->telefono,
                       "celular" => $this->celular,
                       "ciudad" => $this->ciudad,
                       "direccion" => $this->direccion);
        $respuesta=ControladorCliente::ctrNuevoCliente($datos);
        echo json_encode($respuesta);
    }
}
//ingresar usuario
if(isset($_POST["nombresCliente"]) && isset($_POST["apellidosCliente"]) && isset($_POST["cedulaCliente"]) && 
   isset($_POST["nitCliente"]) && isset($_POST["emailCliente"]) && isset($_POST["idtipocliente"]) &&
   isset($_POST["telefonoCliente"]) && isset($_POST["celularCliente"]) && isset($_POST["ciudadCliente"]) &&
   isset($_POST["direccionCliente"])){

    $ingresarCliente = new AjaxCliente();
    $ingresarCliente -> nombres = $_POST["nombresCliente"];
    $ingresarCliente -> apellidos = $_POST["apellidosCliente"];
    $ingresarCliente -> cedula = $_POST["cedulaCliente"];
    $ingresarCliente -> nit = $_POST["nitCliente"];
    $ingresarCliente -> email = $_POST["emailCliente"];
    $ingresarCliente -> idtipocliente = $_POST["idtipocliente"];
    $ingresarCliente -> telefono = $_POST["telefonoCliente"];
    $ingresarCliente -> celular = $_POST["celularCliente"];
    $ingresarCliente -> ciudad = $_POST["ciudadCliente"];
    $ingresarCliente -> direccion = $_POST["direccionCliente"];
    $ingresarCliente -> ajaxIngresarCliente();
}

?>