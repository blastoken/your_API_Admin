<?php
class prova{
    /**
   * @var int
   */
   private $id;
   /**
   * @var string
   */
   private $rr;
   /**
   * @var int
   */
   private $rela;
   /**
   * @var string
   */
   private $nom;
   
  public function __construct($id=0,$rr="",$rela=0,$nom="")
  {
    $this->id = $id;
    $this->rr = $rr;
    $this->rela = $rela;
    $this->nom = $nom;
  }

  public function getid():int
  {
      return $this->id;
  }

  public function getrr():string
  {
      return $this->rr;
  }

  public function getrela():int
  {
      return $this->rela;
  }

  public function getnom():string
  {
      return $this->nom;
  }

  public function setid($id)
  {
      $this->id = $id;
  }

  public function setrr($rr)
  {
      $this->rr = $rr;
  }

  public function setrela($rela)
  {
      $this->rela = $rela;
  }

  public function setnom($nom)
  {
      $this->nom = $nom;
  }

  public function toArrayToView():array
  {
    return [
      'id'=>$this->getid(),
      'rr'=>$this->getrr(),
      'rela'=>$this->getrela(),
      'nom'=>$this->getnom()
    ];
  }

  public function toArray():array
  {
    return [
      'rr'=>$this->getrr(),
      'nom'=>$this->getnom()
    ];
  }

  public function setFromArray($array)
  {
    $this->id = $array['id'];
    $this->rr = $array['rr'];
    $this->rela = $array['rela'];
    $this->nom = $array['nom'];
    }

}