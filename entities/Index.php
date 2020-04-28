<?php


class Index
{
    /**
     * @var string
     */
    private $tabla;
    /**
     * @var string
     */
    private $columna;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $tablaRef;
    /**
     * @var string
     */
    private $columnaRef;

    public function __construct($tabla="", $columna="",$nombre="1.0", $tablaRef="", $columnaRef="")
    {
        $this->tabla = $tabla;
        $this->columna = $columna;
        $this->nombre = $nombre;
        $this->tablaRef = $tablaRef;
        $this->columnaRef = $columnaRef;
    }

        public function getTabla():string
        {
          return $this->tabla;
        }

        public function getColumna():string
        {
          return $this->columna;
        }

        public function getNombre():string
        {
          return $this->nombre;
        }

        public function getTablaRef():string
        {
          return $this->tablaRef;
        }

        public function getColumnaRef():string
        {
          return $this->columnaRef;
        }

        public function setTabla($tabla)
        {
          $this->tabla = $tabla;
        }

        public function setColumna($columna)
        {
          $this->columna = $columna;
        }

        public function setNombre($nombre)
        {
          $this->nombre = $nombre;
        }

        public function setTablaRef($tablaRef)
        {
          $this->tablaRef = $tablaRef;
        }

        public function setColumnaRef($columnaRef)
        {
          $this->columnaRef = $columnaRef;
        }

        public function toArray():array
        {
          return [
            'columna'=>$this->getColumna(),
            'nombre'=>$this->getNombre(),
            'tablaRef'=>$this->getTablaRef(),
            'columnaRef'=>$this->getColumnaRef()
          ];
        }

}
