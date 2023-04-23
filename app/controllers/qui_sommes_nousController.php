<?php

class Qui_sommes_nousController extends Controller 
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->view = new qui_sommes_nousView($this);
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $this->view->render();
    }
}