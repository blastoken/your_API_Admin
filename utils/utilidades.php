<?php
function validarCampos($usuario){
  $errores = hayCamposVacios($usuario);
  if($usuario['pass'] !== ""){

    if(!esUnaPassFuerte($usuario['pass'])){
      array_push($errores, "La contraseña debe contener mayúsculas y minúsculas");
    }

    if($usuario['pass2'] !== ""){
      if($usuario['pass'] !== $usuario['pass2']){
        array_push($errores, "Las contraseñas deben de coincidir");
      }
    }

  }

  if($usuario['usuario'] !== ""){
    if(strlen($usuario['usuario']) <= 10){
      array_push($errores, "El campo usuario debe ser mayor de 10 carácteres");
    }
  }else{
    array_push($errores, "El campo usuario no puede estar vacío");
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
  return true;
}

function hayCamposVacios($usuario){
  $errores = array();
  foreach($usuario as $campo => $valor){
    if($valor === ""){
      array_push($errores, "El campo ".$campo." no puede estar vacío");
    }
  }
  return $errores;
}

function getUsers(){
  $usuarios = [];
  $file = "files/usuarios.txt";
  if(file_exists($file)){
    $fichero = fopen($file,"r");
    while(!feof($fichero)){
      $linia = fgets($fichero);
      $atributes = explode(";", $linia);
      if($linia!=""){
        array_push($usuarios,
        array(
          'nombre' =>  $atributes[0],
          'apellidos' => $atributes[1],
          'usuario' => $atributes[2],
          'pass' =>  $atributes[3],
          'pass2' =>  $atributes[3])
        );
      }
    }
    fclose($fichero);
  }
  return $usuarios;
}

function comprobacionLogin($user, $pass){
  $usuarios = getUsers();
  foreach ($usuarios as $usuario) {
    if($user===$usuario['usuario']){
      if($pass===$usuario['pass']){
        return true;
      }
    }
  }
  return false;
}

function getUserByUsuario($usuario){
  $file = "files/usuarios.txt";
  if(file_exists($file)){
    $fichero = fopen($file,"r");
    while(!feof($fichero)){
      $linia = fgets($fichero);
      $atributes = explode(";", $linia);
      if($linia!=""){
        if($usuario===$atributes[2]){
          fclose($fichero);
          return array(
            'nombre' =>  $atributes[0],
            'apellidos' => $atributes[1],
            'usuario' => $atributes[2],
            'pass' =>  $atributes[3],
            'pass2' =>  $atributes[3]
          );
        }
      }
    }
    fclose($fichero);
  }
  return [];
}

function signupUser($usuario){
  $file = "files/usuarios.txt";
  if(file_exists($file)){
    $fichero = fopen($file,"a");
  }else{
    $fichero = fopen($file,"w");
  }
  if(sizeof(getUserByUsuario($usuario)) == 0){
    $linia = $usuario['nombre'].";".$usuario['apellidos'].";".$usuario['usuario'].";".$usuario['pass'].";";
    fwrite($fichero,$linia."\n");
  }else{
    return false;
  }
  fclose($fichero);
  return true;
}

function validarFichero($fichero){
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

?>
