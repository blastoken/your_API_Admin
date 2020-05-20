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
      try{
        $nombbdd = htmlspecialchars(strip_tags($nombbdd));
        $sql="
        CREATE DATABASE ".$nombbdd." ;
        ALTER DATABASE ".$nombbdd." CHARACTER SET = utf8 COLLATE = utf8_spanish_ci;
        ";
        $pdoStatement=$this->connection->prepare($sql);
        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido crear la Base de Datos...");
        }
        return true;
      }catch(PDOException $e){
        echo $e;
      }
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

    public function getAllTablesAndColumnsFromDB($nombbdd){
      $sql="SELECT COLUMN_NAME as 'nombre', TABLE_NAME AS 'tabla', DATA_TYPE as 'tipo',
            CASE DATA_TYPE
            WHEN 'varchar' THEN CHARACTER_MAXIMUM_LENGTH
            WHEN 'int' THEN (NUMERIC_PRECISION+1)
            WHEN 'double' THEN CONCAT(NUMERIC_PRECISION,'.',NUMERIC_SCALE)
            ELSE ''
            END as 'length', EXTRA AS 'extra', COLUMN_KEY AS 'indice'
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = :nombbdd AND TABLE_NAME NOT IN (
              SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='VIEW' AND TABLE_SCHEMA = :nombbdd2
            );";
      $pdoStatement=$this->connection->prepare($sql);
      $nombbdd = htmlspecialchars(strip_tags($nombbdd));
      $nombbdd2 = $nombbdd;
      $pdoStatement->bindParam(":nombbdd", $nombbdd);
      $pdoStatement->bindParam(":nombbdd2", $nombbdd2);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se han podido leer las tablas de la Base de Datos...");
      }
      return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ColumnaTabla");
    }

    public function getAllViewsColumnsFromDB($nombbdd){
      $sql="SELECT COLUMN_NAME as 'nombre', TABLE_NAME AS 'tabla', DATA_TYPE as 'tipo',
            CASE DATA_TYPE
            WHEN 'varchar' THEN CHARACTER_MAXIMUM_LENGTH
            WHEN 'int' THEN (NUMERIC_PRECISION+1)
            WHEN 'double' THEN CONCAT(NUMERIC_PRECISION,'.',NUMERIC_SCALE)
            ELSE ''
            END as 'length', EXTRA AS 'extra', COLUMN_KEY AS 'indice'
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = :nombbdd AND TABLE_NAME IN (
              SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='VIEW' AND TABLE_SCHEMA = :nombbdd2
            );";
      $pdoStatement=$this->connection->prepare($sql);
      $nombbdd = htmlspecialchars(strip_tags($nombbdd));
      $nombbdd2 = $nombbdd;
      $pdoStatement->bindParam(":nombbdd", $nombbdd);
      $pdoStatement->bindParam(":nombbdd2", $nombbdd2);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se han podido leer las vistas de la Base de Datos...");
      }
      return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ColumnaTabla");
    }

    public function getAllColumnsFromTable($nombbdd, $nomTaula){
      $sql="SELECT COLUMN_NAME as 'nombre', TABLE_NAME AS 'tabla', DATA_TYPE as 'tipo',
            CASE DATA_TYPE
            WHEN 'varchar' THEN CHARACTER_MAXIMUM_LENGTH
            WHEN 'int' THEN (NUMERIC_PRECISION+1)
            WHEN 'double' THEN CONCAT(NUMERIC_PRECISION,'.',NUMERIC_SCALE)
            ELSE ''
            END as 'length', EXTRA AS 'extra', COLUMN_KEY AS 'indice'
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = :nombbdd AND TABLE_NAME = '".$nomTaula."';";
      $pdoStatement=$this->connection->prepare($sql);
      $nombbdd = htmlspecialchars(strip_tags($nombbdd));
      $pdoStatement->bindParam(":nombbdd", $nombbdd);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se han podido leer las tablas de la Base de Datos...");
      }
      return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "ColumnaTabla");
    }

    public function deleteTable($nomTaula){
      $sql="DROP TABLE IF EXISTS ".$nomTaula.";";
      $pdoStatement=$this->connection->prepare($sql);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se ha podido crear el usuario de la Base de Datos...");
      }
      return true;
    }

    public function getAllIndexesFromDB($nombbdd){
      $sql="SELECT DISTINCT
              TABLE_NAME AS 'tabla',
              COLUMN_NAME AS 'columna',
              CONSTRAINT_NAME AS 'nombre',
              REFERENCED_TABLE_NAME AS 'tablaRef',
              REFERENCED_COLUMN_NAME AS 'columnaRef'
            FROM
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE
            	REFERENCED_TABLE_SCHEMA = :nombbdd;";
      $pdoStatement=$this->connection->prepare($sql);
      $nombbdd = htmlspecialchars(strip_tags($nombbdd));
      $pdoStatement->bindParam(":nombbdd", $nombbdd);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se han podido leer los índices de la Base de Datos...");
      }
      return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Index");
    }

    public function getAllIndexesFromTable($nombbdd, $nomTaula){
      $sql="SELECT
              TABLE_NAME AS 'tabla',
              COLUMN_NAME AS 'columna',
              CONSTRAINT_NAME AS 'nombre',
              REFERENCED_TABLE_NAME AS 'tablaRef',
              REFERENCED_COLUMN_NAME AS 'columnaRef'
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE REFERENCED_TABLE_SCHEMA = :nombbdd AND TABLE_NAME = :nomTaula;";
      $pdoStatement=$this->connection->prepare($sql);
      $nombbdd = htmlspecialchars(strip_tags($nombbdd));
      $nombbdd = htmlspecialchars(strip_tags($nomTaula));
      $pdoStatement->bindParam(":nombbdd", $nombbdd);
      $pdoStatement->bindParam(":nomTaula", $nomTaula);

      if($pdoStatement->execute()===false){
          throw new QueryBuilderException("No se han podido leer los índices de la Tabla ".$nomTaula."...");
      }
      return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Index");
    }

    /**
     * @return array
     * @throws QueryBuilderException
     */
    public function findViewByBBDDAndTable($bbdd, $tabla):array{
        $sql="SELECT * FROM vistas WHERE bbdd = :bbdd AND tabla = :tabla";
        $pdoStatement=$this->connection->prepare($sql);
        $nombbdd = htmlspecialchars(strip_tags($bbdd));
        $pdoStatement->bindParam(":bbdd", $bbdd);
        $nombbdd = htmlspecialchars(strip_tags($tabla));
        $pdoStatement->bindParam(":tabla", $tabla);
        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido ejecutar la Query");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Vista');

    }

    /**
     * @return array
     * @throws QueryBuilderException
     */
    public function findViewsByBBDD($bbdd):array{
        $sql="SELECT * FROM vistas WHERE bbdd = :bbdd";
        $pdoStatement=$this->connection->prepare($sql);
        $nombbdd = htmlspecialchars(strip_tags($bbdd));
        $pdoStatement->bindParam(":bbdd", $bbdd);
        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido ejecutar la Query");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Vista');

    }

  }
