<?php

require_once('class/classDb.php');
require_once("function/db.php"); 
require_once("class/classUser.php");
require_once("class/classProduits.php");
$db = new Db;
$produits = new Product;

$path_index="";
$path_connexion="pages/insCo.php";
$path_panier="pages/panier.php";
$path_produits="pages/produits.php";
$path_admin="pages/reservation.php";
$path_footer='../css/footer.css';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="ressources/CSS/index.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once('pages/header.php'); ?>
        <main>

        <article class="box-slide">
            <h1 id="titre-prod">Nos Derniers produits</h1>
            <section class="slide-show">
            <?php $products = $db->query("SELECT * FROM produits"); ?>
            <?php foreach ($products as $product): ?>
                
                    <a class="a-slide" href="pages/produit.php?id=<?= $product->id; ?>"><img class='img-slide'src="ressources/img/<?=$product->FullNameImg ?>" alt="Img Produits"></a>

            <?php endforeach; ?>
            </section>
        </article>
        <article id='art-index'>
                <section id='sec-index'>
                <h1>A propos de nous</h1>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed mollitia itaque autem repellendus, animi nesciunt dolores omnis ipsa quasi? Id vitae adipisci esse temporibus et nobis maxime non quae? Nesciunt.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto maxime, perspiciatis possimus id dolorum doloremque aliquid ratione saepe repellendus vitae! Dolorum ex dolore itaque fugiat molestiae ut doloremque voluptate esse!
                </section>
           
        </main>
        <?php require_once('pages/footer.php');?>
</body>
</html>