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

  public function __construct($id=0,$nom="",$apellidos="")
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->apellidos = $apellidos;
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

  public function setFromArray($array)
  {
    $this->id = $array['id'];
    $this->nom = $array['nom'];
    $this->apellidos = $array['apellidos'];
  }

  public function toArrayToView():array
  {
    return [
      'id'=>$this->getid(),
      'nom'=>$this->getnom(),
      'apellidos'=>$this->getapellidos()
    ];
  }

  public function toArray():array
  {
    return [
      'nom'=>$this->getnom(),
      'apellidos'=>$this->getapellidos()
    ];
  }

}
