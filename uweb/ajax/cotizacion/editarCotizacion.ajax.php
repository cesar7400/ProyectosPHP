<?php
session_start();

class AjaxEditarCot{
    
    public function editarCot(){
        $datos = array("idCotizacionCot" => $this->idCotizacionCot,
                       "idClienteCot" => $this->idClienteCot);
        $_SESSION['idCotizacionCot'] = $this->idCotizacionCot;
        $_SESSION['idClienteCot'] = $this->idClienteCot;
        echo json_encode($datos);
    }
}
//editar cotizacion 
if(isset($_POST["idCotizacionCot"]) && isset($_POST["idClienteCot"])){

    $editarCot = new AjaxEditarCot();
    $editarCot -> idCotizacionCot = $_POST["idCotizacionCot"];
    $editarCot -> idClienteCot = $_POST["idClienteCot"];
    $editarCot -> editarCot();
}

?>