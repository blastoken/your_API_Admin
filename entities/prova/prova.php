<?php
class prova{
    /**
   * @var int
   */
   private $id;
   /**
   * @var string
   */
   private $nom;
   /**
   * @var string
   */
   private $apellidos;
   /**
   * @var string
   */
   private $fecha;
   /**
   * @var string
   */
   private $yep;
   
  public function __construct($id=0,$nom="",$apellidos="",$fecha="",$yep="")
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->apellidos = $apellidos;
    $this->fecha = $fecha;
    $this->yep = $yep;
  }

  public function getid():int
  {
      return $this->id;
  }

  public function getnom():string
  {
      return $this->nom;
  }

  public function getapellidos():string
  {
      return $this->apellidos;
  }

  public function getfecha():string
  {
      return $this->fecha;
  }

  public function getyep():string
  {
      return $this->yep;
  }

  public function setid($id)
  {
      $this->id = $id;
  }

  public function setnom($nom)
  {
      $this->nom = $nom;
  }

  public function setapellidos($apellidos)
  {
      $this->apellidos = $apellidos;
  }

  public function setfecha($fecha)
  {
      $this->fecha = $fecha;
  }

  public function setyep($yep)
  {
      $this->yep = $yep;
  }

  public function toArrayToView():array
  {
    return [
      'id'=>$this->getid(),
      'nom'=>$this->getnom(),
      'apellidos'=>$this->getapellidos(),
      'fecha'=>$this->getfecha(),
      'yep'=>$this->getyep()
    ];
  }

  public function toArray():array
  {
    return [
      'nom'=>$this->getnom(),
      'apellidos'=>$this->getapellidos(),
      'fecha'=>$this->getfecha(),
      'yep'=>$this->getyep()
    ];
  }

  public function setFromArray($array)
  {
    $this->id = $array[id];
    $this->nom = $array[nom];
    $this->apellidos = $array[apellidos];
    $this->fecha = $array[fecha];
    $this->yep = $array[yep];
    }

}