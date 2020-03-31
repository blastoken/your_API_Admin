<?php
session_start();
require 'database/Connection.php';
require 'database/RootDB.php';
require 'entities/Columns.php';
require 'utils/utilidades.php';

if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
$nomtaula = "";
if(isset($_GET['bd'])){
  $_SESSION['bdActiva'] = $_GET['bd'];
  $config = require_once 'app/ddbbs/'.$_SESSION['bdActiva'].'.php';
  $connection = Connection::make($config['database']);
  $rootDB = new RootDB($connection);
  $columns = $rootDB->getAllTablesAndColumnsFromDB($_SESSION['bdActiva']);
  $tablas = getTablasFromColumns($columns);
}else{
  header("Location: ".$_SESSION['page']);
  die();
}
$_SESSION['page'] = "tablasbdyaa.php";

include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/tablasbdyaa.view.php");
?>
