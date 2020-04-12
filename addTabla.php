<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require 'database/Connection.php';
require 'database/RootTable.php';
require 'entities/ColumnaTabla.php';
require 'utils/utilidades.php';
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}

$nomtaula = "";
$errores = array();

$config = require_once 'app/ddbbs/'.$_SESSION['bdActiva'].'.php';
$connection = Connection::make($config['database']);
$rootTable = new RootTable($connection);
if(isset($_POST['crearTabla'])){
  $_SESSION['errores'] = array();
  $nomTaula = $_POST['nomTaula'];
  if($nomTaula === ""){
    array_push($_SESSION['errores'],array("No has especificado un nombre a la tabla..."));
  }
  $count = $_POST['count'];
  $columnas = array();
  for ($i=0; $i <= $count; $i++) {
    if(sizeof($_SESSION['errores']) == 0){
      $extra = "";
      if(isset($_POST['campo'.$i.'NON'])){
        $extra = "NOT NULL";
      }else{
        if($_POST['campo'.$i.'Tipo'] === "timestamp"){
          $extra = "NULL DEFAULT NULL";
        }
      }
      $indice = "";
      if(isset($extra,$_POST['campo'.$i.'Indice'])){
        $indice = "PRIMARY KEY";
      }
      $columna = new ColumnaTabla($_POST['campo'.$i.'Nombre'],$nomTaula,(string)$_POST['campo'.$i.'Length'],$_POST['campo'.$i.'Tipo'],$extra,$indice);
      $errores = comprobarColumnasFormulario($columna,$i);
      if(sizeof($errores) == 0){
        array_push($columnas, $columna);
      }else{
        array_push($_SESSION['errores'],$errores);
      }
    }
  }
  if(sizeof($_SESSION['errores']) == 0){
    try{
      if(sizeof($columnas) > 0){
        $rootTable->createTable($nomTaula, $columnas);
      }else{
        array_push($_SESSION['errores'],array("No hay columnas en la tabla a crear..."));
      }
    }catch(QueryBuilderException $queryBuilderException){
        array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
    }catch(PDOException $pdoException){
        array_push($_SESSION['errores'],array($pdoException->getMessage()));
    }
    if(sizeof($_SESSION['errores']) > 0){
      $_SESSION['errores'] = unificarArrays($_SESSION['errores']);
    }else{
      crearEntidad($_SESSION['bdActiva'],$nomTaula, $columnas);
      unset($_SESSION['errores']);
      header("Location: tablasbdyaa.php?bd=".$_SESSION['bdActiva']);
      die();
    }
  }else{
    $_SESSION['errores'] = unificarArrays($_SESSION['errores']);
  }
}


include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/addTabla.view.php");
?>
