<?php


class Vista
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $bbdd;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $tabla;

    public function __construct($id=0, $bbdd="", $nombre="", $tabla="")
    {
        $this->id = $id;
        $this->bbdd = $bbdd;
        $this->nombre = $nombre;
        $this->tabla = $tabla;
    }

        public function getId():int
        {
          return $this->id;
        }

        public function getBbdd():string
        {
          return $this->bbdd;
        }

        public function getNombre():string
        {
          return $this->nombre;
        }

        public function getTabla():string
        {
          return $this->tabla;
        }

        public function setId($id)
        {
          $this->id = $id;
        }

        public function setBbdd($bbdd)
        {
          $this->bbdd = $bbdd;
        }

        public function setNombre($nombre)
        {
          $this->nombre = $nombre;
        }

        public function setTabla($tabla)
        {
          $this->tabla = $tabla;
        }

        public function toArray():array
        {
          return [
            'bbdd'=>$this->getBbdd(),
            'nombre'=>$this->getNombre(),
            'tabla'=>$this->getTabla()
          ];
        }

}
