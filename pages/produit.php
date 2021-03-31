<?php
require_once('../class/classProduits.php');
require_once('../function/db.php');
require_once('../class/classPanier.php');
require_once('../class/classDb.php');
require_once('../class/classCommentaire.php');
$db = new Db;
$panier = new Panier($db);
?>


<!-- <?php require_once'header.php'; ?> -->


<main>
    <h1>PageProduit</h1>

    <?php 
        if (isset($_GET['id'])):
            $produit = new Product();
            $produit->ProduitById($_GET['id']);
            foreach ($_SESSION['produit'] as $row): ; 
           
    ?>
               
            
                <div>
                    <img src="../ressources/img/<?= $row->FullNameImg ?>" alt="<?= $row->titleImg ?>">
                </div>
                    <a class="addPanier" href="addpanier.php?id=<?= $_GET['id'] ?>">Ajouter au panier</a>
            
            
            <?php endforeach; ?>
                

            
     <?php endif; ?>
     <?php
        $login = $_SESSION['user'];
        if(isset($_POST["postComment"])){
            $comment = new Comment;
            $comment->postComment($login, $_POST['comment'], $_GET['id']);
        }
        $comment = new Comment;
        $comment->displayComment($_GET['id']);
        foreach($_SESSION['commentaire'] as $row){
            echo 
            "<div>
                <tr>
                    <td>" . $row['login'] . "</td>
                    <td>" . $row['commentaire'] . "</td>
                    <td>" . $row['date'] ."</td>
                </tr>
            </div>";
        }
    
     ?>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="../ressources/JS/script.js"></script>


<!-- <?php require_once'footer.php';?> -->