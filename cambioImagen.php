<?php
session_start();
require 'database/Connection.php';
require 'database/UsuariosBD.php';
require 'entities/Usuario.php';
require 'utils/utilidades.php';
$config=require_once 'app/local.php';
$connection = Connection::make($config['database']);
$usuariosBD = new UsuariosBD($connection);

if(isset($_POST['page'])){
  $page = $_POST['page'];
  $id = $_POST['id'];
  $img = $_FILES['img'];

  $_SESSION['errores'] = validarImg($img);
  if (empty($erroresPost)) {
    try{
        $nombreFichero = time() . $img['name'];
        $ruta = "imgs/perfil/" .  $nombreFichero;

        move_uploaded_file($img['tmp_name'], $ruta);
        $img = $ruta;

        if($usuariosBD->cambioImagenPerfil($id, $nombreFichero)){
          if($_SESSION['usuarioLogueado']['img']!=="imgs/perfil/default.png"){
            unlink($_SESSION['usuarioLogueado']['img']);
          }
          $_SESSION['usuarioLogueado']['img'] = $ruta;
          unset($_SESSION['errores']);
        }

    }catch(QueryBuilderException $queryBuilderException){
        array_push($_SESSION['errores'],$queryBuilderException->getMessage());
    }
  }
  
    header("Location: $page");
    die();
}
?>
