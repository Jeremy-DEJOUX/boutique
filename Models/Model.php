<?php

namespace App\Models;

use App\Db\Db;

class Model extends Db
{
    // Table de la base de données
    protected $table;

    //Instance de DB
    private $db;

    protected function requete(string $sql, array $attributs = null)
    {
        //On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On verifie si on a des attributs
        if($attributs !== null){
            //requête préparée
        }else{
            //Requete simple
        }
    }
}