<?php
session_start();
error_reporting(0);
require 'utils/utilidades.php';
require 'database/Connection.php';
require 'database/UsuariosBD.php';
require 'database/QueryBuilder.php';
require 'entities/Usuario.php';
include_once("views/partials/header.view.php");
include_once("views/partials/nav.view.php");

$errores = array();
$todosErrores = array();
$nombre = "";
$apellidos = "";
$email = "";
$pass = "";
$pass2 = "";
$img = "";
if(isset($_POST['registrarse'])){
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass2 = $_POST['pass2'];
  $usuario = array('nombre' => $nombre, 'apellidos' => $apellidos, 'email' => $email, 'pass' => $pass, 'pass2' => $pass2);
  $errores = validarCamposRegistro($usuario);
  if(sizeof($errores) == 0){
    try{
      $config=require_once 'app/local.php';
      $connection = Connection::make($config['database']);
      $usuariosBD = new UsuariosBD($connection);
      if($usuariosBD->existeEmail($usuario['email'])){
        $queryBuilder = new QueryBuilder($connection,'usuarios','Usuario');
        $user = new Usuario(0, $nombre, $apellidos, $email, $pass, "default.png", date('Y-m-d H:i:s'));
        $queryBuilder->save($user);
      }else{
        $errores['email'] = array("Ya hay registrado un usuario con este E-mail");
      }
      if(sizeof($errores) == 0){
        header("Location: login.php?action=algo&email=$email&pass=$pass");
        die();
      }
    }catch(QueryBuilderException $queryBuilderException){
        array_push($todosErrores,$queryBuilderException->getMessage());
    }
  }
  $todosErrores = unificarArrays($errores);
}

include_once("views/registro.view.php");
if(sizeof($errores) > 0){
  $scripts = "<script>";
  foreach ($errores as $key => $value) {
    $scripts .= "addClaseByIdElement(\"inputVioletaError\",\"$key\");";
  }
  $scripts .= "</script>";
  echo $scripts;
}

include_once("views/partials/pie.view.php");
?>
