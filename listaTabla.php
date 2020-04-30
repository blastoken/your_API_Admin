<?php
session_start();
require 'database/Connection.php';
require 'database/QueryBuilder.php';
require 'database/RootDB.php';
require 'entities/ColumnaTabla.php';
require 'entities/Vista.php';
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
    var_dump($vistasTabla);
    //Insertar nuevos campos
    if(isset($_POST['insertar'])){
      array_pop($_POST);
      $objeto = new $tabla();
      $objeto->setFromArray($_POST);
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
      //Falta la creació de l'entitat de la vista
      //Després s'obté l'entitat i els resultats de la seua execució (array del select efectuat)
      //Una volta tenim totes les dades falta carregar una taula de la vista amb els resultats
    }

  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],$queryBuilderException->getMessage());
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
