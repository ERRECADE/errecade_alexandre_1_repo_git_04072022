<?php
namespace App\Model;

// connexion base de donnés 
abstract class Model {
       // mettre bonne base
    protected $connexion;
    protected $requete;

    public function __construct(){//mettre bonne  base 
            define('SERVER',"localhost");
            //define('PORT',"3306");
            define('USER',"root");
            define('PASSWORD',"");
            define('BASE',"errecade_projet_5");

        try {
                error_log('la');
                $this->connexion = new \PDO
                ("mysql:host=" .
                SERVER . ";dbname=" .
                BASE, USER, PASSWORD);
                // Activation des erreurs PDO
                $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
                $this->connexion->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
                die('Erreur:' . $e->getMessage());
        }
    }
}
