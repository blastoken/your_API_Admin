<?php


class Snippet
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $docu;
    /**
     * @var string
     */
    private $accion;
    /**
     * @var string
     */
    private $campo;
    /**
     * @var string
     */
    private $modo;

    public function __construct($id=0, $docu=0,  $accion="", $campo="", $modo="")
    {
        $this->id = $id;
        $this->docu = $docu;
        $this->accion = $accion;
        $this->campo = $campo;
        $this->modo = $modo;
    }

        public function getId():int
        {
          return $this->id;
        }

        public function getDocu():int
        {
          return $this->docu;
        }

        public function getAccion():string
        {
          return $this->accion;
        }

        public function getCampo():string
        {
          return $this->campo;
        }

        public function getModo():string
        {
          return $this->modo;
        }

        public function setId($id)
        {
          $this->id = $id;
        }

        public function setDocu($docu)
        {
          $this->docu = $docu;
        }

        public function setAccion($accion)
        {
          $this->accion = $accion;
        }

        public function setCampo($campo)
        {
          $this->campo = $campo;
        }

        public function setModo($modo)
        {
          $this->modo = $modo;
        }

        public function toArray():array{
          return [
            'docu'=>$this->getDocu(),
            'accion'=>$this->getAccion(),
            'campo'=>$this->getCampo(),
            'modo'=>$this->getModo()
          ];
        }

        public function toFullArray():array{
          return [
            'id'=>$this->getId(),
            'docu'=>$this->getDocu(),
            'accion'=>$this->getAccion(),
            'campo'=>$this->getCampo(),
            'modo'=>$this->getModo()
          ];
        }


}
