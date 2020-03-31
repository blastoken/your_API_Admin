<?php
session_start();
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
$nomtaula = "";

if(isset($_POST['crearTabla'])){
  var_dump($_POST);
}

include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/addTabla.view.php");
?>
