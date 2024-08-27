<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class CompanyIndicators{

public function companyIndicatorsSel(){ 

    $companyInd = CompaniesController::ctrCompanyIndicators($this->idcompany);
    if(count($companyInd)>0){
        echo'{
            "data": [';
            for($i=0; $i <count($companyInd)-1; $i++){
                echo '[
                    "'.($i+1).'",
                    "'.$companyInd[$i]["name"].'",
                    "'.$companyInd[$i]["id"].'",
                    "'.$companyInd[$i]["id_equations"].'",
                    "'.$companyInd[$i]["description"].'",
                    "'.$companyInd[$i]["id_indicators"].'",
                    "'.$companyInd[$i]["id_company"].'"
                ],';
            }
            echo '[
                "'.count($companyInd).'",
                "'.$companyInd[count($companyInd)-1]["name"].'",
                "'.$companyInd[count($companyInd)-1]["id"].'",
                "'.$companyInd[count($companyInd)-1]["id_equations"].'",
                "'.$companyInd[count($companyInd)-1]["description"].'",
                "'.$companyInd[count($companyInd)-1]["id_indicators"].'",
                "'.$companyInd[count($companyInd)-1]["id_company"].'"
                ]
           ]
        }';
    }else{
        echo'{"data": [[
            "",
            "No tiene indicadores asignados"
            ]]}';
    }
}

}
if(isset($_POST["idcompany"])){
    $companySelect = new CompanyIndicators();
    $companySelect -> idcompany = $_POST["idcompany"];
    $companySelect -> companyIndicatorsSel();
}