<?php


class Usuario
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    public function __construct($id=0, $user="", $email="", $password="")
    {
        $this->id = $id;
        $this->user = $user;
        $this->email = $email;
        $this->password = $password;
    }

        public function getId():int
        {
          return $this->id;
        }

        public function getUser():string
        {
          return $this->user;
        }

        public function getEmail():string
        {
          return $this->email;
        }

        public function getPassword():string
        {
          return $this->password;
        }

        public function setId($id)
        {
          $this->id = $id;
        }

        public function setUser($user)
        {
          $this->user = $user;
        }

        public function setEmail($email)
        {
          $this->email = $email;
        }

        public function setPassword($password)
        {
          $this->password = $password;
        }

        public function toArray():array{
          return [
            'user'=>$this->getUser(),
            'email'=>$this->getEmail(),
            'password'=>$this->getPassword()
          ];
        }


}
