<?php

class AccueilController extends Controller 
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
            'conditions' => "n > ?",
            'bind' => ['50'],
            'order' => "last",
        ];
        dnd($db->findFirst('test4',$fields));
        $this->view->render('accueil/index');
    }
}
