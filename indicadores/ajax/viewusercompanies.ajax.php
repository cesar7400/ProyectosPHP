<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class SelectCompanies{

public function companiesSelect(){

    $companiesUser = CompaniesController::ctrselectCompConsl($this->id_user);
    if(count($companiesUser)>0){
        echo'{
            "data": [';
            for($i=0; $i <count($companiesUser)-1; $i++){
                echo '[
                    "'.$companiesUser[$i]["id_companies"].'",
                    "'.$companiesUser[$i]["id_user"].'"
                ],';
            }
            echo '[
                "'.$companiesUser[count($companiesUser)-1]["id_companies"].'",
                "'.$companiesUser[count($companiesUser)-1]["id_user"].'"
                ]
           ]
        }';
    }else{
        echo'{"data": []}';
    }
}

}
if(isset($_POST["id_user"])){
    $viewCompaniesUser = new SelectCompanies();
    $viewCompaniesUser -> id_user = $_POST["id_user"];
    $viewCompaniesUser -> companiesSelect();
}

?>