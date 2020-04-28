<?php
class dd{
    /**
   * @var int
   */
   private $d;
   /**
   * @var int
   */
   private $s;
   /**
   * @var string
   */
   private $f;
   
  public function __construct($d=0,$s=0,$f="")
  {
    $this->d = $d;
    $this->s = $s;
    $this->f = $f;
  }

  public function getd():int
  {
      return $this->d;
  }

  public function gets():int
  {
      return $this->s;
  }

  public function getf():string
  {
      return $this->f;
  }

  public function setd($d)
  {
      $this->d = $d;
  }

  public function sets($s)
  {
      $this->s = $s;
  }

  public function setf($f)
  {
      $this->f = $f;
  }

  public function toArrayToView():array
  {
    return [
      'd'=>$this->getd(),
      's'=>$this->gets(),
      'f'=>$this->getf()
    ];
  }

  public function toArray():array
  {
    return [
      's'=>$this->gets(),
      'f'=>$this->getf()
    ];
  }

  public function setFromArray($array)
  {
    $this->d = $array[d];
    $this->s = $array[s];
    $this->f = $array[f];
    }

}