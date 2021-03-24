<?php
require_once('../function/db.php');
class Admin{
    public $login;
    public $password;
    public $id_dorits;

    public function __contruct(){
        $this->db = connect();
    }
//------------------------------------------------------Donné les droits -------------------------------------------------------------------------------------
    public function updateDroits($login, $id_droits){
        $query = $this->db->prepare("UPDATE utilisateur SET id_droits=:id WHERE id=:login")
        $query->bindValue(":id", $id_droits, PDO::PARAM_INT);
        $query->bindValue(":login", $login, PDO::PARAM_STR);
        $query->execute();
    }
    
    public function registerNewUser ($login, $email, $password, $confirmPW, $id_droits){

        $error_log = null;

        $login =  htmlspecialchars(trim($login));
        $email = htmlspecialchars(trim($email));
        $password =  htmlspecialchars(trim($password));
        $confirmPW =  htmlspecialchars(trim($confirmPW));
}
?>