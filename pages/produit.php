<?php
require_once('../class/classProduits.php');
require_once('../function/db.php');
?>


<!-- <?php require_once'header.php'; ?> -->


<main>
    <h1>PageProduit</h1>

    <?php 
        if (isset($_GET['id'])){
            $produit = new Product();
            $produit->ProduitById($_GET['id']);
            foreach ($_SESSION['produit'] as $row){
               echo $row->nom;
            }
    }
    ?>

</main>


<!-- <?php require_once'footer.php';?> -->