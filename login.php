<?php
include_once("views/partials/header.view.php");
include_once("views/login.view.php");

if(isset($_POST['btnLogin'])){
  
}

if(isset($_POST['btnRegistro'])){
  header("Location: registro.php");
  die();
}
include_once("views/partials/pie.view.php");
?>
