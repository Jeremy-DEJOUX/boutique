<?php

function test($nom = []){
    foreach($nom as $name){
        echo $name;
    }

}

if (isset($_POST["button"])) {
    test([$_POST["1"], $_POST["2"], $_POST["3"]]);
}

?>

<form action="" method="post">
    <input type="number" name="1" id="">
    <input type="number" name="2" id="">
    <input type="number" name="3" id="">
    <input type="submit" name="button" value="Envoyer">
</form>