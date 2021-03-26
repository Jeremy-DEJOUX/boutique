<?php
require_once('../class/classDb.php');
require_once('../class/classPanier.php');
$db = new Db;
$panier = new Panier($db);

?>


<main>



    <div>
        <?php $products = $db->query("SELECT * FROM produits"); ?>
        <?php foreach ($products as $product): ?>
            <div>
                <?= $product->nom; ?>
                <?= number_format($product->prix, 2); ?>

                <img src="../ressources/img/<?=$product->FullNameImg ?>" alt="">

                <a class="addPanier" href="addpanier.php?id=<?= $product->id; ?>">Ajouter au panier</a>

            </div>
        <?php endforeach; ?>
    </div>



</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="../ressources/JS/script.js"></script>

