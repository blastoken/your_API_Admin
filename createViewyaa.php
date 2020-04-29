<?php
session_start();
require 'database/Connection.php';
require 'database/RootDB.php';
require 'entities/ColumnaTabla.php';
require 'entities/Index.php';
require 'utils/utilidades.php';

if(isset($_GET['tabla'])){
  $tabla = $_GET['tabla'];
  $bbdd = $_SESSION['bdActiva'];

  $_SESSION['page'] = "createViewyaa.php?tabla=".$tabla;
  $config = require_once 'app/ddbbs/'.$bbdd.'.php';
  $connection = Connection::make($config['database']);
  $rootDB = new RootDB($connection);

  try{
    $columns = $rootDB->getAllTablesAndColumnsFromDB($_SESSION['bdActiva']);
    $tablas = getTablasFromColumns($columns);
    $indexes = $rootDB->getAllIndexesFromDB($_SESSION['bdActiva']);
    $indexes = getTableIndexes($indexes);
    $indexesThis = $indexes[$tabla];
    $tablasRelacionadasInternas = getTablesRelatedFromThis($indexes[$tabla]);
    $tablasRelacionadasExternas = getTablesRelatedToThis($indexes, $tabla);
    $tablasRelacionadas = unirTablasRelacionadas($tablasRelacionadasInternas, $tablasRelacionadasExternas);


  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
  }
  if(isset($_POST['crearVista'])){
    array_pop($_POST);
    var_dump($_POST);
    //Ací mos quedem hui..(fck) hi ha que sopar

  }
}else{
  header("Location: tablasbdyaa.php?bd=".$_SESSION['bdActiva']);
  die();
}


include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/createViewyaa.view.php");

?>
