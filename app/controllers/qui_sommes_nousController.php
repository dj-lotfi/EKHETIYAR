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
        $db = DB::getInstance();
        $contact = $db->query("select * from A_propos;");
        $_SESSION['result'] = $contact->getFirstResult();
        //require_once("app\Views\qui_sommes_nous\index.php");
        $this->view->render('qui_sommes_nous');
        //dnd($res);
        
        
    }
}