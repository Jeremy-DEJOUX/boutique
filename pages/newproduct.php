

<?php
require_once('../class/classDb.php');
require_once('../class/classPanier.php');
require_once('../function/db.php');
require_once('../class/classProduits.php');
require_once('../class/classCategorie.php');
$db = new Db;
$panier = new Panier($db);
$produits = new Product;

$path_index="../index.php";
$path_connexion="profil.php";
$path_panier="panier.php";
$path_produits="newproduct.php";
$path_admin="admin.php";
$path_footer='../ressources/css/footer.css';
$path_header='../ressources/css/header.css';
$path_deconnexion='deconnexion.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="../ressources/CSS/produits.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main>
    <?php require_once('header.php'); ?>
    <h1 id='h1Main'>PRODUITS</h1>
<article id='artForm'>
    <section class='secForm'>
        <div>
                <form action="" method="post">
                    <select name="trieCategorie">
                        <option>Select</option>
                            <?php
                                $cat = new Categorie();
                                $cat->displayChoice();
                            ?>
                    </select>

                    <input class="myButton" type="submit" name="CategorieChoose" value="Filtrer">
                </form>
        </div> 
    </section>
    <section>
        <div>
            <form method="post">

                <input type='text' name='search' placeholder='Search'>
                <input class="myButton" type="submit" name="submit-search" value="search">

            </form>
        </div>

        <?php

            if(isset($_POST['submit-search'])){
                $search = $_POST['search'];
                $sql = "SELECT * FROM produits WHERE nom LIKE '%$search%'";
                $stmt=connect()->prepare($sql);
                $stmt->execute();
                $queryResult = $stmt->fetchAll();
                var_dump($queryResult);

                if(COUNT($queryResult) > 0){
                    foreach ($queryResult as $key) {
                        echo $key['nom'];
                        echo $key['description'];
                        echo $key['prix'];
                    }
                }
                else{
                    echo "no results";
                }
            }

        ?>
    </section>
</article>

    <div id='divMainProd'>
        <?php $products = $db->query("SELECT * FROM produits"); ?>
        <?php foreach ($products as $product): ?>
        <article class='artProd'>
            <div class='divProd'>
                <div class='divTitre'>
                    <?= $product->nom; ?>
                </div>
                <div class='divPrix'>
                    <?= number_format($product->prix, 2);?> $
                </div>
            
                <img class="imgProd" src="../ressources/img/<?=$product->FullNameImg ?>" alt="">

            <div class="divLink">
                <a class="addPanier" href="addpanier.php?id=<?= $product->id; ?>">Ajouter au panier</a>

                <a class="seeProd" href="produit.php?id=<?= $product->id; ?>">Voir plus</a>
            </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
    <?php require_once('footer.php');?>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="../ressources/JS/script.js"></script>

</body>
</html>