<?php
require_once __DIR__ . '/../exceptions/QueryBuilderException.php';

class UsuariosBD
{
    /**
     * @var PDO
     */
    private $connection;
    /**
     * @var string
     */
    private $tabla = "usuarios";
    /**
     * @var string
     */
    private $classEntity = "Usuario";

    public function __construct(PDO $connection){
        $this->connection=$connection;
    }

    /**
     * @return array
     * @throws QueryException
     */
    public function comprobarLogin($user, $pass){
        $sql="SELECT * FROM $this->tabla WHERE user = :user AND password = :password";
        $pdoStatement=$this->connection->prepare($sql);
        $user = htmlspecialchars(strip_tags($user));
        $pass = htmlspecialchars(strip_tags($pass));
        $pdoStatement->bindParam(":user", $user);
        $pdoStatement->bindParam(":password", $pass);

        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido comprobar el inicio de sesión...");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            $this->classEntity);

    }

  }
