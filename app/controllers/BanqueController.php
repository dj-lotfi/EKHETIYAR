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
        $res = $this->model->getAllBanques();

        $f = array();

        for ($i=0; $i < count($res); $i++) { 
            $f[$res[$i]->getId_banque()]=$res[$i];
        }

        return $f;
    }

    public function displayAllBanques()
    {
        $this->view->displayAllBanques();
    }

    public function getOrder($order,$asc_desc_int)
    //$asc_desc =>  1=ASC | 2 = DESC
    {
        if($asc_desc_int == 1) {
            $asc_desc = 'ASC';
        } elseif($asc_desc_int == 2) {
            $asc_desc = 'DESC';
        } else {
            return null ;
        }
        $o = array();
        if ($order == 'alphabetic') {
            $o = $this->alphabeticalOrder($asc_desc);
        } else {
            $o = $this->otherOrder($order,$asc_desc);
            
        }
        $res = array();
        for ($i=0; $i < count($o); $i++) { 
            foreach ($o[$i] as $key => $value) {
                array_push($res,$value);
            }
        }
        return $res ;           
    }

    public function getFilter()
    {
        //creat le tableau nom des prestation
        //creat le tableau min
        //creat le tableau max

        $p = array();
        $min = array();
        $max = array();

        $f = array();
        $f = $this->model->getFilter($p,$min,$max);

        $res = array();
        for ($i=0; $i < count($f); $i++) { 
            foreach ($f[$i] as $key => $value) {
                array_push($res,$value);
            }
        }
        return $res ;


    }
    

    
    public function otherOrder($order,$asc_dec)
    {
        return $this->model->getOtherOrder($order,$asc_dec);
    }
    

    public function alphabeticalOrder($asc_dec)
    {
        return $this->model->getAlphabeticalOrder($asc_dec);
    }

    

}