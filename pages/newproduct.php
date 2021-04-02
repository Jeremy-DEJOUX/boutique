

<?php
require_once('../class/classDb.php');
require_once('../class/classPanier.php');
require_once('../function/db.php');
require_once('../class/classProduits.php');
$db = new Db;
$panier = new Panier($db);
$produits = new Product;

?>


<main>


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
    <div>
        <?php $products = $db->query("SELECT * FROM produits"); ?>
        <?php foreach ($products as $product): ?>
            <div>
                <?= $product->nom; ?>
                <?= number_format($product->prix, 2); ?>

                <img src="../ressources/img/<?=$product->FullNameImg ?>" alt="">

                <a class="addPanier" href="addpanier.php?id=<?= $product->id; ?>">Ajouter au panier</a>

                <a href="produit.php?id=<?= $product->id; ?>">Voir plus</a>

            </div>
        <?php endforeach; ?>
    </div>



</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="../ressources/JS/script.js"></script>

