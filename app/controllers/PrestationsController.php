<?php 
class PrestationsController extends Controller {
    private $model ;
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        //$this->load_model('AccueilModel');
        $this->view->setLayout('default');
    }

    public function indexaction() {
        $this->view->render('prestations');
    }
}





?>