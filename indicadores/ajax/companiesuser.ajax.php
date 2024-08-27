<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class TableCompaniesUser{

public function ViewCompaniesUser(){

    $consultants = CompaniesController::ctrViewcompaniesConsultant($this->id_user);
    if(count($consultants)>0){
        echo'{
            "data": [';
            for($i=0; $i <count($consultants)-1; $i++){
                echo '[
                    "'.$consultants[$i]["name"].'",
                    "'.$consultants[$i]["nit"].'",
                    "'.$consultants[$i]["telephone"].'"
                ],';
            }
            echo '[
                "'.$consultants[count($consultants)-1]["name"].'",
                "'.$consultants[count($consultants)-1]["nit"].'",
                "'.$consultants[count($consultants)-1]["telephone"].'"
                ]
           ]
        }';
    }else{
        echo'{"data": []}';
    }
}

}
if(isset($_POST["id_user"])){

    $viewComUser = new TableCompaniesUser();
    $viewComUser -> id_user = $_POST["id_user"];
    $viewComUser -> ViewCompaniesUser();
}

?>