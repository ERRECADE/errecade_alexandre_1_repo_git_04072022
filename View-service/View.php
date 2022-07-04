<?php

abstract class View{

    protected $page;

    public function __construct(){
        $this->page = file_get_contents('Html/header.html');
        $this->page .= file_get_contents('Html/nav.html'); // ne pas metrte si nav dans le header. 
    }

    /**
     * Construction du pied de page
     * 
     * @return void
     */
    public function display(){
        $this->page .= file_get_contents("Html/footer.html");
        echo $this->page;
    }
    //message retour pour revenir sur bonne page , utilisation quand on utilise la base de donnés . a voir si on le mais ici ou sur le site liée. 
    public function message($response){
        //mettre bon titre dans les ""
        $this->page = str_replace("{title}","",$this->page);
        switch ($response) {
            case 'succes':
                $this->page .= '<div class="alert alert-success" role="alert">
                L\'action est une réussite !
              </div>';
                break;
            case 'failed':
                $this->page .= '<div class="alert alert-success" role="alert">
                L\'action n\'est pas une réussite !
                </div>';
                break;
        }
    }
    
}


