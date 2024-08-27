<?php
require_once "connection.php";

class ConsultantModel{
    //ver consultores
    static public function MDLconsultant(){
        if(Connection::connecting() !="connectionError"){
            $stmt = Connection::connecting()->prepare("SELECT mdl_user.id, mdl_user.firstname, mdl_user.lastname, mdl_user.email FROM mdl_role
                                                       INNER JOIN mdl_role_assignments ON mdl_role.id=mdl_role_assignments.roleid
                                                       INNER JOIN mdl_user ON mdl_user.id=mdl_role_assignments.userid
                                                       WHERE mdl_role.name='consultant'");
            if($stmt == false){
                return"errorSql";
            }else{
                $stmt -> execute();
                return $stmt -> fetchAll();
            }
            $stmt -> close();
            $stmt = null;
        }else{
            return "connectionError";
        }
    }
}
?>