<?php


class Usuario
{
    const RUTA_IMAGENES_PERFIL='imgs/perfil/';
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $apellidos;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $img;
    /**
     * @var string
     */
    private $registro;

    public function __construct($id=0, $nombre="", $apellidos="", $email="", $password="", $img="", $registro="")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->img = $img;
        $this->registro = $registro;
    }

        public function getId():int
        {
          return $this->id;
        }

        public function getNombre():string
        {
          return $this->nombre;
        }

        public function getApellidos():string
        {
          return $this->apellidos;
        }

        public function getEmail():string
        {
          return $this->email;
        }

        public function getPassword():string
        {
          return $this->password;
        }

        public function getImg():string
        {
          return $this->img;
        }

        public function getRutaImg():string
        {
          return self::RUTA_IMAGENES_PERFIL . $this->getImg();
        }

        public function getRegistro():string
        {
          return $this->registro;
        }

        public function setId($id)
        {
          $this->id = $id;
        }

        public function setNombre($nombre)
        {
          $this->nombre = $nombre;
        }

        public function setApellidos($apellidos)
        {
          $this->apellidos = $apellidos;
        }

        public function setEmail($email)
        {
          $this->email = $email;
        }

        public function setPassword($password)
        {
          $this->password = $password;
        }

        public function setImg($img)
        {
          $this->img = $img;
        }

        public function setRegistro($registro)
        {
          $this->registro = $registro;
        }

        public function toArray():array
        {
          return [
            'nombre'=>$this->getNombre(),
            'apellidos'=>$this->getApellidos(),
            'email'=>$this->getEmail(),
            'password'=>$this->getPassword(),
            'img'=>$this->getImg(),
            'registro'=>$this->getRegistro()
          ];
        }


}
