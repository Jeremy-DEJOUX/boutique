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
     * @return void
     */
    public function create_Product(string $nom, string $desc, float $price, int $stock, string $titleImg, string $FullNameImg, int $orderImg){

        if (empty($nom) || empty($desc) || empty($stock) || empty($price)) {
            echo "Il faut remplir tous les champs";
            exit();

        } elseif ($price < 0 || $stock < 1) {
            echo "Le prix ou le stock est faut";
            exit();

        } else {
            $stmt = $this->db->prepare("SELECT * FROM produits WHERE nom = :nom");
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            
            if ($count > 0){
                echo "Le nom du produits existe déja";
                exit();

            } else {
                $stmt = $this->db->prepare("INSERT INTO produits (nom, description, prix, stock) VALUES (:name, :desc, :price, :stock)");
                $stmt->bindValue(':name', $nom, PDO   ::PARAM_STR);
                $stmt->bindValue(':desc', $desc, PDO  ::PARAM_STR);
                $stmt->bindValue(':price', $price, PDO::PARAM_STR);
                $stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
                $stmt->execute();
                header('location:../pages/produits.php');
            }
        }

    }

    public function img_Product(){

    }
}