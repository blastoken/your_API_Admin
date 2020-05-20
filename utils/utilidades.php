<?php
function validarCamposRegistro($usuario){
  $errores = hayCamposVacios($usuario);
  if($usuario['pass'] !== ""){
    if(!esUnaPassFuerte($usuario['pass'])){
      if(isset($errores['pass'])){
        array_push($errores['pass'], "La contraseña debe contener mayúsculas, minúsculas y números");
      }else{
        $errores['pass'] = array("La contraseña debe contener mayúsculas, minúsculas y números");
      }
      if(!isset($errores['pass2'])){
        $errores['pass2'] = array("");
      }
    }


    if($usuario['pass2'] !== ""){
      if($usuario['pass'] !== $usuario['pass2']){
        if(isset($errores['pass'])){
          array_push($errores['pass'], "Las contraseñas deben de coincidir");
        }else{
          $errores['pass'] = array("Las contraseñas deben de coincidir");
        }
        if(!isset($errores['pass2'])){
          $errores['pass2'] = array("");
        }
      }
    }

  }

  return $errores;
}

function esUnaPassFuerte($pass){
  if($pass === preg_replace('\[a-z\]','',$pass)){
    return false;
  }
  if($pass === preg_replace('\[A-Z\]','',$pass)){
    return false;
  }
  if($pass === preg_replace('\[0-9\]','',$pass)){
    return false;
  }
  return true;
}

function hayCamposVacios($obj){
  $errores = array();
  foreach($obj as $campo => $valor){
    if($valor === ""){
      $errores[$campo] = array("El campo ".$campo." no puede estar vacío");
    }
  }
  return $errores;
}

function validarImg($fichero){
    $errorVal=[];
    $tipoError=$fichero['error'];
    $arrTypes=['image/jpeg', 'image/png', 'image/gif'];


    if(!isset($fichero)){
        $errorVal[]="Debes seleccionar un fichero";
    }
    elseif($tipoError!== UPLOAD_ERR_OK){
        if($tipoError=== UPLOAD_ERR_INI_SIZE)
            $errorVal[]="Error ini size";
        elseif($tipoError===UPLOAD_ERR_FORM_SIZE)
            $errorVal[]="Error de tamaño del archivo";
        elseif($tipoError===UPLOAD_ERR_PARTIAL)
            $errorVal[]="No se ha podido subir el archivo completo";
        else
            $errorVal[]="Error en la subida";
    }
    elseif(in_array($fichero['type'], $arrTypes)=== false){

        $errorVal[]="Tipo de fichero no soportado";
    }
    /*comprobar que el fichero se ha subido por una peticion post*/
    elseif(!is_uploaded_file($fichero['tmp_name'])){
        $errorVal[]="El archivo no se ha subido mediante un formulario";
    }


    return $errorVal;
}

function unificarArrays($arr){
  $arrTodos = array();
  foreach ($arr as $key => $value) {
    foreach($value as $error){
      if($error!== ""){
        array_push($arrTodos,$error);
      }
    }
  }
  return $arrTodos;
}

function createDBConfig($nombbdd, $userbbdd, $passbbdd){
  $ruta = "app/ddbbs/".$nombbdd.".php";
  $file = fopen($ruta,'w');
  $content = "<?php
      return[
          'database'=>[
              'name'=>'".$nombbdd."',
              'username'=>'".$userbbdd."',
              'password'=>'".$passbbdd."',
              'connection'=>'mysql:host=localhost',
              'options'=>[
                  PDO::MYSQL_ATTR_INIT_COMMAND=>\"SET NAMES utf8\",
                  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_PERSISTENT=>true
              ]
          ]
      ];";
  fwrite($file,$content);
  fclose($file);
}

function getTablasFromColumns($columns){
  $tablasNames = array();
  foreach ($columns as $column) {
    if(!in_array($column->getTabla(), $tablasNames)){
      array_push($tablasNames, $column->getTabla());
    }
  }
  $tablas = array();
  foreach($tablasNames as $name){
    $tablas[$name] = array();
  }
  foreach ($columns as $column) {
    array_push($tablas[$column->getTabla()], $column);
  }
  return $tablas;
}

