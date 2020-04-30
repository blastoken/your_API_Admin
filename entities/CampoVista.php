<?php


class CampoVista
{
    /**
     * @var string
     */
    private $tabla;
    /**
     * @var string
     */
    private $campo;
    /**
     * @var string
     */
    private $alias;

    public function __construct($tabla="", $campo="",$alias="")
    {
        $this->tabla = $tabla;
        $this->campo = $campo;
        $this->alias = $alias;
    }

        public function getTabla():string
        {
          return $this->tabla;
        }

        public function getCampo():string
        {
          return $this->campo;
        }

        public function getAlias():string
        {
          return $this->alias;
        }

        public function setTabla($tabla)
        {
          $this->tabla = $tabla;
        }

        public function setCampo($campo)
        {
          $this->campo = $campo;
        }

        public function setAlias($alias)
        {
          $this->alias = $alias;
        }

        public function toArray():array
        {
          return [
            'tabla'=>$this->getTabla(),
            'campo'=>$this->getCampo(),
            'alias'=>$this->getAlias()
          ];
        }

}
