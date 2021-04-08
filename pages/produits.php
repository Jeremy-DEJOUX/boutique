<?php
require_once('../class/classProduits.php');
require_once('../class/classCategorie.php');

require_once('../function/db.php');
$produits = new Product;

if (isset($_POST['product'])) {
    
    $produits->create_Product($_POST['nom'], $_POST['desc'], $_POST['price'], $_POST['stock'], $_POST['filetitle'], $_POST['filedesc'], $_FILES['fileupload'], $_POST['nom_cat']);
}

if (isset($_POST['category'])) {
    $category = new Categorie;
    $category->createCategory($_POST['nom_cat']);

}

if (isset($_POST['modifProd'])){
    $produits->modifProduit($_POST['id_prod'],$_POST['nameProd'], $_POST['desc'], $_POST['prix'], $_POST['stock'], $_POST['titleImg'], $_POST['descImg'], $_FILES['fileupload']);
}

if (isset($_POST['deleteProd'])) {
    $produits->deleteProd($_POST['id_prod']);
}
if (isset($_POST['delete_cat'])){
    $category = new Categorie;
    $category->deleteCat($_POST['deleteCat']);
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="ressources/CSS/produits.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
</head>
<body>
    <main>

    <h1>CREATION DE PRODUITS</h1>
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

            <input type="submit" name="product" value="Envoyer">

        </form> <br><br><br>



<h1>CREATION DE CATEGORIE</h1>
        <form action="" method="post">
            <input type="text" name="nom_cat" placeholder="Category name...">
            <input type="submit" name="category" value="Envoyer">
        </form> <br><br><br>


    <h1>AFFICAHGE DES PRODUITS</h1>

        <div>
            <?php                
                if (isset($_POST['CategorieChoose'])){
                    $produits = new Product;
                    $produits->produitsByCategory($_POST['trieCategorie']);
                    echo "<table class='flex column j_center a_center' id='tableauArt'>";
                                foreach($_SESSION['categorie'] as $row){
                                    echo 
                                    "<tr>
                                        <td>" . $row['nom'] . "</td>
                                        <td>" . $row['description'] . "</td>
                                        <td>" . $row['prix'] ."</td>
                                        <td>" . $row['stock'] ."</td>
                                    </tr>";
                                }
                                echo "</table>";
                } else {
                    $produits->affichageProduits();
                    for ($i=0; $i < count($_SESSION['result']); $i++) { 
                        echo 
                            "<a href='produits.php?id=$i'>
                                <img src='../ressources/img/" . $_SESSION['result'][$i]['FullNameImg'] . "'>
                            </a>";
                    }
                }

            ?>
        </div> <br><br><br><br>


                <h1>FILTRER LES CATEGORIES</h1>

        <div>
                <form action="" method="post">
                    <select name="trieCategorie">
                        <option>Select</option>
                            <?php
                                $cat = new Categorie();
                                $cat->displayChoice();
                            ?>
                    </select>

                    <input type="submit" name="CategorieChoose" value="Filtrer">
                </form>
        </div> <br><br><br><br>

                <h1>MODIFICATION SUPPRESSION PRODUITS</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Select Categorie</label>
            <select name="id_prod">
                <option>Select</option>
                    <?php
                        $cat = new Product();
                        $cat->displayProd();
                    ?>
            </select>
            <input type="text" name="nameProd" placeholder="Nom du produit...">
            <input type="text" name="desc" placeholder="Description...">
            <input type="number" name="prix" placeholder="Prix...">
            <input type="number" name="stock" placeholder="Stock...">
            <input type="text" name="titleImg" placeholder="Titre IMG...">
            <input type="text" name="descImg" placeholder="Description img...">
            <input type="file" name="fileupload">

            <input type="submit" name="modifProd" value="Envoyer">
            <input type="submit" name="deleteProd" value="Supprimer">
        </form>
 <br><br><br><br>


 <h1>SUPPRESSION DE CATEGORIE</h1>

 <form action="" method="post">
    <select name="deleteCat">
        <option>Select</option>
            <?php
                $cat = new Categorie();
                $cat->displayChoice();
            ?>
    </select>
    <input type="submit" value="Supprimer" name="delete_cat">
 </form>



    </main>
</body>
</html>