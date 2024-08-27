<?php
require_once "../controller/consultant.controller.php";
require_once "../model/consultant.model.php";

class TableConsultants{

public function Viewconsultants(){

    $consultants = ConsultantController::CTRconsultant();
    if(count($consultants)>0){
        echo'{
            "data": [';
            for($i=0; $i <count($consultants)-1; $i++){
                echo '[
                    "'.($i+1).'",
                    "'.$consultants[$i]["firstname"].'",
                    "'.$consultants[$i]["lastname"].'",
                    "'.$consultants[$i]["email"].'",
                    "'.$consultants[$i]["id"].'"
                ],';
            }
            echo '[
                "'.count($consultants).'",
                "'.$consultants[count($consultants)-1]["firstname"].'",
                "'.$consultants[count($consultants)-1]["lastname"].'",
                "'.$consultants[count($consultants)-1]["email"].'",
                "'.$consultants[count($consultants)-1]["id"].'"
                ]
           ]
        }';
    }else{
        echo'{"data": []}';
    }
}

}

$activated = new TableConsultants();
$activated -> Viewconsultants();
?>