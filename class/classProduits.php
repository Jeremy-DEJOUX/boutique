<?php

class Product {

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

    /**
     * Create a product
     *
     * @param string $nom
     * @param string $desc
     * @param float $price
     * @param integer $stock
     * @param string $titleImg
     * @param string $FullNameImg
     * @param int $orderImg
     * @param string $nameCategory
     * @return void
     */
    public function create_Product(string $nom, string $desc, float $price, int $stock, string $titleImg, string $FullNameImg, int $orderImg, string $nameCategory){

    }

}