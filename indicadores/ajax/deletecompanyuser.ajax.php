<?php
require_once "../controller/companies.controller.php";
require_once "../model/companies.model.php";

class DeleteCompanyUser{
    
    public function DeleteUserCompany(){
        $data = array("id_user" => $this->id_user,
                      "id_companies" => $this->id_companies);
        $rpta=CompaniesController::ctrDeleteCompanyUser($data);
        echo json_encode($rpta);
    }
}
//eliminar usuario por id y empresas por id
if(isset($_POST["id_companies"]) && isset($_POST["id_user"])){

    $eliminarCompany = new DeleteCompanyUser();
    $eliminarCompany -> id_user = $_POST["id_user"];
    $eliminarCompany -> id_companies = $_POST["id_companies"];
    $eliminarCompany -> DeleteUserCompany();
}

?>