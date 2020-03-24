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

function hayCamposVacios($usuario){
  $errores = array();
  foreach($usuario as $campo => $valor){
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

?>