function getTableIndexes($indexes){
  $tablasNames = array();
  foreach ($indexes as $index) {
    if(!in_array($index->getTabla(), $tablasNames)){
      array_push($tablasNames, $index->getTabla());
    }
  }
  $tablas = array();
  foreach($tablasNames as $name){
    $tablas[$name] = array();
  }
  foreach ($indexes as $index) {
    array_push($tablas[$index->getTabla()], $index);
  }
  return $tablas;
}

function comprobarColumnasFormulario($columna,$i){
  $errores = array();
    if($columna->getTipo() === ""){
      if($columna->getNombre() === ""){
        array_push($errores,"Nombre y tipo no definidos en columna ".$i."...");
      }else{
        array_push($errores,"Tipo no definido para la columna ".$columna->getNombre());
      }
    }
    if($columna->getNombre() !== ""){
      if(strpos($columna->getNombre()," ")){
        $columna->setNombre(explode($columna->getNombre()," ")[0]);
      }
    }else{
      array_push($errores,"Nombre no definido en columna ".$i."...");
    }
    if($columna->getLength() == 0 && $columna->getTipo() !== "timestamp" && $columna->getTipo() !== "date"){
      array_push($errores,"Tamaño no definido en columna ".$i."...");
    }

  return $errores;
}

function eliminarEntidad($bd,$nomTaula):array{
  $errores = array();
  $ruta = "entities/".$bd."/".$nomTaula.".php";
  if(file_exists($ruta)){
    unlink($ruta);
  }else{
    array_push($errores,"No se ha podido eliminar el archivo de la tabla...");
  }
  return $errores;
}

function crearEntidad($ruta, $nomTaula, $columnas){
  if(!file_exists($ruta)){
    mkdir($ruta);
  }
  $ficheroEntidad = fopen($ruta."/".$nomTaula.".php","w");
  $content = "<?php
class ".$nomTaula."{
    ";

  foreach ($columnas as $clave => $columna) {
    $content.=insertaCampo($columna);
  }

  $content .="
  ".createConstructor($columnas)."
  ";

  foreach ($columnas as $clave => $columna) {
    $content .= createGetter($columna);
  }

  foreach ($columnas as $clave => $columna) {
    $content .= createSetter($columna);
  }

  $content .= createToArrayToView($columnas);

  $content .= createToArray($columnas);

  $content .= createSetFromArray($columnas);

  $content.="
}";

  fwrite($ficheroEntidad,$content);
  fclose($ficheroEntidad);
}

function insertaCampo($columna):string{
  $content = "";
  $content .= "/**
   * @var ".convierteTipo($columna->getTipo())."
   */
   private $".$columna->getNombre().";
   ";
  return $content;
}

function convierteTipo($tipo):string{
  switch($tipo){
    case "int":
      $convertido = "int";
    break;
    case "tinyint":
      $convertido = "int";
    break;
    default:
      $convertido = "string";
    break;
  }
  return $convertido;
}

function createConstructor($columnas):string{
  $content = "";
  $content .= "public function __construct(";
  $content .="$".$columnas[0]->getNombre()."=";
  if($columnas[0]->getTipo() === "int" || $columnas[0]->getTipo() === "tinyint"){
    $content .="0";
  }else{
    $content .="\"\"";
  }
  for ($i=1; $i < sizeof($columnas); $i++) {
    $content .=",$".$columnas[$i]->getNombre()."=";
    if($columnas[$i]->getTipo() === "int" || $columnas[$i]->getTipo() === "tinyint"){
      $content .="0";
    }else{
      $content .="\"\"";
    }
  }
  $content .=")
  {";
  foreach ($columnas as $clave => $columna) {
    $content .="
    $"."this->".$columna->getNombre()." = $".$columna->getNombre().";";
  }
  $content .= "
  }
";
  return $content;
}

