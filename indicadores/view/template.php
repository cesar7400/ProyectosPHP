<?php
    require_once "controller/users.controller.php";
    require_once "model/users.model.php";
    require_once('../config.php');
    require_login();

    $PAGE->requires->jquery();
    $PAGE->requires->jquery_plugin('ui');

    $PAGE->set_title('Indicadores');
    $url = new moodle_url('/indicadores/index.php');
    $PAGE->requires->js(new moodle_url('view/datatable/jquery.dataTables.min.js'),true);
    $PAGE->requires->css(new moodle_url('view/datatable/jquery.dataTables.min.css'), true);
    $PAGE->requires->js(new moodle_url('view/js/consultants.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/companies.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/companiessel.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/companyindicators.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/indicatorsel.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/companiesIndicatossel.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/historyindicators.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/companiesconsultants.js'),true);
    $PAGE->requires->js(new moodle_url('view/js/companyindsl.js'),true);

    echo $OUTPUT->header();
    $rpta = UsersController::CTRUsers($USER->id);
    echo '<input type="hidden" id="idConsult" value='.$USER->id.' />';
    
    if(isset($_GET["ruta"])){

        if($rpta[0][0] == "administrator"){

            if($_GET["ruta"]=="consultant"||
               $_GET["ruta"]=="companiesconsult"||
               $_GET["ruta"]=="viewindicator"){
                include "pages/".$_GET["ruta"].".php";
            }else{
                require_once "view/pages/menu.php";
            }
        }
        if($rpta[0][0] == "consultant"){
            if($_GET["ruta"]=="viewcompanies" ||
               $_GET["ruta"]=="companiesindicators"||
               $_GET["ruta"]=="indicatorsel" ||
               $_GET["ruta"]=="companiesindsel" ||
               $_GET["ruta"]=="viewindicator"){
                include "pages/".$_GET["ruta"].".php";
            }else{
                require_once "view/pages/menu.php";
            }
        } 
        if($rpta[0][0] == "company"){
            if($_GET["ruta"]=="companyind"){
                echo '<input type="hidden" id="idCompInd" value='.$rpta[0][1].'/>';
                include "pages/".$_GET["ruta"].".php";
            }
        }
    }else{
        //pagina principal 
        require_once "view/pages/menu.php";
    }
    echo $OUTPUT->footer();

?>