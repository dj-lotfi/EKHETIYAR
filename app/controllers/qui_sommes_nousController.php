<?php

class Qui_sommes_nousController extends Controller
{

    private $model ;

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->model = $this->load_model('qui_sommes_nousModel');
        $this->view = new qui_sommes_nousView($this);
        $this->view->setLayout('default');
    }
    
    public function indexAction() //nom_de_la_method+Action
    {
        $this->view->render();
    }
    
    public function getVision()
    {
        return $this->model->getVision();
    }

    public function getProp()
    {
        return $this->model->getProp();
    }

    public function getFonctionnement()
    {
        return $this->model-> getFonctionnement();
    }

    public function getEmail()
    {
        return $this->model->getEmail();
    }

    public function getTelephone()
    {
        return $this->model->getTelephone();
    }

    public function getFirstHalfContact()
    {
        return $this->model->getContacts();
    }

    public function getNom()
    {
        return $this->model->getNom();
    }

    public function getPrenom()
    {
        return $this->model->getPrenom();
    }

    public function getSecondPrenom()
    {
        return $this->model->getSecondPrenom();
    }

    public function getCtry_code()
    {
        return $this->model->getCtry_code();
    }
    public function getTel()
    {
        return $this->model->getTel();
    }

    public function getAvatar()
    {
        return $this->model->getAvatar();
    }

    public function getBackground()
    {
        return $this->model->getBackground();
    }

    public function getThemeColor()
    {
        return $this->model->getThemeColor();
    }

    public function getContacts()
    {
        return $this->model->getContacts();
    }

    public function getApropos()
    {
        return $this->model->getQSN();
    }

}
?>