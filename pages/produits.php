<?php
require_once('../class/classProduits.php');
require_once('../class/classCategorie.php');

require_once('../function/db.php');


// if (isset($_POST['product'])) {
//     $produits = new Product;
//     $produits->create_Product($_POST['nom'], $_POST['desc'], $_POST['price'], $_POST['stock']);
// }

if (isset($_POST['category'])) {
    $category = new Categorie;
    $category->createCategory($_POST['nom_cat']);

}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
</head>
<body>
    <main>
        <form action="" method="post">
            <input type="text" name="nom" placeholder="Product Name...">
            <input type="text" name="desc" placeholder="Description...">
            <input type="number" name="price" placeholder="Prix...">
            <input type="number" step=".01" name="stock" placeholder="Stock...">


            <input type="submit" name="product" value="Envoyer">






        </form>

        <form action="" method="post">
            <input type="text" name="nom_cat" placeholder="Category name...">
            <input type="submit" name="category" value="Envoyer">
        </form>
    </main>
</body>
</html>