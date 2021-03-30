<?php

$database = ("../function/db.php");
require_once("../function/db.php");
require_once('../class/classCommentaire.php');
require_once('../class/classUser.php');

$login = $_SESSION['user'];
if(isset($_POST["postComment"])){
    $comment = new Comment;
    $comment->postComment($login, $_POST['comment'], $_GET['id']);
}

if (isset($_POST["connect"])){
    $user = new User();
    $user->ConnectUser($_POST['login'], $_POST['password']);
    }

    if (isset($_POST["register"])){
        $user = new User();
        $user->register($_POST['login'],$_POST['email'], $_POST['password'], $_POST['confirmPW']); 
        $_SESSION['user']=$user; 
    }

    $comment = new Comment;
    $comment->displayComment($_GET['id']);
    foreach($_SESSION['commentaire'] as $row){
        echo 
        "<tr>
            <td>" . $row['login'] . "</td>
            <td>" . $row['commentaire'] . "</td>
            <td>" . $row['date'] ."</td>
        </tr>";
    }

?>
<form id="formCom" action="" method='POST'>
            <label for="">Ajouter un commentaire</label><br>
            <textarea name="comment" id="" cols="30" rows="10"></textarea><br>
            <input type="submit" name="postComment" value="commenter">
        </form>


       
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

