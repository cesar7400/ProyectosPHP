<?php
require_once "connection.php";

class CompaniesModel{
    //ver empresas
    static public function MDLcompanies($option,$data){
        $sql = "";
        if($option == "admin"){
            $sql = "SELECT * FROM mdl_ind_companies";
        }
        if($option == "consultant"){
            $sql = "SELECT mdl_ind_companies.name, mdl_ind_companies.nit, mdl_ind_companies.telephone, mdl_ind_companies.id FROM mdl_ind_companies
                    INNER JOIN mdl_ind_user_companies ON mdl_ind_companies.id = mdl_ind_user_companies.id_companies
                    INNER JOIN mdl_user ON mdl_ind_user_companies.id_user = mdl_user.id
                    WHERE mdl_user.id = :id";
        }
        if(Connection::connecting() !="connectionError"){
            $stmt = Connection::connecting()->prepare($sql);
            if($stmt == false){
                return"errorSql";
            }else{
                if($option == "consultant"){
                    $stmt -> bindParam(":id", $data, PDO::PARAM_INT);
                }
                $stmt -> execute();
                return $stmt -> fetchAll();
            }
            $stmt -> close();
            $stmt = null;
        }else{
            return "connectionError";
        }
    }
    //nuevo consultor - empresa
    static public function MdlnewUserCompany($table,$data){
        $db = Connection::connecting();
        if($db !="connectionError"){
            $stmt = $db->prepare("INSERT INTO $table(id_user, id_companies) VALUES (:id_user, :id_companies)");
            if($stmt == false){
                return"addError";
            }else{
                $stmt -> bindParam(":id_user",$data["id_user"], PDO::PARAM_INT);
                $stmt -> bindParam(":id_companies",$data["id_companies"], PDO::PARAM_INT);
                if($stmt->execute()){
                    return $_SESSION['insertID'] = $db -> lastInsertId();
                }else{
                    return "addError";
                }
                $stmt -> close();
                $stmt = null;
            }
        }else{
            return "connectionError";
        }
    }
    //eliminar consultor - empresa
    static public function MdldeleteUserCompany($table,$data){
        if(Connection::connecting()!="connectionError"){
            $stmt = Connection::connecting()->prepare("DELETE FROM $table WHERE id_user = :id_user AND id_companies = :id_companies");
            if($stmt == false){
                return "errorDelete";
            }else{
                $stmt -> bindParam(":id_user", $data["id_user"], PDO::PARAM_INT);
                $stmt -> bindParam(":id_companies", $data["id_companies"], PDO::PARAM_INT);
                if($stmt->execute()){
                    return "ok";
                }else{
                    return "errorDelete";
                }
                $stmt -> close();
                $stmt = null;
            }
        }else{
            return "connectionError";
        }
    }

