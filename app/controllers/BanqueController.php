<?php

class BanqueController extends Controller 
{
    private $model;   

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->model = $this->load_model('BanqueModel');
        $this->view = new BanqueView($this);
        $this->view->setLayout('default');


        
    }

    public function getAllBanques()
    {
        return $this->model->getAllBanques();
    }

    public function displayAllBanques()
    {
        $this->view->displayAllBanques();
    }

    

}