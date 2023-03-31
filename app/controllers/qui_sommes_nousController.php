<?php

class Qui_sommes_nousController extends Controller 
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $test = new PrestationModel();
        for ($i =0 ; $i<=20;$i++){
        $res = $test->getPrestations($i);
        var_dump($res);
        }
        $this->view->render('qui_sommes_nous');
        //dnd($res);
        
        
    }
}