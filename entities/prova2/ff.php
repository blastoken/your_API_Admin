<?php
class ff{
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
   
  public function __construct($id=0,$rr="",$rela=0)
  {
    $this->id = $id;
    $this->rr = $rr;
    $this->rela = $rela;
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

  public function toArrayToView():array
  {
    return [
      'id'=>$this->getid(),
      'rr'=>$this->getrr(),
      'rela'=>$this->getrela()
    ];
  }

  public function toArray():array
  {
    return [
      'rr'=>$this->getrr(),
      'rela'=>$this->getrela()
    ];
  }

  public function setFromArray($array)
  {
    $this->id = $array[id];
    $this->rr = $array[rr];
    $this->rela = $array[rela];
    }

}