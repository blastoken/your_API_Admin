<?php
session_start();
require 'database/Connection.php';
require 'database/RootTable.php';
require 'entities/Index.php';
require 'utils/utilidades.php';

if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
if(isset($_GET['table']) && isset($_GET['fk'])){
  $_SESSION['errores'] = [];
  $tabla = $_GET['table'];
  $fk = $_GET['fk'];
  $config = require_once 'app/ddbbs/'.$_SESSION['bdActiva'].'.php';
  $connection = Connection::make($config['database']);
  $rootTable = new RootTable($connection);
  try{
    $rootTable->eliminarIndices($tabla, $fk);
  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],array($queryBuilderException->getMessage()));
  }catch(PDOException $pdoException){
      array_push($_SESSION['errores'],array($pdoException->getMessage()));
  }
  if(sizeof($_SESSION['errores']) == 0){
    unset($_SESSION['errores']);
  }
}
header("Location: ".$_SESSION['page']);
die();
?>
