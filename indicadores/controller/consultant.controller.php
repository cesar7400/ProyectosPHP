<?php

class ConsultantController{

    //ver consultores
    static public function CTRconsultant(){
        $rpta = ConsultantModel::MDLconsultant();
        return $rpta;
    }
}

?>