<?php


class Columns
{
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $tabla;
    /**
     * @var string
     */
    private $tipo;

    public function __construct($nombre="", $tabla="", $tipo="")
    {
        $this->nombre = $nombre;
        $this->tabla = $tabla;
        $this->tipo = $tipo;
    }

        public function getNombre():string
        {
          return $this->nombre;
        }

        public function getTabla():string
        {
          return $this->tabla;
        }

        public function getTipo():string
        {
          return $this->tipo;
        }

        public function setNombre($nombre)
        {
          $this->nombre = $nombre;
        }

        public function setTabla($tabla)
        {
          $this->tabla = $tabla;
        }

        public function setTipo($tipo)
        {
          $this->tipo = $tipo;
        }

        public function toArray():array
        {
          return [
            'nombre'=>$this->getNombre(),
            'tabla'=>$this->getTabla(),
            'tipo'=>$this->getTipo()
          ];
        }


}
