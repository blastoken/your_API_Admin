<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require '../../database/Connection.php';
  require '../../database/QueryBuilder.php';
  require '../../entities/API.php';
  require '../../entities/prova2/usuario.php';

  $config = require_once '../../app/ddbbs/prova2.php';
  $connection = Connection::make($config['database']);
  $queryBuilder = new QueryBuilder($connection,'usuario','usuario');

  $apiID = 6;
  $configLocal = require_once '../../app/local.php';
  $connectionLocal = Connection::make($configLocal['database']);
  $queryBuilderLocal = new QueryBuilder($connectionLocal, 'api', 'API');
  $api = $queryBuilderLocal->findBy('id',$apiID)[0];
  $json = json_decode(file_get_contents("php://input"));

  if(isset($json->apiUser) && isset($json->apiPassword)){
  if($json->apiUser === $api->getUsuario() && password_verify($json->apiPassword, $api->getPass())){
  
  $campo = "id";
  $orden = "ASC";
  try{
    $objects = $queryBuilder->findAllOrderBy($campo, $orden);

    $response = [];
    foreach ($objects as $object) {
      array_push($response, $object->toArrayToView());
    }

    http_response_code(200);

    echo json_encode($response);

  }catch(QueryBuilderException $queryBuilderException){
      http_response_code(404);

      echo json_encode(
          array("error" => $queryBuilderException->getMessage())
      );
  }
  }else{
    http_response_code(404);

    echo json_encode(
        array("error" => "Las credenciales de la API son incorrectas...")
    );
  }
  }else {
    http_response_code(404);

    echo json_encode(
        array("error" => "No se encontraron las credenciales...")
    );
  }
  ?>