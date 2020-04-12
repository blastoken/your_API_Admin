<?php
require_once __DIR__ . '/../exceptions/QueryBuilderException.php';

class RootTable
{
    /**
     * @var PDO
     */
    private $connection;

    public function __construct(PDO $connection){
        $this->connection=$connection;
    }

    public function createTable($nomTaula,$columnas){
      $sql="CREATE TABLE ".$nomTaula." ( ".$columnas[0]->toColumnString();
      for ($i=1; $i < sizeof($columnas); $i++) {
        $sql .=", ".$columnas[$i]->toColumnString();
      }
      $sql .=");";
      var_dump($sql);
      $pdoStatement=$this->connection->prepare($sql);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se ha podido crear la tabla de la Base de Datos...");
      }
      return true;
    }

  }
