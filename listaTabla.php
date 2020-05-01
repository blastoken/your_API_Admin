<?php
session_start();
require 'database/Connection.php';
require 'database/QueryBuilder.php';
require 'database/RootDB.php';
require 'entities/ColumnaTabla.php';
require 'entities/Vista.php';
require 'entities/Index.php';
require 'utils/utilidades.php';

if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
if(isset($_GET['tabla'])){
  $configLocal=require_once 'app/local.php';
  $connectionLocal = Connection::make($configLocal['database']);
  $rootDB = new RootDB($connectionLocal);
  $_SESSION['errores'] = array();
  $tabla = $_GET['tabla'];
  require 'entities/'.$_SESSION['bdActiva'].'/'.$tabla.".php";  //obtener la entidad de la tabla
  $config = require_once 'app/ddbbs/'.$_SESSION['bdActiva'].'.php';
  $connection = Connection::make($config['database']);
  $queryBuilder = new QueryBuilder($connection,$tabla,$tabla);
  try {
    $vistasTabla = $rootDB->findViewByBBDDAndTable($_SESSION['bdActiva'],$tabla);

    //Insertar nuevos campos
    if(isset($_POST['insertar'])){
      array_pop($_POST);
      $objeto = new $tabla();
      $objeto->setFromArray($_POST);
      /*Controlar que ningún campo esté vacío
      /-------------------------------------/
      */
      $queryBuilder->save($objeto);
      header("Location: listaTabla.php?tabla=".$tabla);
      die();
    }

    $objetos = $queryBuilder->findAll();
    $columnas = $rootDB->getAllColumnsFromTable($_SESSION['bdActiva'], $tabla);

    //Actualizar campo existente
    if(isset($_POST['update'])){
      array_pop($_POST);
      $objeto = new $tabla();
      $objeto->setFromArray($_POST);

      $id = getIdsName($columnas);

      $queryBuilder->update($objeto,$id,$_POST[$id]);
      header("Location: listaTabla.php?tabla=".$tabla);
      die();
    }

    //Eliminar
    if(isset($_GET['id'])){
      $id = getIdsName($columnas);
      $queryBuilder->delete($id,$_GET['id']);
      header("Location: listaTabla.php?tabla=".$tabla);
      die();
    }

    if(isset($_GET['vista'])){
      $vista = $_GET['vista'];
      //S'obté l'entitat i els resultats de la seua execució (array del select efectuat)
      require_once "entities/".$_SESSION['bdActiva']."/".$tabla."/".$vista.".php";
      $queryBuilderVista = new QueryBuilder($connection, $vista, $vista);
      $objetosVista = $queryBuilderVista->findAll();
    }else{
      $indexes = $rootDB->getAllIndexesFromDB($_SESSION['bdActiva']);
      $indexes = getTableIndexes($indexes);
      $indexesThis = $indexes[$tabla];
      if(sizeof($indexesThis) > 0){
        $tablaRelated = $indexesThis[0]->getTablaRef();
        $campoRelated = $indexesThis[0]->getColumnaRef();
        $campoFK = $indexesThis[0]->getColumna();
        require_once "entities/".$_SESSION['bdActiva']."/".$tablaRelated.".php";
        $queryBuilderRelated = new QueryBuilder($connection, $tablaRelated, $tablaRelated);
        $objetosRelated = $queryBuilderRelated->findAll();
      }
    }

  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],$queryBuilderException->getMessage());
  }catch(PDOException $pdoException){
      array_push($_SESSION['errores'],$pdoException->getMessage());
  }

  if(sizeof($_SESSION['errores']) == 0){
    unset($_SESSION['errores']);
  }

}else{
  unset($_SESSION['tablaActiva']);
  header("Location: tablasbdyaa.php?bd=".$_SESSION['bdActiva']);
  die();
}

$_SESSION['page'] = "listaTabla.php?tabla=".$tabla;

include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/listaTabla.view.php");
?>
