<?php
namespace App\Controller; 
// class construction habituelle 
use App\Model\Model;
use App\View\View ;
abstract class Controller{

    protected $model;
    protected $paramGet;
    protected $paramPost;
    protected $twig;

    public function __construct(){
        if(!empty($_GET)){
            foreach ($_GET as $key => $value) {
                $this->paramGet[$key] = $this->protected_values($value);
            }
        }

        if(!empty($_POST)){
            foreach ($_POST as $key => $value) {
                $this->paramPost[$key] = $this->protected_values($value);
            }
        }

        if (isset($this->paramPost["action"])){
            $method=$this->paramPost["action"];
            $message = $this->model->$method($this->paramPost);
            $this->view->message($message);
        }
        if (isset($this->paramPost["id"])){
            $method=$this->paramPost["id"];
            $message = $this->model->$method($this->paramPost);
            $this->view->message($message);
        }
        // if (isset($this->paramGet["id"])){
        //     $method=$this->paramGet["id"];
        //     $message = $this->model->$method($this->paramGet);
        //     $this->view->message($message);
        // }

        $loader = new \Twig\Loader\FilesystemLoader('../public/Html/');
        $this->twig = new \Twig\Environment($loader);

    }

    private function protected_values($values){
        $values = trim($values);
        $values = stripslashes($values);
        $values = htmlspecialchars($values);
        return $values;
    }
}