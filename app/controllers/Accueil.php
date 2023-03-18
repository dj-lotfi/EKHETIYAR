<?php

class Accueil extends Controller 
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $db = DB::getInstance();
        $fields = [
            'n' => '46',
            'last' => '2'
        ];
        $te = $db->delete('test4',1);
        $this->view->render('accueil/index');
    }
}
