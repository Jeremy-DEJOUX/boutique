<?php
require_once("../function/db.php");
require_once("../class/classAdmin.php");
require_once('../class/classProduits.php');
require_once('../class/classCategorie.php');
require_once('../class/classUser.php');
require_once('../class/classDroits.php');

//-----------------------chemin-----------------


// require_once('header.php');
if(!isset($_SESSION['id_droits']) OR $_SESSION['id_droits'] != 1337){
   echo "Only admin can accest this page"; 
}
else{

$produits = new Product;
//------------------------------------------PRODUITS---------------------------------
if (isset($_POST['product'])) {
    $produits->create_Product($_POST['nom'], $_POST['desc'], $_POST['price'], $_POST['stock'], $_POST['filetitle'], $_POST['filedesc'], $_FILES['fileupload'], $_POST['nom_cat']);
}

if (isset($_POST['category'])) {
    $category = new Categorie;
    $category->createCategory($_POST['nom_cat']);
}
if (isset($_POST['modifProd'])){
    $produits->modifProduit($_POST['id_prod'],$_POST['nameProd'], $_POST['desc'], $_POST['prix'], $_POST['stock'], $_POST['titleImg'], $_POST['descImg'], $_FILES['fileupload']);
}

if (isset($_POST['deleteProd'])) {
    $produits->deleteProd($_POST['id_prod']);
}
if (isset($_POST['delete_cat'])){
    $category = new Categorie;
    $category->deleteCat($_POST['deleteCat']);
}
//-----------------------------------------USER---------------------------------------------
if(isset($_POST['mod'])){
                $droits = new User();
                $droits->updateDroit($_POST['moddingUser'], $_POST['droitUser']);
                $update = new Admin();
                $update->UpdateNewUser($_POST['moddingUser'], $_POST['UpdateLog'], $_POST['UpdateMail'], $_POST['updatePW'], $_POST['updateCPW']);
            }
if(isset($_POST['createUser'])){
    $create = new Admin;
    $create->registerNewUser($_POST['createLogin'], $_POST['eMail'], $_POST['createPW'], $_POST['confirmPW'], $_POST['droitsNewUser']);
}
if(isset($_POST['deleteUser'])){
    $delete = new Admin();
    $delete->deleteUser($_POST['moddingUser']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <h2>AJOUT DE PRODUIT</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nom" placeholder="Product Name...">
            <input type="text" name="desc" placeholder="Description...">
            <input type="number" name="price" placeholder="Prix...">
            <input type="number" step=".01" name="stock" placeholder="Stock...">
            <input type="text" name="filetitle" placeholder="Image title...">
            <input type="text" name="filedesc" placeholder="Image description...">
            <input type="file" name="fileupload">

            <label>Select Categorie</label>
                    <select name="nom_cat">
                        <option>Select</option>
                            <?php
                                $cat = new Categorie();
                                $cat->displayChoice();
                            ?>
                    </select>
            <input type="submit" name="product" value="Envoyer">
        </form>

        <br><br><br>

        <h2>AJOUT DE CATEGORIE</h2>

        <form action="" method="post">
            <input type="text" name="nom_cat" placeholder="Category name...">
            <input type="submit" name="category" value="Envoyer">
        </form>
        
    <h1>Ajout new user</h1>
        <form  id="createUser" action="" method="POST">
            <label for="createLogin">Login</label>
            <input type="text" name="createLogin">
            <label for="email">Email</label>
            <input type="email" name="eMail">
            <label for="createPW" name="password">Mot de passe</label>
            <input type="password" name="createPW">
            <label for="confirmPW">Confirmz vote mot de passe</label>
            <input type="password" name="confirmPW">
            <select name="droitsNewUser">
                        <option>Select</option>
                        <?php
                        $droits = new Droits();
                        $droits->displayChoice();
                        ?>
                    </select>
            <input type="submit" name="createUser" value="Create">
        </form>

        <form action="" method="POST">
            <h1>Modification de User</h1>
                    <select name="moddingUser">
                        <option>Select</option>
                        <?php
                        $article = new User();
                        $article->getDisplay();
                        ?>
                    </select>
                    <label for="UpdateLog">Changez le nv pseudo</label>
                    <input type="text" name="UpdateLog">
                    <label for="UpdateMail">E-Mail:</label>
                    <input type="eMail" name="UpdateMail">
                    <label for="updatePW">Nouveau mot de passe:</label>
                    <input type="password" name="updatePW">
                    <label for="updateCPW">Confirmez le mot de passe: </label>
                    <input type="password" name="updateCPW">
                    <label>Select Droits</label>
                    <select name="droitUser">
                        <option>Select</option>
                        <?php
                        $droits = new Droits();
                        $droits->displayChoice();
                        ?>
                    </select>
                    <input type="submit" name="mod" value="Envoyer">
                    <input type="submit" name="deleteUser" value="Supprimer">
        </form>   
        <h1>MODIFICATION SUPPRESSION PRODUITS</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Select Categorie</label>
            <select name="id_prod">
                <option>Select</option>
                    <?php
                        $cat = new Product();
                        $cat->displayProd();
                    ?>
            </select>
            <input type="text" name="nameProd" placeholder="Nom du produit...">
            <input type="text" name="desc" placeholder="Description...">
            <input type="number" name="prix" placeholder="Prix...">
            <input type="number" name="stock" placeholder="Stock...">
            <input type="text" name="titleImg" placeholder="Titre IMG...">
            <input type="text" name="descImg" placeholder="Description img...">
            <input type="file" name="fileupload">

            <input type="submit" name="modifProd" value="Envoyer">
            <input type="submit" name="deleteProd" value="Supprimer">
        </form>
 <br><br><br><br>


 <h1>SUPPRESSION DE CATEGORIE</h1>

 <form action="" method="post">
    <select name="deleteCat">
        <option>Select</option>
            <?php
                $cat = new Categorie();
                $cat->displayChoice();
            ?>
    </select>
    <input type="submit" value="Supprimer" name="delete_cat">
 </form>     
    </main>
</body>
</html>

<?php } ?>