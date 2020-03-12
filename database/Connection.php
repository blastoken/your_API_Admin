<?php


class Connection
{
    public static function make($config){
        try{
            $connection=new PDO(
                $config['connection'] . '; dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
            /*CONEXION DE CLASE PARA BORRAR$connection=new PDO(
                $config['connection'] . '; dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );*/

            /* CONEXION ANTIGUA
             * $connection=new PDO(
                'mysql:host=iaw.localhost;dbname=comercial',
                'comercial',
                'comercial'
            );*/
        }
        catch(PDOException $PDOException) {
            die($PDOException->getMessage());
        }
        return $connection;
    }



}