function createGetter($columna):string{
  $content = "";
  $content .= "public function get".$columna->getNombre()."():".convierteTipo($columna->getTipo())."
  {
      return $"."this->".$columna->getNombre().";
  }

  ";
  return $content;
}

function createSetter($columna):string{
  $content = "";
  $content .= "public function set".$columna->getNombre()."($".$columna->getNombre().")
  {
      $"."this->".$columna->getNombre()." = $".$columna->getNombre().";
  }

  ";
  return $content;
}

function createToArrayToView($columnas):string{
  $content = "";
  $content .= "public function toArrayToView():array
  {
    return [";
  $content .="
      '".$columnas[0]->getNombre()."'=>$"."this->get".$columnas[0]->getNombre()."()";
  for ($i=1; $i < sizeof($columnas); $i++) {
    $content .= ",
      '".$columnas[$i]->getNombre()."'=>$"."this->get".$columnas[$i]->getNombre()."()";
  }
  $content .="
    ];
  }
";
  return $content;
}

function createToArray($columnas):string{
  $inside = "";
  $content = "";
  $content .= "
  public function toArray():array
  {
    return [";
  foreach ($columnas as $clave => $columna) {
    if($columna->getIndice() === ""){
    $inside .= ",
      '".$columna->getNombre()."'=>$"."this->get".$columna->getNombre()."()";
    }
  }
  $inside = substr($inside,1,strlen($inside)-1);
  $content .= $inside."
    ];
  }
";
  return $content;
}

