<?php
    //controladores
    require_once "controlador/plantilla.controlador.php";
    require_once "controlador/usuarios.controlador.php";
    require_once "controlador/historial.controlador.php";
    require_once "controlador/cliente.controlador.php";
    require_once "controlador/cotizacion.controlador.php";
    require_once "controlador/reportes.controlador.php";
    require_once "controlador/producto.controlador.php";

    //modelos
    require_once "modelo/usuarios.modelo.php";
    require_once "modelo/historial.modelo.php";
    require_once "modelo/historial.modelo.php";
    require_once "modelo/cliente.modelo.php";
    require_once "modelo/cotizacion.modelo.php";
    require_once "modelo/reportes.modelo.php";
    require_once "modelo/producto.modelo.php";

    $plantilla = new controladorPlantilla();
    $plantilla -> ctrPlantilla();
?>