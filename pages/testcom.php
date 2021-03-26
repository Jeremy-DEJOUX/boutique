<?php

$database = ("../function/db.php");
require_once("../function/db.php");
require_once('../class/classCommentaire.php');

//$login = $_SESSION['user'];
if(isset($_POST["postComment"])){
    $comment = new Comment;
    $comment->postComment($login, $_POST['comment']);
}
$comment= new Comment;
$comment->displayComment($_GET['id']);
?>
<form id="formCom" action="" method=POST>
            <label for="">Ajouter un commentaire</label><br>
            <textarea name="comment" id="" cols="30" rows="10"></textarea><br>
            <input type="submit" name="postComment" value="commenter">
        </form>