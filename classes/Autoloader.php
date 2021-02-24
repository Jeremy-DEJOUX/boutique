<?php

namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        //On récupère la totalité du namespace de la class concerné

        //On retire App\ du namespace
        $class = str_replace(__NAMESPACE__ . '\\', '', $class); 

        //On remplace les \ par des /
        $class = str_replace('\\', '/', $class);

        $fichier = __DIR__ . '/' . $class . '.php';
        //On verifie si le fichier existence
        if (file_exists($fichier)) {
            require_once $fichier;
        }else
        {
            echo "Le fichier que vous essayez de charger n'existe pas";
        }
    }
}