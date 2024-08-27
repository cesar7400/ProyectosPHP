<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class addScoreInd{

    public function addScoreIndicator(){
        $data = array("score" => $this->score,
                       "date" => $this->fechaActual,
                       "id_company" => $this->id_company,
                       "id_indicators" => $this->id_indicators);
                       $rpta=CompaniesController::ctrAddScoreCompany($data);
                       echo json_encode($rpta); 
    }
}
//ingreso calificacion empresa
if(isset($_POST["score"]) && isset($_POST["id_company"]) && isset($_POST["id_indicators"])){
    //fecha  actual
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;
    $addScoreIndicator = new addScoreInd();
    $addScoreIndicator -> score = $_POST["score"];
    $addScoreIndicator -> id_company = $_POST["id_company"];
    $addScoreIndicator -> id_indicators = $_POST["id_indicators"];
    $addScoreIndicator -> fechaActual = $fechaActual; 
    $addScoreIndicator -> addScoreIndicator();
}
?>