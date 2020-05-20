<?php
session_start();
require 'database/Connection.php';
require 'database/RootDB.php';
require 'database/RootTable.php';
require 'database/QueryBuilder.php';
require 'entities/ColumnaTabla.php';
require 'entities/Docu.php';
require 'entities/Snippet.php';
require 'entities/Index.php';
require 'entities/Vista.php';
require 'utils/utilidades.php';

if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: login.php");
  die();
}
if(!isset($_SESSION['apiActiva'])){
  header("Location: apiyaa.php");
  die();
}
$configLocal=require_once 'app/local.php';
$connectionLocal = Connection::make($configLocal['database']);
$rootDBLocal = new RootDB($connectionLocal);
$_SESSION['errores'] = [];
$bdActiva = $_SESSION['apiActiva']['bbdd'];
$config = require_once 'app/ddbbs/'.$bdActiva.'.php';
$connection = Connection::make($config['database']);
$rootDB = new RootDB($connection);
$queryBuilder = new QueryBuilder($connectionLocal,"docus","Docu");
$queryBuilderSnippet = new QueryBuilder($connectionLocal,"snippets","Snippet");
try{
  $docus = $queryBuilder->findBy('api',$_SESSION['apiActiva']['id']);
  $snippetsByDocuId = getSnippetsFromDocus($docus, $queryBuilderSnippet);
  //var_dump($snippetsByDocuId);
  $columns = $rootDB->getAllTablesAndColumnsFromDB($bdActiva);
  $tablas = getTablasFromColumns($columns);
  $vistas = $rootDBLocal->findViewsByBBDD($bdActiva);
  $vistasByTable = getVistasPorTabla($vistas, array_keys($tablas));
  $columnasVistas = $rootDB->getAllViewsColumnsFromDB($bdActiva);
  $views = getTablasFromColumns($columnasVistas);

}catch(QueryBuilderException $queryBuilderException){
    array_push($_SESSION['errores'],$queryBuilderException->getMessage());
}

$_SESSION['page'] = "listaApi.php";
if(isset($_POST['createdocu'])){
  var_dump($_POST);
  $nombreDocu = $_POST['nombredocu'];
  $tablaDocu = $_POST['tabladocu'];
  $vistaDocu = $_POST['vistadocu'];
  $actionDocu = $_POST['actionDocu'];
  $docu = new Docu(0,$_SESSION['apiActiva']['id'], $nombreDocu, $tablaDocu, $vistaDocu, $actionDocu);
  $snippets = [];

  switch ($actionDocu) {
    case 'Create':
      for ($i=1; $i < sizeof($tablas[$tablaDocu]); $i++) {
        array_push($snippets,new Snippet(0,0,"Create",$tablas[$tablaDocu][$i]->getNombre(),"="));
      }
      break;
    case 'ReadBy':
      array_push($snippets,new Snippet(0,0,$_POST['snippetWhereAccion'],$_POST['snippetWhereCampo'],"="));
    case 'Read':
      array_push($snippets,new Snippet(0,0,$_POST['snippetOrderByAccion'],$_POST['snippetOrderByCampo'],(isset($_POST['snippetOrderByModo']))?"DESC":"ASC"));
      break;
    case 'Update':
      array_push($snippets,new Snippet(0,0,"IDActualizar", $tablas[$tablaDocu][0]->getNombre(), "="));
      for ($i=1; $i < sizeof($tablas[$tablaDocu]); $i++) {
        if(isset($_POST['snippetSetAccion'.$i])){
          array_push($snippets,new Snippet(0,0,$_POST['snippetSetAccion'.$i],$_POST['snippetSetCampo'.$i],$_POST['snippetSetModo'.$i]));
        }
      }
      if(sizeof($snippets) == 1){
        array_push($_SESSION['errores'],"Debes de actualizar por lo menos un campo...");
      }
      break;
    case 'Delete':
      array_push($snippets,new Snippet(0,0,"Eliminar", $tablas[$tablaDocu][0]->getNombre(),"="));
      break;
  }
  try{
    if(sizeof($_SESSION['errores']) == 0){
      if(sizeof($queryBuilder->findBy('nombre',$docu->getNombre())) == 0){
        $queryBuilder->save($docu);
        $docus = $queryBuilder->findBy('api',$_SESSION['apiActiva']['id']);
        $idDocuGuardado = 0;
        foreach ($docus as $d) {
          if($d->getNombre() === $docu->getNombre()){
            $idDocuGuardado = $d->getId();
            $docu->setId($idDocuGuardado);
          }
        }


        foreach ($snippets as $snippet) {
          $snippet->setDocu($idDocuGuardado);
          $queryBuilderSnippet->save($snippet);
        }

        createAPIDocument($snippets, $docu, $_SESSION['apiActiva']);

        header("Location: listaApi.php");
        die();

      }else{
        array_push($_SESSION['errores'],"Ya tienes un documento con este nombre en tu api...");
      }
    }
  }catch(QueryBuilderException $queryBuilderException){
      array_push($_SESSION['errores'],$queryBuilderException->getMessage());
  }
}

if(sizeof($_SESSION['errores']) == 0){
  unset($_SESSION['errores']);
}
include_once("views/partials/header.view.php");
include_once("views/partials/controlPanel.view.php");
include_once("views/apiAdmin/listaApi.view.php");
?>
