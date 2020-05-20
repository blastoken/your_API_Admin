<?php
require_once __DIR__ . '/../exceptions/QueryBuilderException.php';

class QueryBuilder{
    /**
     * @var PDO
     */
    private $connection;
    /**
     * @var string
     */
    private $tabla;
    /**
     * @var string
     */
    private $classEntity;

    public function __construct(PDO $connection,string $tabla, string $classEntity){
        $this->connection=$connection;
        $this->tabla=$tabla;
        $this->classEntity=$classEntity;
    }

    /**
     * @return array
     * @throws QueryBuilderException
     */
    public function findAll():array{
        $sql="SELECT * FROM $this->tabla";
        $pdoStatement=$this->connection->prepare($sql);
        if($pdoStatement->execute()===false){
            throw new QueryBuilderException("No se ha podido ejecutar la Query");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            $this->classEntity);

    }

    /**
     * @return array
     * @throws QueryBuilderException
     */
     public function findAllOrderBy($campo, $orden):array{
         $sql="SELECT * FROM $this->tabla ORDER BY $campo $orden;";
         $pdoStatement=$this->connection->prepare($sql);
         if($pdoStatement->execute()===false){
             throw new QueryBuilderException("No se ha podido ejecutar la Query");
         }
         return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
             $this->classEntity);

     }

    /**
     * @param $entity
     * @throws QueryException
     */
    public function save($entity){
        try{
            $parameters=$entity->toArray();
            $sql=sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
            $this->tabla,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
            );

            $pdoStatement=$this->connection->prepare($sql);
            $pdoStatement->execute($parameters);
        }catch(PDOException $exception){
            throw new QueryBuilderException('Error al insertar ' . $sql);
        }
    }

    /**
     * @param $entity
     * @throws QueryBuilderException
     */
    public function update($entity, $nomId, $valorId){
        try{
            $parameters=$entity->toArray();
            $update=[];
            foreach ($parameters as $key=>$valor){
                $update[] = "$key = :$key";
            }
            $sql=sprintf(
                'UPDATE %s SET %s WHERE %s=%s',
                $this->tabla,
                implode(',', $update),
                $nomId,
                $valorId
            );
            $pdoStatement=$this->connection->prepare($sql);
            $pdoStatement->execute($parameters);
        }catch(PDOException $exception){
            throw new QueryBuilderException('Error al modificar ' . $sql);
        }
    }

    /**
     * @param $entity
     * @throws QueryBuilderException
     */
    public function updateBy($array, $nomId, $valorId){
        try{
            $parameters=$array;
            $update=[];
            foreach ($parameters as $key=>$valor){
                $update[] = "$key = :$key";
            }
            $sql=sprintf(
                'UPDATE %s SET %s WHERE %s=%s',
                $this->tabla,
                implode(',', $update),
                $nomId,
                $valorId
            );
            $pdoStatement=$this->connection->prepare($sql);
            $pdoStatement->execute($parameters);
        }catch(PDOException $exception){
            throw new QueryBuilderException('Error al modificar ' . $sql);
        }
    }

    /**
     * @param $entity
     * @throws QueryBuilderException
     */
    public function delete($nomId,$valorId){
        try{
            //$parameters=$entity->toArray();
            $sql=sprintf(
                'DELETE FROM %s WHERE %s=%s',
                $this->tabla,
                $nomId,
                $valorId
            );
            $pdoStatement=$this->connection->prepare($sql);
            $pdoStatement->execute(/*$parameters*/);
        }catch(PDOException $exception){
            throw new QueryBuilderException('Error al borrar ' . $sql);
        }
    }

    /**
     * @param $id
     * @return array
     * @throws QueryBuilderException
     */
    public function findById($id){
        $sql="SELECT * FROM $this->tabla WHERE id=$id";
        $pdoStatement=$this->connection->prepare($sql);
        if ($pdoStatement->execute()===false)
            throw new QueryBuilderException("No se ha podido ejecutar la query");
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity)[0];
    }

    /**
     * @return array
     * @throws QueryBuilderException
     */
    public function findBy($nomcamp, $valorcamp){
        $sql="SELECT * FROM $this->tabla WHERE $nomcamp = :valorcamp";
        $pdoStatement=$this->connection->prepare($sql);
        $passbbdd = htmlspecialchars(strip_tags($valorcamp));
        $pdoStatement->bindParam(":valorcamp", $valorcamp);
        if ($pdoStatement->execute()===false)
            throw new QueryBuilderException("No se ha podido ejecutar la query");
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    /**
     * @return array
     * @throws QueryBuilderException
     */
    public function findByOrderBy($nomcamp, $valorcamp, $campo, $orden){
        $sql="SELECT * FROM $this->tabla WHERE $nomcamp = $valorcamp ORDER BY $campo $orden;";
        $pdoStatement=$this->connection->prepare($sql);
        if ($pdoStatement->execute()===false)
            throw new QueryBuilderException("No se ha podido ejecutar la query");
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

}
