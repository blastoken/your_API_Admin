<?php
require_once __DIR__ . '/../exceptions/QueryBuilderException.php';

class QueryBuilder
{
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
     * @throws QueryException
     */
    public function comprobarLogin():array{
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
     * @throws QueryException
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

     public function delete($id){
         try{
             $sql = "DELETE FROM ".$this->tabla." WHERE id = ".$id;

             $pdoStatement=$this->connection->prepare($sql);

             $pdoStatement->execute();

         }catch(PDOException $exception){
             throw new QueryBuilderException('Error al eliminar ' . $sql);
         }
     }

     public function update($entity){
         try{
             $sql = "UPDATE ".$this->tabla." SET titulo = '".$entity->getTitulo()."', texto = '".$entity->getTexto()."', img = '".$entity->getImg()."' WHERE id = ".$entity->getId();

             $pdoStatement=$this->connection->prepare($sql);

             $pdoStatement->execute();

         }catch(PDOException $exception){
             throw new QueryBuilderException('Error al actualizar ' . $sql);
         }
     }
}
