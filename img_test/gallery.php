<?php
    $_SESSION['username'] = "Admin";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <main>
        <section class="gallery-links">
                <div class="wrapper">
                    <h2>Gallery</h2>

                    <div class="gallery-container">
                        <?php
                            include_once 'includes/dbh.inc.php';

                            $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
                            $stmt = $conn->query($sql);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '
                                    <a href="#">
                                        <img src="img/gallery/'.$row["imgFullNameGallery"].'">
                                        <h3>' . $row["titleGallery"] . '</h3>
                                        <p>' . $row["descGallery"] . '</p>
                                    </a>';
                            }
                        ?>
                    </div>

                    <?php
                    if (isset($_SESSION['username'])){
                        echo '<div class="gallery-upload">
                        <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="filename" placeholder="File name...">
                            <input type="text" name="filetitle" placeholder="Image title...">
                            <input type="text" name="filedesc" placeholder="Image description...">
                            <input type="file" name="file">
                            <button type="submit" name="submit">UPLAOD</button>
                        </form>
                    </div>';
                    }
                    ?>
            </div>
        </section>
    </main>
</body>
</html>