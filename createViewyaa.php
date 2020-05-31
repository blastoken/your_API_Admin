<?php
session_start();
error_reporting(0);
require 'database/Connection.php';
require 'database/RootDB.php';
require 'database/RootTable.php';
require 'database/QueryBuilder.php';
require 'entities/ColumnaTabla.php';
require 'entities/Index.php';
require 'entities/CampoVista.php';
require 'entities/Vista.php';
require 'utils/utilidades.php';

if(isset($_GET['tabla'])){
  $_SESSION['errores'] = [];
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
    $numCampos = intval($_POST['countTotal']);
    array_pop($_POST);
    $nombreVista = $_POST['nombreVista'];
    unset($_POST['nombreVista']);
    if($nombreVista !== ""){
      $camposVista = getCamposVista($_POST, $numCampos);
      $sqlCreateview = array(getSentenciaCreateView($nombreVista,$camposVista,$indexesThis));
      try{
        $rootTable = new RootTable($connection);
        $rootTable->lanzarSentencias($sqlCreateview);
        $configLocal = require_once 'app/local.php';
        $connectionLocal = Connection::make($configLocal['database']);
        $queryBuilder = new QueryBuilder($connectionLocal,'vistas','Vista');
        $vista = new Vista(0,$_SESSION['bdActiva'],$nombreVista,$tabla);
        $queryBuilder->save($vista);
        $columnasVista = getSelectedColumnasView($camposVista, $tablas);
        var_dump($columnasVista);
        crearEntidad("entities/".$_SESSION['bdActiva']."/".$tabla, $nombreVista, $columnasVista);
      }catch(QueryBuilderException $queryBuilderException){
          array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
      }catch(PDOException $pdoException){
          array_push($_SESSION['errores'],array($pdoException->getMessage()));
      }
      if(sizeof($_SESSION['errores']) == 0){
        header("Location: listaTabla.php?tabla=".$tabla."&vista=".$nombreVista);
        die();
      }
    }else{
      array_push($_SESSION['errores'], array("No has indicado un nombre para la vista"));
    }

  }
}else{
  header("Location: tablasbdyaa.php?bd=".$_SESSION['bdActiva']);
  die();
}
if(sizeof($_SESSION['errores']) > 0){
  $_SESSION['errores'] = unificarArrays($_SESSION['errores']);
}else{
  unset($_SESSION['errores']);
}


include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/createViewyaa.view.php");

?>
