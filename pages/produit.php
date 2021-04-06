<?php
require_once('../class/classProduits.php');
require_once('../function/db.php');
require_once('../class/classPanier.php');
require_once('../class/classDb.php');
require_once('../class/classCommentaire.php');
$db = new Db;
$panier = new Panier($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Produit</title>
    <link rel="stylesheet" href="../ressources/CSS/Produit.css">
</head>
<body>
    <?php //require_once'header.php'; ?>

<?php 
    if (isset($_GET['id'])):
        $produit = new Product();
        $produit->ProduitById($_GET['id']);
        foreach ($_SESSION['produit'] as $row): ;
?>
<main>
    <div id="box">

        <div id="box_left">

            <div id="container_top">
                <?= $row->nom ?>
            </div>

            <div id="container_mid">

                <div id="tab_left">
                    <?= $row->description ?>
                </div>



                <div id="tab_right">
                    <div id="tab_top">
                        <h3>Prix: <?= $row->prix ?>€</h3>
                    </div>


                    <div id="tab_mid">
                        <h3>Stock: <?= $row->stock ?></h3>
                    </div>


                    <div id="tab_bot">
                        <h3>Temps: 1 A 2h</h3>
                    </div>
                </div>

            </div>

            <div id="container_bot">
                <a id="add_cart" class="addPanier" href="addpanier.php?id=<?= $_GET['id'] ?>">Ajouter au panier</a>
            </div>

        </div>



        <div id="box_right">
            <img src="../ressources/img/<?= $row->FullNameImg ?>" alt="<?= $row->titleImg ?>">
        </div>


                    
                <?php endforeach; ?>
            <?php endif; ?>

        <?php
            // $login = $_SESSION['user'];
            // if(isset($_POST["postComment"])){
            //     $comment = new Comment;
            //     $comment->postComment($login, $_POST['comment'], $_GET['id']);
            // }
            // $comment = new Comment;
            // $comment->displayComment($_GET['id']);
            // foreach($_SESSION['commentaire'] as $row){
            //     echo 
            //     "<div>
            //         <tr>
            //             <td>" . $row['login'] . "</td>
            //             <td>" . $row['commentaire'] . "</td>
            //             <td>" . $row['date'] ."</td>
            //         </tr>
            //     </div>";
            // }
        
        ?>

        <!-- <form id="formCom" action="" method='POST'>
            <label for="">Ajouter un commentaire</label><br>
            <textarea name="comment" id="" cols="30" rows="10"></textarea><br>
            <input type="submit" name="postComment" value="commenter">
        </form> -->
    </div>

</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="../ressources/JS/script.js"></script>


<?php //require_once'footer.php';?>
</body>
</html>


