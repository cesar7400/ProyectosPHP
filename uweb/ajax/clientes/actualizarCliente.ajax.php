<?php
session_start();
require_once "../../controlador/cliente.controlador.php";
require_once "../../modelo/cliente.modelo.php";
require_once "../../controlador/historial.controlador.php";
require_once "../../modelo/historial.modelo.php";

class AjaxCliente{

    public function ajaxEditarCliente(){
        $datos = array("idcliente" => $this->idClienteupd,
                       "nombres" => $this->editarNombresClie,
                       "apellidos" => $this->editarApellidosClie,
                       "cedula" => $this->editarCedulaClie,
                       "nit" => $this->editarNitClie,
                       "email" => $this->editarEmailClie,
                       "idtipocliente" => $this->EditarTipoCliente,
                       "telefono" => $this->editarTelefonoClie,
                       "celular" => $this->editarCelularClie,
                       "ciudad" => $this->editarCiudadClie,
                       "direccion" => $this->editarDireccionClie,
                       "fechamodificacion" => $this->fechamodificacion);
                       $respuesta=ControladorCliente::ctreditarClienteSel($datos);
                       echo json_encode($respuesta); 
    }
}
//actualizar usuario
if(isset($_POST["idClienteupd"]) && isset($_POST["editarNombresClie"]) && isset($_POST["editarApellidosClie"]) 
   && isset($_POST["editarCedulaClie"]) && isset($_POST["editarNitClie"]) && isset($_POST["editarEmailClie"]) 
   && isset($_POST["EditarTipoCliente"]) && isset($_POST["editarTelefonoClie"]) && isset($_POST["editarCelularClie"]) 
   && isset($_POST["editarCiudadClie"]) && isset($_POST["editarDireccionClie"])){
   //registro fecha ultimo login
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;
    $editarCliente = new AjaxCliente();
    $editarCliente -> idClienteupd = $_POST["idClienteupd"];
    $editarCliente -> editarNombresClie = $_POST["editarNombresClie"];
    $editarCliente -> editarApellidosClie = $_POST["editarApellidosClie"];
    $editarCliente -> editarCedulaClie = $_POST["editarCedulaClie"];
    $editarCliente -> editarNitClie = $_POST["editarNitClie"];
    $editarCliente -> editarEmailClie = $_POST["editarEmailClie"];
    $editarCliente -> EditarTipoCliente = $_POST["EditarTipoCliente"];
    $editarCliente -> editarTelefonoClie = $_POST["editarTelefonoClie"];
    $editarCliente -> editarCelularClie = $_POST["editarCelularClie"]; 
    $editarCliente -> editarCiudadClie = $_POST["editarCiudadClie"];
    $editarCliente -> editarDireccionClie = $_POST["editarDireccionClie"]; 
    $editarCliente -> fechamodificacion = $fechaActual; 

    $editarCliente -> ajaxEditarCliente();
}
?>