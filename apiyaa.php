<?php
require 'entities/BBDD.php';
require 'entities/API.php';
require 'utils/utilidades.php';
require 'database/Connection.php';
require 'database/QueryBuilder.php';
session_start();
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
$config=require_once 'app/local.php';
$connection = Connection::make($config['database']);
$queryBuilderBD = new QueryBuilder($connection,'bbdd','BBDD');
$queryBuilderAPI = new QueryBuilder($connection,'api','API');
try{
  $todasBasesDatos = $queryBuilderBD->findBy("admin",$_SESSION['usuarioLogueado']['id']);
  $apis = $queryBuilderAPI->findBy("admin",$_SESSION['usuarioLogueado']['id']);
}catch(QueryBuilderException $queryBuilderException){
  array_push($_SESSION['errores'],$queryBuilderException->getMessage());
}

if(isset($_POST['logginapi'])){
  $_SESSION['errores'] = [];
  $nombreapi = $_POST['nombreapi'];
  $userapi = $_POST['userapi'];
  $passapi = $_POST['passapi'];
  $selected = null;
  foreach ($apis as $api) {
    if($api->getNombre() === $nombreapi){
      if($api->getUsuario() === $userapi || password_verify($passapi, $api->getPass())){
          $selected = $api;
      }else{
        array_push($_SESSION['errores'],"Contraseña y/o Usuario incorrecto/s...");
      }
    }
  }

  if(sizeof($_SESSION['errores']) == 0){
    unset($_SESSION['errores']);
  }
  if($selected !== null){
    $_SESSION['apiActiva'] = $selected->toFullArray();
    header("Location: listaApi.php");
    die();
  }
}

if(isset($_POST['createapi'])){
  $_SESSION['errores'] = [];
  $nombreapi = $_POST['nombreapi'];
  $existe = false;
  foreach ($apis as $api) {
    if($api->getNombre() === $nombreapi){
      $existe = true;
    }
  }
  $bbddapi = $_POST['bbddapi'];
  $userapi = $_POST['userapi'];
  $passapi = $_POST['passapi'];
  if(!$existe){
    $passapi = password_hash($passapi, PASSWORD_BCRYPT, array('cost' => 15));
    $newAPI = new API(0,$_SESSION['usuarioLogueado']['id'],$bbddapi,$nombreapi,$userapi,$passapi);
    try{
      $queryBuilderAPI->save($newAPI);
      $apis = $queryBuilderAPI->findBy("admin",$_SESSION['usuarioLogueado']['id']);
      foreach ($apis as $api) {
        if($api->getNombre() === $nombreapi){
          $_SESSION['apiActiva'] = $api->toFullArray();
        }
      }
    }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],$queryBuilderException->getMessage());
    }
  }else{
    array_push($_SESSION['errores'],"Ya existe una api con ese nombre...");
  }
  if(sizeof($_SESSION['errores']) == 0){
    unset($_SESSION['errores']);
  }
}

$_SESSION['page'] = "apiyaa.php";
include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/apiyaa.view.php");
?>
