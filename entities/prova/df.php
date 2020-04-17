<?php
class df{
    /**
   * @var int
   */
   private $d;
   /**
   * @var string
   */
   private $df;
   /**
   * @var string
   */
   private $dfsf;
   
  public function __construct($d=0,$df="",$dfsf="")
  {
    $this->d = $d;
    $this->df = $df;
    $this->dfsf = $dfsf;
  }

  public function getd():int
  {
      return $this->d;
  }

  public function getdf():string
  {
      return $this->df;
  }

  public function getdfsf():string
  {
      return $this->dfsf;
  }

  public function setd($d)
  {
      $this->d = $d;
  }

  public function setdf($df)
  {
      $this->df = $df;
  }

  public function setdfsf($dfsf)
  {
      $this->dfsf = $dfsf;
  }

  public function toArrayToView():array
  {
    return [
      'd'=>$this->getd(),
      'df'=>$this->getdf(),
      'dfsf'=>$this->getdfsf()
    ];
  }

  public function toArray():array
  {
    return [
      'df'=>$this->getdf(),
      'dfsf'=>$this->getdfsf()
    ];
  }

  public function setFromArray($array)
  {
    $this->d = $array[d];
    $this->df = $array[df];
    $this->dfsf = $array[dfsf];
    }

}