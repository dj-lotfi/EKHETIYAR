<?php

class Comparatif extends Controller 
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $this->view->render('comparatif/index');
    }
}