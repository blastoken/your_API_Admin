<?php


class Post
{
    const RUTA_IMAGENES_POSTS='imgs/posts/';
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $autor;
    /**
     * @var string
     */
    private $titulo;
    /**
     * @var string
     */
    private $texto;
    /**
     * @var string
     */
    private $img;

    public function __construct($id=0, $autor="", $titulo="", $texto="", $img="")
    {
        $this->id = $id;
        $this->autor = $autor;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->img = $img;
    }

        public function getId():int
        {
          return $this->id;
        }

        public function getAutor():string
        {
          return $this->autor;
        }

        public function getTitulo():string
        {
          return $this->titulo;
        }

        public function getTexto():string
        {
          return $this->texto;
        }

        public function getImg():string
        {
          return $this->img;
        }

        public function getFolderImages():string{
                return self::RUTA_IMAGENES_POSTS  . $this->getImg();
        }

        public function setId($id)
        {
          $this->id = $id;
        }

        public function setAutor($autor)
        {
          $this->autor = $autor;
        }

        public function setTitulo($titulo)
        {
          $this->titulo = $titulo;
        }

        public function setTexto($texto)
        {
          $this->texto = $texto;
        }

        public function setImg($img)
        {
          $this->img = $img;
        }

        public function toArray():array{
          return [
            'autor'=>$this->getAutor(),
            'titulo'=>$this->getTitulo(),
            'texto'=>$this->getTexto(),
            'img'=>$this->getImg()
          ];
        }


}
