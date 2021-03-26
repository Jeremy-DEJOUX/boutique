<?php
require_once('../function/db.php');
$database=('../function/db.php');


?>
<form method="post">

    <input type='text' name='search' placeholder='Search'>
    <input type="submit" name="submit-search" value="search">

</form>
<div class="article-container">

<?php

    if(isset($_POST['submit-search'])){
        $search = $_POST['search'];
        $sql = "SELECT * FROM produits WHERE nom LIKE '%$search%' OR
        description LIKE '%$search%' OR prix LIKE '%$search%'";
        $stmt=connect()->prepare($sql);
        $stmt->execute();
        $queryResult = $stmt->fetchAll();
        var_dump($queryResult);

        if(COUNT($queryResult) > 0){
            foreach ($queryResult as $key) {
                echo $key['nom'];
                echo $key['description'];
                echo $key['prix'];
            }
        }
        else{
            echo "no results";
        }
    }

?>

</div>