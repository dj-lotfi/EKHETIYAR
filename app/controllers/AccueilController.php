<?php

class AccueilController extends Controller 
{
    private $model ;
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        //$this->load_model('AccueilModel');
        $this->view->setLayout('default');
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
        $model = new AccueilModel();
        $this->load_model('AccueilModel');
        //require "app\models\AccueilModel.php";

        $_SESSION['res']=$model->getBanque($db,1);
        //require_once("app\Views\accueil\index.php");


        $this->view->render('accueil');
    }

}
