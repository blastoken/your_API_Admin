<?php
session_start();
include_once("views/partials/header.view.php");
include_once("views/partials/nav.view.php");
require 'database/Connection.php';
require 'database/UsuariosBD.php';
require 'entities/Usuario.php';

$usuario = "";
$pass = "";
$errores = array();
if(isset($_POST['btnLogin'])){
  $usuario = $_POST['usuario'];
  $pass = $_POST['pass'];
  if($usuario !== "" && $pass !== ""){
    try{
      $config=require_once 'app/local.php';
      $connection = Connection::make($config['database']);
      $usuariosBD = new UsuariosBD($connection);
      $oUsuario = $usuariosBD->comprobarLogin($usuario,$pass);
      if(sizeof($oUsuario) > 0){
        $oUsuario = $oUsuario[0];
        $_SESSION['usuarioLogueado'] = array(
          'id' => $oUsuario->getId(),
          'user' => $oUsuario->getUser(),
          'email' => $oUsuario->getEmail(),
          'password' => $oUsuario->getPassword()
        );
          header("Location: controlPanel.php");
          die();
      }else{
        array_push($errores, "Usuario o contraseña incorrectos...");
      }
    }catch(QueryBuilderException $queryBuilderException){
        array_push($errores,$queryBuilderException->getMessage());
    }
  }else{
    array_push($errores, "Hay campos vacíos");
  }
}

if(isset($_POST['btnRegistro'])){
  header("Location: registro.php");
  die();
}
include_once("views/login.view.php");
if(sizeof($errores) > 0){
  echo "
  <script>
    addClaseByIdElement(\"inputVioletaError\",\"usuario\");
    addClaseByIdElement(\"inputVioletaError\",\"pass\");
  </script>";
}
include_once("views/partials/pie.view.php");
?>
