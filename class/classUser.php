<?php 

class User
{
    private $id;
    public $login;
    public $password;
    public $email;
    public $db;
    private $id_droits;

    public function __construct()
    {
        $this->db = connect();
    }
// ----------------------------- CONNEXION --------------------------------------

    public function ConnectUser($login, $password)
    {
// On prépare la requête, on l'execute puis on fait un fetch pour récupérer les infos
        $ConnectUser = $this->db->prepare("SELECT * FROM user WHERE login = :login");
        $ConnectUser->bindValue(':login', $login, PDO::PARAM_STR);
        $ConnectUser->execute();
        $user = $ConnectUser-fetch(PDO::FETCH_ASSOC);
// si le fetch récupère quelque chose, alors :
        if(!empty($user))
        {
            if(password_verify($password, $user['password']))
            {
                $this->id = $user['id'];
                $this->login = $user['login'];
                $this->password = $user['password'];
                $_SESSION['id_droits'] = $user['id_droits'];
                $_SESSION['utilisateur'] = $user;
                $_SESSION['id'] = $user['id'];
// on regroupe le resultat du fetch dans un tableau de session
                $_SESSION['utilisateur'] = [
                    'id' =>
                        $this->id,
                    'login' =>
                        $this->login,
                    'password' =>
                        $this->password
                ];
                header('location:../index.php');

            }
            else {
                echo "Le login ou le mot de passe est erroné.";
            }
        }
            else {
                echo "Le login ou le mot de passe est erroné.";
            }
    }
// ---------------------------------- DECONNEXION -----------------------------

    public function Disconnect(){

        session_unset();
        session_destroy();
        header('location:../pages/profil.php'); // ou autres pages 

    }
// ----------------------------------------- UPDATE ------------------------------------------------//
    function profile($login, $email, $password, $confirmPW)// intégrer e-mail
    {; 
        $login =  htmlspecialchars(trim($login));
        $email = htmlspecialchars(trim($email));
        $password =  htmlspecialchars(trim($password));
        $confirmPW =  htmlspecialchars(trim($confirmPW));

        if (!empty($login) && !empty($email) && !empty($password) && !empty($confirmPW)){;

            if ($confirmPW==$password) {
                $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
                $update = ($this->db)->prepare("UPDATE user SET login = :login, password = :cryptedpass, email= :mail WHERE id = :myID"); 
                $update->bindValue(":login", $login, PDO::PARAM_STR);
                $update->bindValue(":cryptedpass",$cryptedpass, PDO::PARAM_STR);
                $update->bindValue(":myID", $_SESSION['utilisateur']['id'], PDO::PARAM_INT);
                $update->bindValue(":mail",$email, PDO::PARAM_STR);
                
                $update->execute(); 
            
            } 
            else  $error_log="Confirmation du mot de passe incorrect";
        }
        else $error_log = "veuillez remplir les champs";
     
     if (isset ($error_log)) {
        return $error_log;
    }

    }
}
?>