<?php
  require_once "controller/users.controller.php";
  require_once "model/users.model.php";
  require_once('../config.php');

  $rpta = UsersController::CTRUsers($USER->id);

  echo'<div class="btn-group btn-group-justified">';
  if($rpta[0][0] == "administrator"){
    echo'<a href="consultant" class="btn btn-primary">Asignar empresa consultor</a>
         <a href="companiesconsult" class="btn btn-primary">Ver indicadores</a>';
  }
  if($rpta[0][0] == "consultant"){
    echo '<div class="btn-group">
            <a href="viewcompanies" class="btn btn-primary">Calificar empresas</a>
            <a href="companiesindsel" class="btn btn-primary">Ver indicadores</a>
          </div>';
  }
  if($rpta[0][0] == "company"){
    echo'<script>window.location="companyind";</script>';
  }
  echo '</div>';
?>
