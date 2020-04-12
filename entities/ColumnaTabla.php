<?php


class ColumnaTabla
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
    private $length;
    /**
     * @var string
     */
    private $tipo;
    /**
     * @var string
     */
    private $extra;
    /**
     * @var string
     */
    private $indice;

    public function __construct($nombre="", $tabla="",$length="1.0", $tipo="", $extra="", $indice="")
    {
        $this->nombre = $nombre;
        $this->tabla = $tabla;
        $this->length = $length;
        $this->tipo = $tipo;
        $this->extra = $extra;
        $this->indice = $indice;
    }

        public function getNombre():string
        {
          return $this->nombre;
        }

        public function getTabla():string
        {
          return $this->tabla;
        }

        public function getLength():string
        {
          return $this->length;
        }

        public function getTipo():string
        {
          return $this->tipo;
        }

        public function getExtra():string
        {
          return $this->extra;
        }

        public function getIndice():string
        {
          return $this->indice;
        }

        public function setNombre($nombre)
        {
          $this->nombre = $nombre;
        }

        public function setTabla($tabla)
        {
          $this->tabla = $tabla;
        }

        public function setLength($length)
        {
          $this->length = $length;
        }

        public function setTipo($tipo)
        {
          $this->tipo = $tipo;
        }

        public function setExtra($extra)
        {
          $this->extra = $extra;
        }

        public function setIndicie($indice)
        {
          $this->indice = $indice;
        }

        public function toStringLength():string
        {
          switch($this->tipo){
            case "double":
              return "(".number_format((float) filter_var( $this->getLength(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),1,',','').")";
            break;
            case "int":
              return "(".((int)$this->getLength()).")";
            break;
            case "varchar":
              return "(".((int)$this->getLength()).")";
            break;
            case "tinyint":
              return "(4)";
            break;
            default:
              return $this->getLength();
            break;
          }
        }

        public function toColumnString():string
        {
          $linea_insert = $this->getNombre()." ".strtoupper($this->getTipo());
          switch($this->getTipo()){
            case "int":
              $linea_insert.= "(".((int)$this->getLength()).")";
            break;
            case "tinyint":
              $linea_insert.= "(4)";
            break;
            case "double":
              $linea_insert.= "(".number_format((float) filter_var( $this->getLength(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),1,',','').")";
            break;
            case "varchar":
              $linea_insert.= "(".((int)$this->getLength()).")";
            break;
          }
          if($this->getExtra() !== ""){
            $linea_insert .= " ".$this->getExtra();
          }

          if($this->getIndice() !== ""){
            if($this->getTipo() === "int"){
                $linea_insert .= " AUTO_INCREMENT";
            }
            $linea_insert .= " ".$this->getIndice();
          }
          return $linea_insert;
        }

        public function toArray():array
        {
          return [
            'nombre'=>$this->getNombre(),
            'length'=>$this->getLength(),
            'tipo'=>$this->getTipo()
          ];
        }

}
