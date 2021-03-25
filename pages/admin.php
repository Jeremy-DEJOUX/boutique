<?php
$database = ("../function/db.php");
require_once("../class/classAdmin.php");

//-----------------------chemin-----------------


require_once('header.php');
if(!isset($_SESSION['id_droits']) OR $_SESSION['id_droits'] != 1337){
   echo "Only admin can accest this page"; 
}
else{
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
    <?php
        if(isset($_POST['mod'])){
            $update = new Admin();
            $update->UpdateNewUser($_POST['moddingUser'], $_POST['UpdateLog'], $_POST['UpdateMail'], $_POST['updatePW'], $_POSt['updateCPW']);
        }
        if(isset($_POST['createUser'])){
            $create = new Admin();
            $create->registerNewUser($_POST['createLogin'], $_POST['eMail'], $_POST['createPW'], $_POST['confirmPW'], $_POST['droitsNewUser']);
        }
        if(isset($_POST['deleteUser'])){
            $delete = new Admin();
            $delete->deleteUser($_POST['moddingUser']);
        }

        ?>
    </main>
</body>
</html>

<?php
}
?>