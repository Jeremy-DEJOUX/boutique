<?php


class Categorie{

    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $titleImg;
    public $fullnameImg;
    public $orderImg;
    public $db;

    public function __construct(){
        $this->db = connect();
    }

    public function createCategory(){
        
    }
}

?>
