<?php

class HomeView extends View{// bien dire que c'est une class enfant de View pour pouvoir réutiliser le header tout sa . 

// mettre en commentaire ici utile lors d'une connection . 
    /**
     * Construction de la page d'accueil
     * 
     * @return void
     */
    public function home(){// on peut rappeler toutes les méthodes home pour y faire appel. 
        $this->page = str_replace("{title}","Solutio-Coaching",$this->page);//remplace le titre du site. pas obliger 
        // $this->page .= "<h1>Bienvenue</h1>";
        $this->page .= file_get_contents('Html/home.html');
        $this->display();// cette ligne doit apparaitre a chaque fin de class view. pour le header 
    }

}