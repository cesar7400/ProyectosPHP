<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class NewCompanyUser{
    
    public function AddUserCompany(){
        $data = array("id_user" => $this->id_user,
                      "id_companies" => $this->id_companies);
        $rpta=CompaniesController::ctrNewCompanyUser($data);
        echo json_encode($rpta);
    }
}
//ingreso consultor por id y empresas por id
if(isset($_POST["id_companies"]) && isset($_POST["id_user"])){

    $addUserCompany = new NewCompanyUser();
    $addUserCompany -> id_user = $_POST["id_user"];
    $addUserCompany -> id_companies = $_POST["id_companies"];
    $addUserCompany -> AddUserCompany();
}

?>