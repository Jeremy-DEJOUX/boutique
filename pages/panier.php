<?php
require_once('../class/classDb.php');
require_once('../class/classPanier.php');
require_once('../function/db.php');
$db = new Db;
$panier = new Panier($db);
// var_dump($_SESSION);

$tab = [];
if (isset($_SESSION['result'])) {
    foreach ($_SESSION['result'] as $row){
        array_push($tab, $row['nom']);
    }
}

if (isset($_POST['confirmCommande'])) {
    $commande = $panier->commande(1, $tab);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <link rel="stylesheet" href="../ressources/CSS/Panier.css">
</head>
<body>
    
    <main>
        
    <div id="first_box">
        
        <div id="box_left">
            <h1>Votre Panier</h1>
            <form action="" method="post" class="stock_panier">
                <?php
                    $ids = array_keys($_SESSION['panier']);
                    if(empty($ids)){
                        $products = array();
                    } else {
                        $products = $db->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
                    }
                    foreach($products as $product):
                ?>

                <div class="box_panier">
                    <article class="produit_panier">
                        <img src="../ressources/img/<?= $product->FullNameImg; ?>" alt="<?= $product->titleImg; ?>" class="img_pannier">
                        <p class="name_panier"> <?= $product->nom; ?> </p>
                        <p class="prix_panier"> Prix: <?= number_format($product->prix, 2); ?> €</p>
                        <input class="quantity_panier" number" name="panier[quantity][<?= $product->id; ?>]" value="<?= $_SESSION['panier'][$product->id]; ?>">
                        <a class="del_panier" href="panier.php?delPanier=<?= $product->id;?>">Suprimmer</a>
                    </article>
                </div>

                <?php endforeach; ?>

                <input id="quantity_panier" type="submit" value="Recalculer">
            </form>
        </div>



        <div id="box_right">
            <div id="recap_panier">
                <div id="recap_name">
                    <h3>Récapitulatif</h3>
                </div>


                <div>
                    <p> <?= $panier->count(); ?> Produits <?= number_format($panier->total(), 2); ?> </p>
                </div>
            </div>



            <div id="total_panier">
                <div id="shipping"> 
                    <p> Frais de Livraison <?= 5; ?> € </p>
                </div>


                <div id="total">
                    <h3> Total <?= number_format($panier->total(), 2) + 5; ?> € </h3>
                </div>
            </div>
        </div>
    </div>




            


            <!-- <form method="post">
                <p>Nom <?= $product->nom; ?> <br/></p>
                <p>Prix <?= number_format($product->prix, 2); ?></p> <br/>
                <img src="../ressources/img/<?= $product->FullNameImg; ?>" alt=""> <br>
                <span>Quantité <input type="text" name="panier[quantity][<?= $product->id; ?>]" value="<?= $_SESSION['panier'][$product->id]; ?>"></span>
                <a href="panier.php?delPanier=<?= $product->id;?>">Suprimmer</a> -->
                <?php //endforeach; ?>

                <!-- <input type="submit" value="Recalculer">
            </form>

            <p>Somme des produits <?= $panier->count(); ?> </p>

            <p>Prix total du panier <?= number_format($panier->total(), 2); ?></p>
            
            <form action="" method="post">
                <button name="confirmCommande">Confirmez la Commande</button>
            </form> -->



    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="../ressources/JS/script.js"></script>
</body>
</html>


