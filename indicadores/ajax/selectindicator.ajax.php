<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class SelectIndicator{
    
    public $val;
    public function SelectIndicatorCompany(){
        if($this->idEquation != ""){
            $val = "indicator";
        }else{
            $val = "subindicator";
        }
        $rpta=CompaniesController::ctrSelectIndicator($this->idIndicator, $val);
        echo json_encode($rpta);
    }
}
//ingreso usuario por id y empresas por id
if(isset($_POST["idIndicator"])){

    $selectInd = new SelectIndicator();
    $selectInd -> idIndicator = $_POST["idIndicator"];
    $selectInd -> idEquation = $_POST["idEquation"];
    $selectInd -> SelectIndicatorCompany();
}

?>