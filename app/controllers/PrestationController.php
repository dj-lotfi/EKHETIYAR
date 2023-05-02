<?php 
class PrestationController extends Controller {
    private $model ;
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->model = $this->load_model('PrestationModel');
        $this->view = new PrestationView($this);
        $this->view->setLayout('default');
    }

    public function getPrestationsNom()
    {
        return $this->model->getPrestationsNom();
    }

    public function getCategoriesNom()
    {
        return $this->model->getCategoriesNom();
    }

    public function getPrestationsNomCategorie ()
    {
        return $this->model->getPrestationsNomCategorie();
    }

    public function indexaction() {
        $this->view->render();
    }

    public function getPrestationsById($id)
    {
        return $this->model->getPrestations($id);
    }

    public function displayPrestation($id)
    {
        $this->view->displayPrestation($id);
    }
    
}