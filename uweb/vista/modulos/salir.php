<?php
    $datos = array("idusuario" => $_SESSION["idUsuario"],
                   "tipomovimiento" => "usuario",
                   "estado_actual" => "Salió sistema",
                   "id" => $_SESSION["idUsuario"]);
    ControladorHistorial::ctrNuevoHistorial($datos);
    session_destroy();
    echo '<script> window.location="ingreso"; </script>';
?>