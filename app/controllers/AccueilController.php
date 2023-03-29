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
        //$db = DB::getInstance();
        /*$fields = [
            'conditions' => "n > ?",
            'bind' => ['50'],
            'order' => "last"
        ];
        dnd($db->findFirst('test4',$fields));*/
        //$model = new BanqueModel();
        //$_SESSION['res']=$model->getBanque(1);


        $this->view->render('accueil');
    }

}
