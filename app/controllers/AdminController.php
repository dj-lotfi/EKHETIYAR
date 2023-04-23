<?php
class AdminController extends Controller
{
    private $model;
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        //$this->load_model('AdminModel');
        $this->view = new AdminView($this);
        $this->view->setLayout('default');
    }

    public function indexAction()
    {
        $this->view->render();
    }
}