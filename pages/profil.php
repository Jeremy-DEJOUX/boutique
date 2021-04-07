<?php

$database = ("../function/db.php");
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
</head>
<body>
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
</body>
</html>
