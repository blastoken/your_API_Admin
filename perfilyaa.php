<?php
session_start();
require 'database/Connection.php';
require 'database/QueryBuilder.php';
require 'entities/Usuario.php';
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
$_SESSION['page'] = "perfilyaa.php";
if(isset($_POST['btnPerfil'])){
  $_SESSION['errores'] = [];
  $config=require_once 'app/local.php';
  $connection = Connection::make($config['database']);
  $queryBuilder = new QueryBuilder($connection,'usuarios','Usuario');

  try{
    $usuario = $queryBuilder->findById($_SESSION['usuarioLogueado']['id']);
    $usuario->setNombre($_POST['userNombre']);
    $usuario->setApellidos($_POST['userApellidos']);
    $usuario->setEmail($_POST['userEmail']);
    $queryBuilder->update($usuario, 'id', $usuario->getId());
    $_SESSION['usuarioLogueado'] = array(
      'id' => $usuario->getId(),
      'nombre' => $usuario->getNombre(),
      'apellidos' => $usuario->getApellidos(),
      'email' => $usuario->getEmail(),
      'password' => $usuario->getPassword(),
      'img' => $usuario->getRutaImg(),
      'registro' => $usuario->getRegistro()
      );
  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],$queryBuilderException->getMessage());
  }
  if(sizeof($_SESSION['errores']) == 0){
    unset($_SESSION['errores']);
  }
}
include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/perfilyaa.view.php");
?>