function createSetFromArray($columnas):string{
  $inside = "";
  $content = "";
  $content .= "
  public function setFromArray($"."array)
  {
    ";
    foreach ($columnas as $columna) {
      $content .= "$"."this->".$columna->getNombre()." = $"."array['".$columna->getNombre()."'];
    ";
    }
$content.="}
";
  return $content;
}

function getIdsName($columnas):string
{
  foreach ($columnas as $columna) {
    if($columna->getIndice() !== ""){
      return $columna->getNombre();
    }
  }
  return "id";
}

function getAlteracionesUpdateTable($columnas, $columnasUpdate, $tabla):array{
  $cambios = array();
  foreach ($columnasUpdate as $num => $columnaUpdate) {
    if(isset($columnas[$num])){
      if($columnas[$num]->getTipo() !== $columnaUpdate->getTipo() || $columnas[$num]->getLength() !== $columnaUpdate->getLength() || ($columnas[$num]->getExtra() !== $columnaUpdate->getExtra() && $columnas[$num]->getExtra() === "")){
        //ALTER TABLE table_name MODIFY COLUMN column_name column_type(column_length)
        array_push($cambios, "ALTER TABLE ".$tabla." MODIFY COLUMN ".$columnaUpdate->toColumnString().";");
      }
    }else{
      array_push($cambios,"ALTER TABLE ".$tabla." ADD ".$columnaUpdate->toColumnString().";");
    }
  }
  return $cambios;
}

function getColumnaByName($campo, $columnas){
  foreach ($columnas as $num => $columna) {
    if($columna->getNombre() === $campo){
      return $columna;
    }
  }
  return new ColumnaTabla();
}

function getColumnsToCreateView($tabla, $indexes){

}

function getTablesRelatedFromThis($indexes){
  $tables = array();

  foreach ($indexes as $index) {
    if(!in_array($index->getTablaRef(), $tables)){
      array_push($tables, $index->getTablaRef());
    }
  }

  return $tables;
}

function getTablesRelatedToThis($indexesAll, $tabla){
  $tables = array();

  foreach ($indexesAll as $key => $indexes) {
    if($key !== $tabla){
      foreach ($indexes as $index) {
        if($index->getTablaRef() === $tabla){
          if(!in_array($index->getTabla(), $tables)){
            array_push($tables, $index->getTabla());
          }
        }
      }
    }
  }

  return $tables;
}

function unirTablasRelacionadas($tablasI, $tablasE){
  $tablasRelacionadas = $tablasI;
  foreach ($tablasE as $tabla) {
    if(!in_array($tabla,$tablasRelacionadas)){
      array_push($tablasRelacionadas, $tabla);
    }
  }
  return $tablasRelacionadas;
}

function getCamposVista($campos, $num){
  $camposVista = [];

  for ($i=0; $i < $num; $i++) {
    $campo = new CampoVista($campos['tabla'.$i], $campos['campo'.$i], $campos['renombre'.$i]);
    array_push($camposVista, $campo);
  }

  return $camposVista;
}

function getSentenciaCreateView($nombre, $campos, $indexes):string
{
  $sql = "CREATE VIEW ".$nombre." AS SELECT";
  foreach ($campos as $campo) {
    $sql .= " ".$campo->getTabla().".".$campo->getCampo()." AS '".$campo->getAlias()."',";
  }
  $sql = substr($sql, 0, strlen($sql)-1);
  $sql .= " FROM ";
  $tablas = [];
  array_push($tablas, $campos[0]->getTabla());
  foreach ($campos as $campo) {
    if(!in_array($campo->getTabla(),$tablas)){
      array_push($tablas, $campo->getTabla());
    }
  }

  foreach ($tablas as $tabla) {
    $sql .= " ".$tabla.",";
  }
  $sql = substr($sql, 0, strlen($sql)-1);
  if(sizeof($tablas) > 1){
    $sql .= " WHERE ";
    foreach ($indexes as $index) {
      if(in_array($index->getTabla(), $tablas) && in_array($index->getTablaRef(),$tablas)){
        $sql .= "".$index->getTabla().".".$index->getColumna()." = ".$index->getTablaRef().".".$index->getColumnaRef()." AND ";
      }
    }
    $sql = substr($sql, 0, strlen($sql)-5).";";
  }

  return $sql;
}

function getSelectedColumnasView($columnasVista, $tablas){
  $camposVista = [];
  foreach ($columnasVista as $columnaVista) {
    foreach ($tablas[$columnaVista->getTabla()] as $columna) {
      if($columna->getNombre() === $columnaVista->getCampo()){
        $columna->setNombre($columnaVista->getAlias());
        array_push($camposVista,$columna);
      }
    }
  }
  return $camposVista;
}

function getVistasPorTabla($vistas, $tablas){
  $vistasByTable = [];
  foreach ($tablas as $tabla) {
    $vistasByTable[$tabla] = [];
    foreach ($vistas as $vista) {
      if($vista->getTabla() === $tabla){
        array_push($vistasByTable[$tabla],$vista);
      }
    }
  }
  return $vistasByTable;
}

function createAPIDocument($snippets, $docu, $api){
  $ruta = "apis";
  if(!file_exists($ruta)){
    mkdir($ruta);
  }
  $ruta .="/".$api['nombre'];
  if(!file_exists($ruta)){
    mkdir($ruta);
  }
  $ficheroApi = fopen($ruta."/".$docu->getNombre().".php","w");
  $content = "<?php";
  $content .= "
  header(\"Access-Control-Allow-Origin: *\");
  header(\"Content-Type: application/json; charset=UTF-8\");

  require '../../database/Connection.php';
  require '../../database/QueryBuilder.php';
  require '../../entities/API.php';
  require '../../".getRequireTableView($docu,$api['bbdd'])."';

  $"."config = require_once '../../app/ddbbs/".$api['bbdd'].".php';
  $"."connection = Connection::make($"."config['database']);
  $"."queryBuilder = new QueryBuilder($"."connection,'".getAPIView($docu)."','".getAPIView($docu)."');

  $"."apiID = ".$api['id'].";
  $"."configLocal = require_once '../../app/local.php';
  $"."connectionLocal = Connection::make($"."configLocal['database']);
  $"."queryBuilderLocal = new QueryBuilder($"."connectionLocal, 'api', 'API');
  $"."api = $"."queryBuilderLocal->findBy('id',$"."apiID)[0];
  $"."json = json_decode(file_get_contents(\"php://input\"));

  if(isset($"."json->apiUser) && isset($"."json->apiPassword)){
  if($"."json->apiUser === $"."api->getUsuario() && password_verify($"."json->apiPassword, $"."api->getPass())){
  ";

  //Comprobación de las credenciales de la api

  $content .= getContentByAction($docu, $api['bbdd'], $snippets);

  $content .= "
  }else{
    http_response_code(404);

    echo json_encode(
        array(\"error\" => \"Las credenciales de la API son incorrectas...\")
    );
  }
  }else {
    http_response_code(404);

    echo json_encode(
        array(\"error\" => \"No se encontraron las credenciales...\")
    );
  }
  ?>";
  fwrite($ficheroApi,$content);
  fclose($ficheroApi);
}

function getAPIView($docu){
  if($docu->getVista()==="default"){
    return $docu->getTabla();
  }else{
    return $docu->getVista();
  }
}

function getRequireTableView($docu, $bbdd):string{
  $content = "";

  if($docu->getVista() === "default"){
    //Vista por defecto de la tabla
    $content = "entities/".$bbdd."/".$docu->getTabla().".php";
  }else{
    $content = "entities/".$bbdd."/".$docu->getTabla()."/".$docu->getVista().".php";
  }

  return $content;
}

function getContentByAction($docu, $bbdd, $snippets):string{
  $content = "";
    require ''.getRequireTableView($docu, $bbdd).'';
    $nombreEntity = getAPIView($docu);
    $entity = new $nombreEntity();
    $campos = array_keys($entity->toArray());

    switch($docu->getAccion()){
      case 'Create':
        $content .= getContentCreate($nombreEntity, $campos);
        break;
      case 'Read':
        $content .= "
  $"."campo = \"".$snippets[0]->getCampo()."\";
  $"."orden = \"".$snippets[0]->getModo()."\";";
        $content .= getContentRead();
        break;
      case 'ReadBy':
        $content .= "
  if(isset($"."json->".$snippets[0]->getCampo().")){
  $"."campoWhere = \"".$snippets[0]->getCampo()."\";
  $"."valor = $"."json->$"."campoWhere;
  $"."campo = \"".$snippets[1]->getCampo()."\";
  $"."orden = \"".$snippets[1]->getModo()."\";";
        $content .= getContentReadBy($snippets);
        break;
      case 'Update':
        $campsUpdate = separarSnippetsDeId($snippets);
        $nomId = $campsUpdate['id'][0];
        $updateSnippetsNames = $campsUpdate['snippets'];

        $camposIsset = getCamposIsset($campos);
        $content .= "
  if(".implode(' && ', $camposIsset)."){
  $"."idName = \"".$nomId."\";
  $"."valorId = $"."json->$nomId;
  $"."array = [];";
        foreach ($updateSnippetsNames as $usn) {
          $content .= "
  $"."array['".$usn."'] = $"."json->".$usn.";";
        }
        $content .= getContentUpdate();
        break;
      case 'Delete':
        $content .= "
  if(isset($"."json->".$snippets[0]->getCampo().")){
  $"."idName = \"".$snippets[0]->getCampo()."\";
  $"."valorId = $"."json->".$snippets[0]->getCampo().";";
        $content .= getContentDelete();
        $content .="
  }else{
    http_response_code(404);

    echo json_encode(
        array(\"error\" => \"Falta el campo '".$snippets[0]->getCampo()."' en el JSON...\")
    );
  }";
        break;
    }

  return $content;
}

function getCamposIsset($campos):array{
  $camposIsset = [];
  foreach ($campos as $campo) {
    array_push($camposIsset,"isset($"."json->$campo)");
  }
  return $camposIsset;
}

function getContentCreate($nombreEntity,$campos):string{
  $content = "";
  $camposIsset = getCamposIsset($campos);
  $content .= "
  $"."entity = new ".$nombreEntity."();
  $"."campos = array_keys($"."entity->toArray());
  if(".implode(' && ', $camposIsset)."){
  ";
  foreach ($campos as $clave) {
    $content .= "
  $"."entity->set".ucfirst($clave)."($"."json->".$clave.");";
  }

  $content .="
    try{
      $"."queryBuilder->save($"."entity);

      http_response_code(200);

      echo json_encode(
          array(\"message\" => \"Insertado correctamente!\")
      );

    }catch(QueryBuilderException $"."queryBuilderException){
        http_response_code(404);

        echo json_encode(
            array(\"error\" => $"."queryBuilderException->getMessage())
        );
    }
  }else{
    http_response_code(404);

    echo json_encode(
        array(\"error\" => \"Faltan campos en el JSON!!\")
    );
  }";
  return $content;
}

function getContentRead():string{
  return "
  try{
    $"."objects = "."$"."queryBuilder->findAllOrderBy($"."campo, $"."orden);

    $"."response = [];
    foreach ($"."objects as $"."object) {
      array_push($"."response, $"."object->toArrayToView());
    }

    http_response_code(200);

    echo json_encode($"."response);

  }catch(QueryBuilderException $"."queryBuilderException){
      http_response_code(404);

      echo json_encode(
          array(\"error\" => $"."queryBuilderException->getMessage())
      );
  }";
}

function getContentReadBy($snippets):string{
  return "
  try{
    $"."objects = "."$"."queryBuilder->findByOrderBy($"."campoWhere, $"."valor, $"."campo, $"."orden);

    $"."response = [];
    foreach ($"."objects as $"."object) {
      array_push($"."response, $"."object->toArrayToView());
    }

    http_response_code(200);

    echo json_encode($"."response);

  }catch(QueryBuilderException $"."queryBuilderException){
      http_response_code(404);

      echo json_encode(
          array(\"error\" => $"."queryBuilderException->getMessage())
      );
  }
  }else{
    http_response_code(404);

    echo json_encode(
        array(\"error\" => \"Falta el campo '".$snippets[0]->getCampo()."' en el JSON...\")
    );
  }";
}

function getContentUpdate():string{
  return "
  try{
    $"."queryBuilder->updateBy($"."array, $"."idName, $"."valorId);

    http_response_code(200);

    echo json_encode(
        array(\"message\" => \"Actualizado correctamente!\")
    );

  }catch(QueryBuilderException $"."queryBuilderException){
      http_response_code(404);

      echo json_encode(
          array(\"error\" => $"."queryBuilderException->getMessage())
      );
  }
  }else{
    http_response_code(404);

    echo json_encode(
        array(\"error\" => \"Faltan campos en el JSON...\")
    );
  }
  ";
}

function getContentDelete(){
  return "
  try{
    $"."queryBuilder->delete($"."idName, $"."valorId);

    http_response_code(200);

    echo json_encode(
        array(\"message\" => \"Eliminado correctamente!\")
    );

  }catch(QueryBuilderException $"."queryBuilderException){
      http_response_code(404);

      echo json_encode(
          array(\"error\" => $"."queryBuilderException->getMessage())
      );
  }";
}

function separarSnippetsDeId($snippets):array{
  $campos = [];
  $campos['id'] = [];
  $campos['snippets'] = [];
  foreach ($snippets as $snippet) {
    if($snippet->getAccion() === "IDActualizar"){
      array_push($campos['id'], $snippet->getCampo());
    }else{
      array_push($campos['snippets'], $snippet->getCampo());
    }
  }
  return $campos;
}

function getSnippetsFromDocus($docus, $qbs):array{
  $snippets = [];
  $idsDocus = [];
  foreach ($docus as $docu) {
    if(!in_array($docu->getId(),$idsDocus)){
      array_push($idsDocus, $docu->getId());
    }
  }

  foreach ($idsDocus as $id) {
    $snippets[strval($id)] = [];
    array_push($snippets[strval($id)], $qbs->findBy('docu', $id));
  }
  return $snippets;
}

?>
