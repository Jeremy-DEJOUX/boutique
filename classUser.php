<?php 

class User
{
    private $id;
    public $login;
    public $password;
    public $email;
    public $db;
    private $id_droits;

    public function __construct()
    {
        $this->db = connect();
    }
}