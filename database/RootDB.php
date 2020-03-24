<?php
require_once __DIR__ . '/../exceptions/QueryBuilderException.php';

class RootDB
{
    /**
     * @var PDO
     */
    private $connection;

    public function __construct(PDO $connection){
        $this->connection=$connection;
    }

    /**
     * @return boolval
     * @throws QueryException
     */
    public function createDB($nombbdd){
    $nombbdd =preg_replace("/[^A-Za-z0-9?! ]/",'',htmlspecialchars(strip_tags($nombbdd)));
      $sql="CREATE DATABASE IF NOT EXISTS ".$nombbdd."; ALTER DATABASE ".$nombbdd." CHARACTER SET = utf8 COLLATE = utf8_spanish_ci;";
      $pdoStatement=$this->connection->prepare($sql);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se ha podido crear la Base de Datos...");
      }
      return true;
    }

    public function createUserDB($userbbdd,$passbbdd){
      $sql="CREATE USER :userbbdd IDENTIFIED BY :passbbdd";
      $pdoStatement=$this->connection->prepare($sql);
      $userbbdd = htmlspecialchars(strip_tags($userbbdd));
      $passbbdd = htmlspecialchars(strip_tags($passbbdd));
      $pdoStatement->bindParam(":userbbdd", $userbbdd);
      $pdoStatement->bindParam(":passbbdd", $passbbdd);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se ha podido crear el usuario de la Base de Datos...");
      }
      return true;
    }

    public function grantUserDB($nombbdd,$userbbdd){
    $nombbdd = htmlspecialchars(strip_tags($nombbdd));
    $userbbdd = htmlspecialchars(strip_tags($userbbdd));
      $sql="GRANT ALL PRIVILEGES ON ".$nombbdd.".* TO ".$userbbdd;
      $pdoStatement=$this->connection->prepare($sql);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se ha podido añadir los privilegios al usuario...");
      }
      return true;
    }

  }
