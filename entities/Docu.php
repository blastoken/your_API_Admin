<?php


class Docu
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $api;
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
    private $vista;
    /**
     * @var string
     */
    private $accion;

    public function __construct($id=0, $api=0, $nombre="", $tabla="", $vista="", $accion="")
    {
        $this->id = $id;
        $this->api = $api;
        $this->nombre = $nombre;
        $this->tabla = $tabla;
        $this->vista = $vista;
        $this->accion = $accion;
    }

        public function getId():int
        {
          return $this->id;
        }

        public function getApi():int
        {
          return $this->api;
        }

        public function getNombre():string
        {
          return $this->nombre;
        }

        public function getTabla():string
        {
          return $this->tabla;
        }

        public function getVista():string
        {
          return $this->vista;
        }

        public function getAccion():string
        {
          return $this->accion;
        }

        public function setId($id)
        {
          $this->id = $id;
        }

        public function setApi($api)
        {
          $this->api = $api;
        }

        public function setNombre($nombre)
        {
          $this->nombre = $nombre;
        }

        public function setTabla($tabla)
        {
          $this->tabla = $tabla;
        }

        public function setVista($vista)
        {
          $this->vista = $vista;
        }

        public function setAccion($accion)
        {
          $this->accion = $accion;
        }

        public function toArray():array{
          return [
            'api'=>$this->getApi(),
            'nombre'=>$this->getNombre(),
            'tabla'=>$this->getTabla(),
            'vista'=>$this->getVista(),
            'accion'=>$this->getAccion()
          ];
        }

        public function toFullArray():array{
          return [
            'id'=>$this->getId(),
            'api'=>$this->getApi(),
            'nombre'=>$this->getNombre(),
            'tabla'=>$this->getTabla(),
            'vista'=>$this->getVista(),
            'accion'=>$this->getAccion()
          ];
        }


}
