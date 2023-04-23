<?php

class ErrorController extends Controller {

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view = new ErrorView($this);
        $this->view->setLayout('default');
    }

    public function IndexAction()
    {
        $this->view->render();
    }


}