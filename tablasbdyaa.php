<?php
session_start();
require 'database/Connection.php';
require 'database/RootDB.php';
require 'database/RootTable.php';
require 'entities/ColumnaTabla.php';
require 'entities/Index.php';
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
      $indexes = $rootDB->getAllIndexesFromDB($_SESSION['bdActiva']);
      $indexes = getTableIndexes($indexes);
    }
  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
  }
}else{
  header("Location: ".$_SESSION['page']);
  die();
}

if(isset($_POST['crearIndice'])){
  $_SESSION['errores'] = [];
  $errores = hayCamposVacios($_POST);
  if(sizeof($errores) == 0){
    $tablaPK = $_POST['modalIndexesTabla1'];
    $campoPK = $_POST['modalIndexesCampo1'];
    $tablaFK = $_POST['modalIndexesTabla2'];
    $campoFK = $_POST['modalIndexesCampo2'];
    if($tablaPK === $tablaFK){
      array_push($_SESSION['errores'], array("La tabla de la clave primaria debe ser diferente a la del campo asociado"));
    }else{
      $campoPK = getColumnaByName($campoPK, $tablas[$tablaPK]);
      $campoFK = getColumnaByName($campoFK, $tablas[$tablaFK]);
      if($campoPK->getIndice() === "PRI"){
        if($campoFK->getIndice() !== "PRI"){
          $sentencia = array("ALTER TABLE ".$tablaFK." ADD FOREIGN KEY(".$campoFK->getNombre().") REFERENCES ".$tablaPK."(".$campoPK->getNombre().") ON DELETE CASCADE;");
          $rootTable = new RootTable($connection);
          try{
              $rootTable->lanzarSentencias($sentencia);
              unset($_SESSION['errores']);
              $indexes = $rootDB->getAllIndexesFromDB($_SESSION['bdActiva']);
              $indexes = getTableIndexes($indexes);
          }catch(QueryBuilderException $queryBuilderException){
              array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
          }
        }else{
          array_push($_SESSION['errores'], array("El campo seleccionado en la tabla ".$tablaFK." no debe de ser una clave primaria"));
        }
      }else{
        array_push($_SESSION['errores'], array("El campo seleccionado en la tabla ".$tablaPK." no es una clave primaria"));
      }
    }
  }else{
    array_push($_SESSION['errores'],$errores);
  }
}

if(isset($_SESSION['errores'])){
  if(sizeof($_SESSION['errores']) > 0){
    $_SESSION['errores'] = unificarArrays($_SESSION['errores']);
  }
}
$_SESSION['page'] = "tablasbdyaa.php?bd=".$_SESSION['bdActiva'];

include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/tablasbdyaa.view.php");
?>
