<?php
session_start();
include_once("views/partials/header.view.php");
include_once("views/partials/nav.view.php");
require 'database/Connection.php';
require 'database/UsuariosBD.php';
require 'entities/Usuario.php';
if(isset($_SESSION['usuarioLogueado'])){
  header("Location: controlPanel.php");
  die();
}
$config=require_once 'app/local.php';
$connection = Connection::make($config['database']);
$usuariosBD = new UsuariosBD($connection);
$email = "";
$pass = "";
$errores = array();
if(isset($_POST['btnLogin'])){
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  if($email !== "" && $pass !== ""){
    try{
      $oUsuario = $usuariosBD->comprobarLogin($email);
      if(sizeof($oUsuario) > 0){
        $oUsuario = $oUsuario[0];
        if(password_verify($pass, $oUsuario->getPassword())){
          $_SESSION['usuarioLogueado'] = array(
            'id' => $oUsuario->getId(),
            'nombre' => $oUsuario->getNombre(),
            'apellidos' => $oUsuario->getApellidos(),
            'email' => $oUsuario->getEmail(),
            'password' => $oUsuario->getPassword(),
            'img' => $oUsuario->getRutaImg(),
            'registro' => $oUsuario->getRegistro()
            );
            header("Location: controlPanel.php");
            die();
          }else{
            array_push($errores, "Contraseña incorrecta...");
          }
      }else{
        array_push($errores, "No existe este usuario...");
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

if(isset($_GET['action'])){
  $email = $_GET['email'];
  $pass = $_GET['pass'];
  try{
    $oUsuario = $usuariosBD->comprobarLogin($email,$pass);
    if(sizeof($oUsuario) > 0){
      $oUsuario = $oUsuario[0];
      $_SESSION['usuarioLogueado'] = array(
        'id' => $oUsuario->getId(),
        'nombre' => $oUsuario->getNombre(),
        'apellidos' => $oUsuario->getApellidos(),
        'email' => $oUsuario->getEmail(),
        'password' => $oUsuario->getPassword(),
        'img' => $oUsuario->getRutaImg(),
        'registro' => $oUsuario->getRegistro()
      );
        header("Location: controlPanel.php");
        die();
      }
    }catch(QueryBuilderException $queryBuilderException){
      array_push($errores,$queryBuilderException->getMessage());
    }
}

include_once("views/login.view.php");
if(sizeof($errores) > 0){
  echo "
  <script>
    addClaseByIdElement(\"inputVioletaError\",\"email\");
    addClaseByIdElement(\"inputVioletaError\",\"pass\");
  </script>";
}
include_once("views/partials/pie.view.php");
?>
