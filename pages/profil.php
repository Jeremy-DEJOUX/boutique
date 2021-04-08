<?php

require_once("../function/db.php");
require_once('../class/classUser.php');

if (isset($_POST["connect"])){
    $user = new User();
    $user->ConnectUser($_POST['login'], $_POST['password']);
}

if (isset($_POST["register"])){
    $user = new User();
    $user->register($_POST['login'],$_POST['email'], $_POST['password'], $_POST['confirmPW']); 
    $_SESSION['user']=$user; 
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up / Sign In</title>
    <link rel="stylesheet" href="../ressources/CSS/Profil.css">
</head>
<body>


<!-- ================================================================= MODIFICATION DU PROFIL ================================================================= -->
    <?php if (isset($_SESSION["user"])): ?>

        <main>

            <h1>Profil</h1>

            <div class="First_box">

                <div id="My_profil">
                    <h2>Votre Profil</h2>

                    <p> Login: <?= $_SESSION['user']['login']; ?> </p>
                    <p> Email: <?= $_SESSION['user']['email']; ?> </p>
                    <p> Droits: <?= $_SESSION['user']['id_droits']; ?> </p>
                </div>


                    
                <div id="Form_modif">
                    <h2>Modification</h2>

                    <form action="profil.php" method="POST" id="modif">

                        <label for="newLogin">Nouveau pseudo</label>
                        <input type="text"  name="newlogin" placeholder="Login"> <br>

                        <label for="newmail">Nouvelle adresse mail</label>
                        <input type="email" name="newMail"> <br>
                
                        <label for="oldPassword">New password</label>
                        <input type="password" name="newpassword" placeholder="New password"> <br>
                
                        <label for="newPassword">Confirm password</label>
                        <input type="password" name="confpassword" placeholder="Confirm Password"> <br>
          
                        <button type="submit" name="submit" value="Envoyer">Mettre à jour</button>
                    </form>

                </div>

                
            </div>
            
            

            <?php 
                if (isset($_POST['submit'])){
                    $user = new User;
                    $user->profile($_POST['newlogin'],$_POST['newMail'],$_POST['newpassword'],$_POST['confpassword']);
                }
            ?> 

            <a href="deconnexion.php">Deconnexion</a>
        </main>
    







<!-- ================================================================= CONNEXION / INSCRIPTION ============================================================ -->
    <?php else: ?>
        <main>
            <form id="form_connect" action="" method="POST">
                <label for="login">Login</label>
                <input type="text" name="login">
                <label for="password" name="password">Mot de passe</label>
                <input type="password" name="password">
                <input type="submit" name="connect" value="go!">
            </form>

            <form  id="form_register" action="" method="POST">
                <label for="login">Login</label>
                <input type="text" name="login">
                <label for="email">Email</label>
                <input type="email" name="email">
                <label for="password" name="password">Mot de passe</label>
                <input type="password" name="password">
                <label for="confirmPW">Confirmz vote mot de passe</label>
                <input type="password" name="confirmPW">
                <input type="submit" name="register" value="go!">
            </form>
        </main>
    <?php endif; ?>



</body>
</html>

