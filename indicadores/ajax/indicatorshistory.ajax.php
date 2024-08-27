<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class TableIndicatorHistory{

public function ViewIndHistory(){

    $indHistory = CompaniesController::ctrhistoryIndicators($this->idCompany);
    if(count($indHistory)>0){
        echo'{
            "data": [';
            for($i=0; $i <count($indHistory)-1; $i++){
                echo '[
                    "'.$indHistory[$i]["name"].'",
                    "'.$indHistory[$i]["score"].'"
                ],';
            }
            echo '[
                "'.$indHistory[count($indHistory)-1]["name"].'",
                "'.$indHistory[count($indHistory)-1]["score"].'"
                ]
           ]
        }';
    }else{
        echo'{"data": [[
            "No tiene indicadores asignados",
            "-"
            ]]}';
    }
}

}
if(isset($_POST["idCompany"])){

    $viewIndicatorHis = new TableIndicatorHistory();
    $viewIndicatorHis -> idCompany = $_POST["idCompany"];
    $viewIndicatorHis -> ViewIndHistory();
}

?>