<?php

class Comment{

    private $id;
    public $comment;
    private $idProd;
    public $date;
    private $idUser;


    public function __construct(){
        $this->db = connect();
    }

//------------Ajout de commentaire-------------------
    public function postComment($login, $comment){
        $errorCom = null;
        $secureComment = htmlspecialchars(trim($comment));

        if(!empty($comment)){
            $comLength = strlen($comment);

            if(($comLength < 240)){
                $insertCom = $this->db->prepare("INSERT INTO commentaire (id_user, commentaire, idProd, date) VALUES (:login, :commentaire, ;id_article, NOW())");
                $insertCom->bindValue(":login", $login['id'], PDO::PARAM_INT);
                $insertCom->bindValue(":commentaire", $secureComment, PDO::PARAM_STR);
                $insertCom->bindValue(":idProd", $_GET['id'], PDO::PARAM_INT);
                $insertCom->execute();
            }
            else{
                $errorCom = "Max comment 240 characters";
            }
        }
        echo $errorCom;
    }
//---------------------------------------------display commentaire--------------------------

    public function displayComment($id){
        $comment = $this->db->prepare("SELECT c.commentaire, c.date, c.id_user, c.id_produit, p.id, u.login FROM commentaires c INNER JOIN produits p ON c.id_produits = p.id INNER JOIN user u ON c.id_user = u.id WHERE p.id = :id");    
        $comment->bindValue(':id', $id, PDO::PARAM_INT);
        $comment->execute();
        $result = $comment->fetchAll();
        $_SESSION['commentaire'] = $result;
    }
}
?>