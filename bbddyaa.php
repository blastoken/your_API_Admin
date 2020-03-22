<?php
session_start();
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
$_SESSION['page'] = "bbddyaa.php";
include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/bbddyaa.view.php");
?>
