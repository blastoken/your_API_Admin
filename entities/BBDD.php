<?php


class BBDD
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $admin;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $usuario;
    /**
     * @var string
     */
    private $pass;

    public function __construct($id=0, $admin=0, $nombre="", $usuario="", $pass="")
    {
        $this->id = $id;
        $this->admin = $admin;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->pass = $pass;
    }

        public function getId():int
        {
          return $this->id;
        }

        public function getAdmin():int
        {
          return $this->admin;
        }

        public function getNombre():string
        {
          return $this->nombre;
        }

        public function getUsuario():string
        {
          return $this->usuario;
        }

        public function getPass():string
        {
          return $this->pass;
        }

        public function setId($id)
        {
          $this->id = $id;
        }

        public function setAdmin($admin)
        {
          $this->admin = $admin;
        }

        public function setNombre($nombre)
        {
          $this->nombre = $nombre;
        }

        public function setUsuario($usuario)
        {
          $this->usuario = $usuario;
        }

        public function setPass($pass)
        {
          $this->pass = $pass;
        }

        public function toArray():array{
          return [
            'admin'=>$this->getAdmin(),
            'nombre'=>$this->getNombre(),
            'usuario'=>$this->getUsuario(),
            'pass'=>$this->getPass()
          ];
        }


}
