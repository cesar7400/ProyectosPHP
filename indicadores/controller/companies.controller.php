<?php

class CompaniesController{

    //ver empresas
    static public function CTRcompanies($option, $data){
        $rpta = CompaniesModel::MDLcompanies($option, $data);
        return $rpta;
    }

    //nuevo consultor - empresa
    static public function ctrNewCompanyUser($data){ 
        $table="mdl_ind_user_companies";
        $rpta = CompaniesModel::MdlnewUserCompany($table,$data);
        return $rpta;
    }

    //eliminar consultor - empresa
    static public function ctrDeleteCompanyUser($data){ 
        $table="mdl_ind_user_companies";
        $rpta = CompaniesModel::MdldeleteUserCompany($table,$data);
        return $rpta;
    }

    //empresas seleccionadas por consultor
    static public function ctrselectCompConsl($data){ 
        $rpta = CompaniesModel::MDLselectCompConsl($data);
        return $rpta;
    }

    //ver empresas asignadas por consultor
    static public function ctrViewcompaniesConsultant($data){ 
        $rpta = CompaniesModel::MDLViewcompaniesConsultant($data);
        return $rpta;
    }

    //vista nombre indicadores empresa
    static public function ctrCompanyIndicators($data){ 
        $rpta = CompaniesModel::MDLCompanyIndicators($data);
        return $rpta;
    }

    //indicador seleccionado
    static public function ctrSelectIndicator($data, $option){ 
        $rpta = CompaniesModel::MDLSelectIndicator($data, $option);
        return $rpta;
    }

    //ingreso calificacion empresa por indicador
    static public function ctrAddScoreCompany($data){
        $respuesta = CompaniesModel::MdlAddScoreCompany($data);
        return $respuesta;
    }

    //historico indicadores empresa
    static public function ctrhistoryIndicators($data){ 
        $rpta = CompaniesModel::MDLhistoryIndicators($data);
        return $rpta;
    }

    //ver empresas por consultores
    static public function ctrcompanyConsultan(){ 
        $rpta = CompaniesModel::MDlcompanyConsultan();
        return $rpta;
    }
}

?>