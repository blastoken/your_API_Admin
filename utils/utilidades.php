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

function crearEntidad($bd, $nomTaula, $columnas){
  $ruta = "entities/".$bd;
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
      $content .= "$"."this->".$columna->getNombre()." = $"."array[".$columna->getNombre()."];
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
?>
