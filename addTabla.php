<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require 'database/Connection.php';
require 'database/RootTable.php';
require 'entities/ColumnaTabla.php';
require 'entities/Index.php';
require 'utils/utilidades.php';
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}

$nomtaula = "";
$errores = array();
$columnas = array();
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
      crearEntidad("entities/".$_SESSION['bdActiva'],$nomTaula, $columnas);
      unset($_SESSION['errores']);
      header("Location: tablasbdyaa.php?bd=".$_SESSION['bdActiva']);
      die();
    }
  }else{
    $_SESSION['errores'] = unificarArrays($_SESSION['errores']);
  }

  $_SESSION['page'] = "addTabla.php";
}

if(isset($_GET['tabla'])){
  $_SESSION['errores'] = array();
  $nomTaula = $_GET['tabla'];
  require 'database/RootDB.php';
  $configLocal = require_once 'app/local.php';
  try{
    $connectionLocal = Connection::make($configLocal['database']);
    $rootDB = new RootDB($connectionLocal);
    $columnas = $rootDB->getAllColumnsFromTable($_SESSION['bdActiva'], $nomTaula);
    $indexes = $rootDB->getAllIndexesFromTable($_SESSION['bdActiva'], $nomTaula);
    var_dump($indexes);
  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
  }catch(PDOException $pdoException){
      array_push($_SESSION['errores'],array($pdoException->getMessage()));
  }
  if(isset($_POST['editarTabla'])){
    $count = $_POST['count'];
    $columnasUpdate = array();
    for ($i=0; $i <= $count; $i++) {
        $extra = "";
        if(isset($_POST['campo'.$i.'NON']) || $_POST['campo'.$i.'Tipo'] === "date"){
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
        $columnaUpdate = new ColumnaTabla($_POST['campo'.$i.'Nombre'],$nomTaula,(string)$_POST['campo'.$i.'Length'],$_POST['campo'.$i.'Tipo'],$extra,$indice);
        $errores = comprobarColumnasFormulario($columnaUpdate,$i);
        if(sizeof($errores) == 0){
          array_push($columnasUpdate, $columnaUpdate);
        }else{
          array_push($_SESSION['errores'],$errores);
        }
    }

    $alteraciones = getAlteracionesUpdateTable($columnas, $columnasUpdate, $nomTaula);
    var_dump($alteraciones);

    try{
      if(sizeof($alteraciones) > 0){
        $rootTable->lanzarSentencias($alteraciones);
        //Sobreescriu l'entitat modificada
        crearEntidad("entities/".$_SESSION['bdActiva'], $nomTaula, $columnasUpdate);
      }
    }catch(QueryBuilderException $queryBuilderException){
        array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
    }catch(PDOException $pdoException){
        array_push($_SESSION['errores'],array($pdoException->getMessage()));
    }
    if(sizeof($_SESSION['errores']) == 0){
      unset($_SESSION['errores']);
      header("Location: tablasbdyaa.php?bd=".$_SESSION['bdActiva']);
      die();
    }
}

if(isset($_GET['deleteColumn'])){
  $columnToDelete = $_GET['deleteColumn'];
  try{
    if($rootTable->eliminarColumna($nomTaula, $columnToDelete)){
      $inDelete = 0;
      foreach ($columnas as $indice => $columna) {
        if($columna->getNombre() === $columnToDelete){
          $inDelete = $indice;
        }
      }
      unset($columnas[$indice]);
      crearEntidad("entities/".$_SESSION['bdActiva'], $nomTaula, $columnas);
      if(isset($_SESSION['errores'])){
        unset($_SESSION['errores']);
      }
    }
  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
  }catch(PDOException $pdoException){
      array_push($_SESSION['errores'],array($pdoException->getMessage()));
  }
  header("Location: addTabla.php?tabla=".$nomTaula);
  die();
}

if(sizeof($_SESSION['errores']) > 0){
  $_SESSION['errores'] = unificarArrays($_SESSION['errores']);
}else{
  unset($_SESSION['errores']);
}

  $_SESSION['page'] = "addTabla.php?tabla=".$nomTaula;
}


include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/addTabla.view.php");

?>
