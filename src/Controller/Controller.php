<?php
// class construction habituelle 
abstract class Controller{

    protected $model;
    protected $view;
    protected $paramGet;
    protected $paramPost;

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

    }

    private function protected_values($values){
        $values = trim($values);
        $values = stripslashes($values);
        $values = htmlspecialchars($values);
        return $values;
    }
}