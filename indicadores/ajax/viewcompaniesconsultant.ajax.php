<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class TableConsultantsCompanies{

public function ViewconsultantsCompanies(){

    $companiesConslt = CompaniesController::ctrcompanyConsultan();
    if(count($companiesConslt)>0){
        echo'{
            "data": [';
            for($i=0; $i <count($companiesConslt)-1; $i++){
                echo '[
                    "'.($i+1).'",
                    "'.$companiesConslt[$i]["name"].'",
                    "'.$companiesConslt[$i]["nit"].'",
                    "'.$companiesConslt[$i]["NAMES"].'",
                    "'.$companiesConslt[$i]["id"].'"
                ],';
            }
            echo '[
                "'.count($companiesConslt).'",
                "'.$companiesConslt[count($companiesConslt)-1]["name"].'",
                "'.$companiesConslt[count($companiesConslt)-1]["nit"].'",
                "'.$companiesConslt[count($companiesConslt)-1]["NAMES"].'",
                "'.$companiesConslt[count($companiesConslt)-1]["id"].'"
                ]
           ]
        }';
    }else{
        echo'{"data": []}';
    }
}

}

$activated = new TableConsultantsCompanies();
$activated -> ViewconsultantsCompanies();
?>