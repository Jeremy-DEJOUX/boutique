<?php
$database = ("../function/db.php");
require_once("../class/classAdmin.php");
require_once('../class/classProduits.php');
require_once('../class/classCategorie.php');

//-----------------------chemin-----------------


// require_once('header.php');
// if(!isset($_SESSION['id_droits']) OR $_SESSION['id_droits'] != 1337){
//    echo "Only admin can accest this page"; 
// }
// else{

$produits = new Product;

if (isset($_POST['product'])) {
    $produits->create_Product($_POST['nom'], $_POST['desc'], $_POST['price'], $_POST['stock'], $_POST['filetitle'], $_POST['filedesc'], $_FILES['fileupload'], $_POST['nom_cat']);
}

if (isset($_POST['category'])) {
    $category = new Categorie;
    $category->createCategory($_POST['nom_cat']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php
            if(isset($_POST['mod'])){
                $update = new Admin();
                $update->UpdateNewUser($_POST['moddingUser'], $_POST['UpdateLog'], $_POST['UpdateMail'], $_POST['updatePW'], $_POSt['updateCPW']);
            }
            if(isset($_POST['createUser'])){
                $create = new Admin();
                $create->registerNewUser($_POST['createLogin'], $_POST['eMail'], $_POST['createPW'], $_POST['confirmPW'], $_POST['droitsNewUser']);
            }
            if(isset($_POST['deleteUser'])){
                $delete = new Admin();
                $delete->deleteUser($_POST['moddingUser']);
            }

        ?>

        <h2>AJOUT DE PRODUIT</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nom" placeholder="Product Name...">
            <input type="text" name="desc" placeholder="Description...">
            <input type="number" name="price" placeholder="Prix...">
            <input type="number" step=".01" name="stock" placeholder="Stock...">
            <input type="text" name="filetitle" placeholder="Image title...">
            <input type="text" name="filedesc" placeholder="Image description...">
            <input type="file" name="fileupload">

            <label>Select Categorie</label>
                    <select name="nom_cat">
                        <option>Select</option>
                            <?php
                                $cat = new Categorie();
                                $cat->displayChoice();
                            ?>
                    </select>

                <?php
                    $query = "SELECT * FROM categories";
                    $stmt = connect()->query($query);
                    $result = $stmt->fetchAll(pdo::FETCH_ASSOC);
                    // var_dump($result); 
                    for ($i=0; $i < COUNT($result) ; $i++) { 
                       echo 
                            "<label>" . $result[$i]['nom'] . "</label> 
                            <input type='checkbox' name=''id=''>";
                    }
                
                
                ?>

            <input type="submit" name="product" value="Envoyer">
        </form>

        <br><br><br>

        <h2>AJOUT DE CATEGORIE</h2>

        <form action="" method="post">
            <input type="text" name="nom_cat" placeholder="Category name...">
            <input type="submit" name="category" value="Envoyer">
        </form>


    </main>
</body>
</html>

<?php
// }
?>