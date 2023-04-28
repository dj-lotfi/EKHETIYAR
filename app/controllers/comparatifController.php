<?php

class ComparatifController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);


        $this->view = new comparatifView($this);
        $this->view->setLayout('default');
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $this->view->renderHead();
        $this->view->renderBody();
        $this->view->renderFooter();
    }

    public function displayComparaison($bank1,$bank2){
        $this->view->displayComparaison($bank1,$bank2);
    }



    
}