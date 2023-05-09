<?php

class Qui_sommes_nousController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        //$this->model = $this->load_model('qui_sommes_nousModel');
        $this->view = new qui_sommes_nousView($this);
        $this->view->setLayout('default');
    }


    public function indexAction() //nom_de_la_method+Action
    {
        $this->view->render();
    }

}
?>