<?php

class UsersController{

    //ver consultores
    static public function CTRUsers($data){
        $rpta = UsersModel::MDLUsers($data);
        return $rpta;
    }
}

?>