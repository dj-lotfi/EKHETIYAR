<?php

class AccueilController extends Controller 
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function getBanque($db ,$bank){
        $contact = $db->query("select * from banques where id_banque=" . $bank);
        $res = $contact->getFirstResult();
        return $res;
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $db = DB::getInstance();
        /*$fields = [
            'conditions' => "n > ?",
            'bind' => ['50'],
            'order' => "last"
        ];
        dnd($db->findFirst('test4',$fields));*/
        $_SESSION['res']=$this->getBanque($db,1);
        //require_once("app\Views\accueil\index.php");


        $this->view->render('accueil');
    }

}
