<?php

namespace App\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * page d'acceuil
     *
     * @return void
     */
    public function indexAction()
    {
        echo $this->twig->render('home.html.twig');
    }
}
