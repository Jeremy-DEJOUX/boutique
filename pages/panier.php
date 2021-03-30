<?php
require_once('../class/classDb.php');
require_once('../class/classPanier.php');
require_once('../function/db.php');
$db = new Db;
$panier = new Panier($db);
var_dump($_SESSION['result']);


?>

<?php
$tab = [];
foreach ($_SESSION['result'] as $row){
        array_push($tab, $row['nom']);
}
// echo $tab[1], $tab[0];
if (isset($_POST['confirmCommande'])) {
    $commande = $panier->commande(1, $tab);
}

?>
<main>

    <div>
        <?php
            $ids = array_keys($_SESSION['panier']);
            if(empty($ids)){
                $products = array();
            } else {
                $products = $db->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
            }
            foreach($products as $product):
        ?>

        <p>Nom <?= $product->nom; ?> <br/></p>
        <p>Prix <?= number_format($product->prix, 2); ?></p> <br/>
        <img src="../ressources/img/<?= $product->FullNameImg; ?>" alt=""> <br>
        <p>Quantité <?= $_SESSION['panier'][$product->id]; ?></p>


        

        <a href="panier.php?delPanier=<?= $product->id;?>">Suprimmer</a>
        <?php endforeach; ?>

        <p>Somme des produits <?= $panier->count(); ?> </p>

        <p>Prix total du panier <?= number_format($panier->total(), 2); ?></p>
        
        <form action="" method="post">
            <button name="confirmCommande">Confirmez la Commande</button>
        </form>
    </div>



</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="../ressources/JS/script.js"></script>