<?php
require_once "connection.php";
class UsersModel{
    //ver empresas
    static public function MDLUsers($data){
        if(Connection::connecting() !="connectionError"){
            $stmt = Connection::connecting()->prepare("SELECT mdl_role.shortname, mdl_user.id_company FROM mdl_role
                                                       INNER JOIN mdl_role_assignments ON mdl_role.id=mdl_role_assignments.roleid
                                                       INNER JOIN mdl_user ON mdl_user.id=mdl_role_assignments.userid
                                                       WHERE mdl_role_assignments.userid = :userid");
            $stmt -> bindParam(":userid", $data, PDO::PARAM_INT);
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