    //empresas seleccionadas por consultor
    static public function MDLselectCompConsl($data){
        if(Connection::connecting() !="connectionError"){
            $stmt = Connection::connecting()->prepare("SELECT mdl_ind_user_companies.id_companies, mdl_ind_user_companies.id_user
                                                       FROM mdl_ind_companies
                                                       LEFT JOIN mdl_ind_user_companies ON mdl_ind_companies.id = mdl_ind_user_companies.id_companies");
            //$stmt -> bindParam(":id_user", $data, PDO::PARAM_INT);
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
    //ver empresas asignadas por consultor
    static public function MDLViewcompaniesConsultant($data){
        if(Connection::connecting() !="connectionError"){
            $stmt = Connection::connecting()->prepare("SELECT mdl_ind_companies.name, mdl_ind_companies.nit, mdl_ind_companies.telephone FROM mdl_ind_companies
                                                       INNER JOIN mdl_ind_user_companies ON mdl_ind_companies.id = mdl_ind_user_companies.id_companies
                                                       INNER JOIN mdl_user ON mdl_ind_user_companies.id_user = mdl_user.id
                                                       WHERE mdl_user.id = :id");
            $stmt -> bindParam(":id", $data, PDO::PARAM_INT);
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

    //vista nombre indicadores empresa
    static public function MDLCompanyIndicators($data){
        if(Connection::connecting() !="connectionError"){

            $stmt = Connection::connecting()->prepare("SELECT mdl_ind_indicators.name, mdl_ind_indicators.id, mdl_ind_indicators.id_equations,mdl_ind_indicators.description, mdl_ind_company_indicators.id_indicators, mdl_ind_company_indicators.id_company FROM mdl_ind_indicators
                                                       INNER JOIN mdl_ind_company_indicators ON mdl_ind_indicators.id = mdl_ind_company_indicators.id_indicators
                                                       WHERE mdl_ind_company_indicators.id_company = :id_company");
            $stmt -> bindParam(":id_company", $data, PDO::PARAM_INT);
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

    //indicador seleccionado
    static public function MDLSelectIndicator($data,$option){
        if(Connection::connecting() !="connectionError"){//mdl_ind_equations.description, mdl_ind_operations.symbol, mdl_ind_variables.name_variable
            $sql = "";
            if($option == "indicator"){
                $sql = "SELECT mdl_ind_indicators.name, mdl_ind_indicators.description, mdl_ind_operations.id,mdl_ind_variables.name_variable FROM mdl_ind_indicators
                        INNER JOIN mdl_ind_equations ON mdl_ind_indicators.id_equations = mdl_ind_equations.id
                        INNER JOIN mdl_ind_equation_variables ON mdl_ind_equations.id = mdl_ind_equation_variables.id_equation
                        INNER JOIN mdl_ind_variables ON mdl_ind_equation_variables.id_variable = mdl_ind_variables.id
                        INNER JOIN mdl_ind_operations ON mdl_ind_equation_variables.id_operation = mdl_ind_operations.id
                        WHERE mdl_ind_indicators.id = :id";
            }
            if($option == "subindicator"){ //no disponible por el momento!!!!
                $sql = "SELECT mdl_ind_equations.description, mdl_ind_operations.symbol FROM mdl_ind_subindicators
                        INNER JOIN mdl_ind_equations ON mdl_ind_subindicators.id_equations = mdl_ind_equations.id
                        INNER JOIN mdl_ind_equation_variables ON mdl_ind_equations.id = mdl_ind_equation_variables.id_equation
                        INNER JOIN mdl_ind_operations ON mdl_ind_equation_variables.id_operation = mdl_ind_operations.id
                        WHERE mdl_ind_subindicators.id_indicators = :id";
            }
            $stmt = Connection::connecting()->prepare($sql);
            $stmt -> bindParam(":id", $data, PDO::PARAM_INT);
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
    //ingreso calificacion empresa por indicador 
    static public function MdlAddScoreCompany($data){
        if(Connection::connecting() !="connectionError"){
            //$stmt = Connection::connecting()->prepare("UPDATE mdl_ind_company_indicators SET score = :score, date = :date  WHERE id_company = :id_company AND id_indicators = :id_indicators");
            $stmt = Connection::connecting()->prepare("INSERT INTO mdl_ind_score(id_company_indicators, id_comapny, date, score) VALUES((SELECT id FROM mdl_ind_company_indicators where id_company=:id_company AND id_indicators=:id_indicators),:id_company,:date,:score)");
            if($stmt == false){
                return "addError";
            }else{
                $stmt -> bindParam(":score",$data["score"], PDO::PARAM_STR);
                $stmt -> bindParam(":date",$data["date"], PDO::PARAM_STR);
                $stmt -> bindParam(":id_company",$data["id_company"], PDO::PARAM_STR);
                $stmt -> bindParam(":id_indicators",$data["id_indicators"], PDO::PARAM_STR);
                if($stmt->execute()){
                    return "ok";
                }else{
                    return "addError";
                }
                $stmt -> close();
                $stmt = null;
            }
        }else{
            return "connectionError";
        }
    }

    //historico indicadores empresa
    static public function MDLhistoryIndicators($data){
        if(Connection::connecting() !="connectionError"){

            $stmt = Connection::connecting()->prepare("SELECT mdl_ind_indicators.name, IF(mdl_ind_equations.unity_measure='%',CONCAT(ROUND(mdl_ind_score.score * 100),'%'), mdl_ind_score.score)as score 
                                                        from mdl_ind_companies
                                                        INNER JOIN mdl_ind_company_indicators t1 on mdl_ind_companies.id = t1.id_company
                                                        INNER JOIN mdl_ind_indicators ON t1.id_indicators = mdl_ind_indicators.id
                                                        INNER JOIN mdl_ind_type_indicators ON mdl_ind_indicators.id_type_indicators = mdl_ind_type_indicators.id
                                                        INNER JOIN mdl_ind_equations ON mdl_ind_indicators.id_equations = mdl_ind_equations.id
                                                        INNER JOIN mdl_ind_score ON t1.id = mdl_ind_score.id_company_indicators
                                                        WHERE mdl_ind_score.id_comapny = :id_company ORDER BY date DESC");
            $stmt -> bindParam(":id_company", $data, PDO::PARAM_INT);
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

    //ver empresas por consultores
    static public function MDlcompanyConsultan(){
        if(Connection::connecting() !="connectionError"){
            $stmt = Connection::connecting()->prepare("SELECT mdl_ind_companies.name, mdl_ind_companies.nit, mdl_user.username, CONCAT(mdl_user.firstname,' ',mdl_user.lastname)AS NAMES, mdl_ind_companies.id  FROM mdl_ind_companies
                                                       INNER JOIN mdl_ind_user_companies ON mdl_ind_companies.id = mdl_ind_user_companies.id_companies
                                                       INNER JOIN mdl_user ON mdl_ind_user_companies.id_user = mdl_user.id");
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