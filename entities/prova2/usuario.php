<?php
class usuario{
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
   private $descripcion;
   
  public function __construct($id=0,$nombre="",$apellidos="",$descripcion="")
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellidos = $apellidos;
    $this->descripcion = $descripcion;
  }

  public function getid():int
  {
      return $this->id;
  }

  public function getnombre():string
  {
      return $this->nombre;
  }

  public function getapellidos():string
  {
      return $this->apellidos;
  }

  public function getdescripcion():string
  {
      return $this->descripcion;
  }

  public function setid($id)
  {
      $this->id = $id;
  }

  public function setnombre($nombre)
  {
      $this->nombre = $nombre;
  }

  public function setapellidos($apellidos)
  {
      $this->apellidos = $apellidos;
  }

  public function setdescripcion($descripcion)
  {
      $this->descripcion = $descripcion;
  }

  public function toArrayToView():array
  {
    return [
      'id'=>$this->getid(),
      'nombre'=>$this->getnombre(),
      'apellidos'=>$this->getapellidos(),
      'descripcion'=>$this->getdescripcion()
    ];
  }

  public function toArray():array
  {
    return [
      'nombre'=>$this->getnombre(),
      'apellidos'=>$this->getapellidos(),
      'descripcion'=>$this->getdescripcion()
    ];
  }

  public function setFromArray($array)
  {
    $this->id = $array[id];
    $this->nombre = $array[nombre];
    $this->apellidos = $array[apellidos];
    $this->descripcion = $array[descripcion];
    }

}