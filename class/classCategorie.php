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

    public function createCategory(string $name){
        if (empty($name)) {
            echo "Il faut remplir tous les champs";
            exit();

        } else {
            $stmt = $this->db->prepare("SELECT * FROM categories WHERE nom = :nom");
            $stmt->bindValue(':nom', $name, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetch();

            if ($count > 0){
                echo "Le nom de la categorie existe déja";
                exit();

            } else {
                $stmt = $this->db->prepare("INSERT INTO categories (nom) VALUES (:nom)");
                $stmt->bindValue(':nom', $name, PDO::PARAM_STR);
                $stmt->execute();
                header('Location: ../pages/produits.php?=success');
            }
        }
    }
}

?>
