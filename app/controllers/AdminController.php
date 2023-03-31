<?php
class AdminController extends Controller
{
    private $model;
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        //$this->load_model('AccueilModel');
        $this->view->setLayout('default');
    }

    public function indexAction()
    {
        $_SESSION['filedir'] = __FILE__;
        if (isset($_POST['submit'])) {

            $this->model = new BanqueModel();
            $this->model->addBanque(
                $_POST['fields']['nom'],
                $_POST['fields']['logo'],
                $_POST['fields']['adresse'],
                $_POST['fields']['telephone'],
                $_POST['fields']['fax'],
                $_POST['fields']['site'] ,
                $_POST['fields']['id']
            );
        } else {
            $this->view->render('admin');
        }
    }
}






?>