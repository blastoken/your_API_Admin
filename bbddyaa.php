<?php
session_start();
require 'database/Connection.php';
require 'database/QueryBuilder.php';
require 'database/BaseDatosBD.php';
require 'database/RootDB.php';
require 'entities/BBDD.php';
require 'utils/utilidades.php';
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
$config=require_once 'app/local.php';
$connection = Connection::make($config['database']);
$queryBuilder = new QueryBuilder($connection,'bbdd','BBDD');

$_SESSION['page'] = "bbddyaa.php";
$nombbdd = "";
$userbbdd = "";
$passbbdd = "";
$todasBasesDatos = array();

if(isset($_POST['crearbd'])){
  $nombbdd = $_POST['nombbdd'];
  $userbbdd = $_POST['userbbdd'];
  $passbbdd = $_POST['passbbdd'];
  $adminbbdd = intval($_SESSION['usuarioLogueado']['id']);
  $bbdd = new BBDD(0,$adminbbdd,$nombbdd,$userbbdd,$passbbdd);
  $_SESSION['errores'] = hayCamposVacios($bbdd->toArray());
  if(sizeof($_SESSION['errores']) == 0){
    try{
      $BaseDatosBD = new BaseDatosBD($connection);
      if($BaseDatosBD->existeDB($bbdd->getNombre())){
        $rootDB = new RootDB($connection);
        if($rootDB->createDB($nombbdd)){
          if($rootDB->createUserDB($userbbdd,$passbbdd)){
            if($rootDB->grantUserDB($nombbdd,$userbbdd)){
              $encrypted = password_hash($passbbdd, PASSWORD_BCRYPT, array('cost' => 15));
              $bbdd->setPass($encrypted);
              $queryBuilder->save($bbdd);
              createDBConfig($nombbdd,$userbbdd,$passbbdd);
            }
          }
        }
      }else{
        array_push($_SESSION['errores'],array("Ya hay registrado una Base de Datos con este Nombre"));
      }

    }catch(QueryBuilderException $queryBuilderException){
        array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
    }
  }

  if(sizeof($_SESSION['errores']) > 0){
    $_SESSION['errores'] = unificarArrays($_SESSION['errores']);
  }else{
    unset($_SESSION['errores']);
  }
}
try{
  $todasBasesDatos = $queryBuilder->findAll();
}catch(QueryBuilderException $queryBuilderException){
  array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
}

include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/bbddyaa.view.php");
?>
