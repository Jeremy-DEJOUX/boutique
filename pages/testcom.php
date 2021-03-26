<?php

$database = ("../functions/db.php");
require_once("../functions/db.php");
require_once('../class/classCommentaire.php');

$login = $_SESSION['user'];
if(isset($_POST["postComment"])){
    $comment = new Comment;
    $comment->postComment($login, $_POST['comment']);
}
$comment= new Comment;
$comment->displayComment($_GET['id']);
?>
