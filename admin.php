<?php
require_once'function/db.php';
require_once'classAdmin.php';
$newUser = new Admin;

if (isset($_POST['Update'])) {
    $newUser->updateNewUser($_POST['login'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['droits']);

}elseif(isset($_POST['Droits']))
{
    $newUser ->updateRights($_POST['login'],$_POST['droits']);

}elseif(isset($_POST['Create']))
{
    $newUser ->createNewUser($_POST['login'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['droits']);

}else {
    echo "Que voulez vous faire";
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
        <form action="" method="POST">
            <label for="login">Login</label>
            <input type="text" name="login">

            <label for="email">Email</label>
            <input type="text" name="email">

            <label for="password">Password</label>
            <input type="password" name="password">

            <label for="confirmPassword">ConfirmPassword</label>
            <input type="password" name="confirmPassword">

            <label for="droits">Droits</label>
            <input type="number" name="droits">

            <input type="submit" value="Update" name="Update">
            <input type="submit" value="New Droits" name="Droits">
            <input type="submit" value="Create" name="Create">
        </form>
    </main>

</body>

</html>