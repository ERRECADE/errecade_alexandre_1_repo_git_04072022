<?php
namespace App\Model;

// connexion base de donnés 
abstract class Model {

    protected $connexion;
    protected $requete;

    public function __construct(){

        // if (!defined('constant')) define('SERVER',"localhost");
        // if (!defined('constant')) define('USER',"root");
        // if (!defined('constant')) define('PASSWORD',"");
        // if (!defined('constant')) define('BASE',"errecade_projet_5");
        //     define('SERVER',"localhost");
        //     //define('PORT',"3306");
        //     define('USER',"root");
        //     define('PASSWORD',"");
        //     define('BASE',"errecade_projet_5");

        try {
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
