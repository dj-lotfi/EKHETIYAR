<?php

class Error404Controller extends Controller {

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function IndexAction()
    {
        $this->view->render('error404');
    }


}