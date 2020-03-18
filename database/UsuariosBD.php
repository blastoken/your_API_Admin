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
    public function comprobarLogin($email, $pass){
        $sql="SELECT * FROM $this->tabla WHERE email = :email AND password = :password";
        $pdoStatement=$this->connection->prepare($sql);
        $email = htmlspecialchars(strip_tags($email));
        $pass = htmlspecialchars(strip_tags($pass));
        $pdoStatement->bindParam(":email", $email);
        $pdoStatement->bindParam(":password", $pass);

        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido comprobar el inicio de sesión...");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            $this->classEntity);

    }

    /**
     * @return boolval
     * @throws QueryException
     */
    public function existeEmail($email){
        $sql="SELECT id FROM $this->tabla WHERE email = :email ";
        $pdoStatement=$this->connection->prepare($sql);
        $email = htmlspecialchars(strip_tags($email));
        $pdoStatement->bindParam(":email", $email);

        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido comprobar si tu email ya existe...");
        }
        $row = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($row){
          if(sizeof($row) > 0){
            return false;
          }
        }
        return true;
    }



    /**
     * @return boolval
     * @throws QueryException
     */
    public function cambioImagenPerfil($id, $img){
        $sql="UPDATE $this->tabla SET img = :img WHERE id = :id ";
        $pdoStatement=$this->connection->prepare($sql);
        $id = htmlspecialchars(strip_tags($id));
        $img = htmlspecialchars(strip_tags($img));
        $pdoStatement->bindParam(":id", $id);
        $pdoStatement->bindParam(":img", $img);

        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido cambiar la foto de perfil...");
        }
        return true;
    }

  }
