<?php
session_start();
require 'database/Connection.php';
require 'database/RootDB.php';
require 'entities/ColumnaTabla.php';
require 'utils/utilidades.php';

if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}

$nomtaula = "";
$errores = [];
if(isset($_GET['bd'])){
  $_SESSION['bdActiva'] = $_GET['bd'];
  $config = require_once 'app/ddbbs/'.$_SESSION['bdActiva'].'.php';
  $connection = Connection::make($config['database']);
  $rootDB = new RootDB($connection);

  try{
    if(isset($_GET['edit'])){
      header("Location: addTabla.php?tabla=".$_GET['edit']);
      die();
    }
    if(isset($_GET['delete'])){
      $nomtaula = $_GET['delete'];
      $errores = eliminarEntidad($_SESSION['bdActiva'],$nomtaula);
      if(sizeof($errores) == 0){
        unset($_SESSION['errores']);
        if($rootDB->deleteTable($nomtaula)){
        header("Location: ".$_SESSION['page']);
          die();
        }
      }else{
        array_push($_SESSION['errores'],$errores);
        header("Location: ".$_SESSION['page']);
        die();
      }
    }else{
      $columns = $rootDB->getAllTablesAndColumnsFromDB($_SESSION['bdActiva']);
      $tablas = getTablasFromColumns($columns);
    }
  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
  }
}else{
  header("Location: ".$_SESSION['page']);
  die();
}
if(isset($_SESSION['errores'])){
  if(sizeof($_SESSION['errores']) > 0){
    unificarArrays($_SESSION['errores']);
  }
}
$_SESSION['page'] = "tablasbdyaa.php?bd=".$_SESSION['bdActiva'];

include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/tablasbdyaa.view.php");
?>
