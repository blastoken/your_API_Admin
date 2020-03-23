<?php
require_once __DIR__ . '/../exceptions/QueryBuilderException.php';

class BaseDatosBD
{
    /**
     * @var PDO
     */
    private $connection;
    /**
     * @var string
     */
    private $tabla = "bbdd";
    /**
     * @var string
     */
    private $classEntity = "BBDD";

    public function __construct(PDO $connection){
        $this->connection=$connection;
    }

    /**
     * @return boolval
     * @throws QueryException
     */
    public function existeDB($nombre){
        $sql="SELECT id FROM $this->tabla WHERE nombre = :nombre ";
        $pdoStatement=$this->connection->prepare($sql);
        $nombre = htmlspecialchars(strip_tags($nombre));
        $pdoStatement->bindParam(":nombre", $nombre);

        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido comprobar si el nombre de la Base de Datos ya existe...");
        }
        $row = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($row){
          if(sizeof($row) > 0){
            return false;
          }
        }
        return true;
    }

  }
