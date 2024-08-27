<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class TableCompanies{

public function Viewcompanies(){

    $companies = CompaniesController::CTRcompanies($this->option, $this->data);
    if(count($companies)>0){
        echo'{
            "data": [';
            for($i=0; $i <count($companies)-1; $i++){
                echo '[
                    "'.($i+1).'",
                    "'.$companies[$i]["name"].'",
                    "'.$companies[$i]["nit"].'",
                    "'.$companies[$i]["telephone"].'",
                    "'.$companies[$i]["id"].'"
                ],';
            }
            echo '[
                "'.count($companies).'",
                "'.$companies[count($companies)-1]["name"].'",
                "'.$companies[count($companies)-1]["nit"].'",
                "'.$companies[count($companies)-1]["telephone"].'",
                "'.$companies[count($companies)-1]["id"].'"
                ]
           ]
        }';
    }else{
        echo'{"data": []}';
    }
}

}
if(isset($_POST['option']) && isset($_POST['data'])){
    $activatedCom = new TableCompanies();
    $activatedCom -> option = $_POST["option"];
    $activatedCom -> data = $_POST["data"];
    $activatedCom -> Viewcompanies();
}
?>