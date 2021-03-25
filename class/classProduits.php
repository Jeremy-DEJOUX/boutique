<?php

class Product {

    // public $id;
    // public $name;
    // public $description;
    // public $price;
    // public $stock;
    // public $titleImg;
    // public $fullnameImg;
    // public $orderImg;
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
    public function create_Product(string $nom, string $desc, float $price, int $stock, $titleImg, $newFileName, $uploadfile){
        if (empty($nom) || empty($desc) || empty($price) || empty($stock)){
            echo "Il faut remplir tous les champs";
            exit();

        } elseif ($price < 0 || $stock < 0) {
            echo "Erreur au niveaux du stock ou du prix";

        } elseif (empty($newFileName)) {
            $newFileName = "img";

        } else{
            $newFileName = strtolower(str_replace(" ", "-", $newFileName));
        }

        $file = $uploadfile;
        $fileName      = $file['name'];
        $fileType      = $file['type'];
        $fileTempName  = $file['tmp_name'];
        $fileError     = $file['error'];
        $fileSize      = $file['size'];

        $fileExt       = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed       = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0){
                if ($fileSize < 2000000) {
                    $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                    $fileDestination = "../ressources/img/" . $imageFullName;
    
                    if (empty($titleImg)) {
                        echo "Votre image doit avoir un Titre";
                        header("Location: ../pages/produits.php?upload=empty");
                        exit();
                    } else{
                        $sql = "SELECT * FROM produits";
                        $stmt = $this->db->query($sql);
                        $rowCount = $stmt->fetchColumn();
                        $setImageOrder = $rowCount + 1;
    
                        $sql = "INSERT INTO produits (nom, description, prix, stock, titleImg, FullNameImg, orderImg) VALUES (:nom, :desc, :prix, :stock, :titleImg, :FullNameImg, :orderImg)";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
                        $stmt->bindValue(':desc', $desc, PDO::PARAM_STR);
                        $stmt->bindValue(':prix', $price, PDO::PARAM_INT);
                        $stmt->bindValue(':stock', $stock, PDO::PARAM_STR);
                        $stmt->bindValue(':titleImg', $titleImg, PDO::PARAM_STR);
                        $stmt->bindValue(':FullNameImg', $imageFullName, PDO::PARAM_STR);
                        $stmt->bindValue(':orderImg', $setImageOrder, PDO::PARAM_INT);
                        $stmt->execute();
    
                        move_uploaded_file($fileTempName, $fileDestination);
    
                    header("Location: ../pages/produits.php?upload=success");
                    }
                } else {
                echo "File size is too big";
                exit();
            }
        } else {
            "Your photo had an error";
            exit();
        }
    } else {
        echo "You need to upload a proper file type!";
        exit();
    }

    }
}
