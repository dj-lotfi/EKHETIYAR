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
        
        
        
        if (isset($_POST['Sort']) && isset($_POST['Sortasc_desc'])) {
            $order = $_POST['Sort'];
            $acs_desc = ($_POST['Sortasc_desc'] == 'DESC') ? 2 : 1 ;
        } else {
            $order = 'alphabetical';
            $acs_desc = '1';

        }
        

        $this->view->displayAllBanques($order,$acs_desc);
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
        if ($order == 'alphabetical') {
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

    public function getFilter($p,$min,$max)
    {
        $f = array();
        $res = array();

        if (count($p)>0) {
            $f = $this->model->getFilter($p[0],$min[0],$max[0]);

            for ($i=1; $i < count($p); $i++) { 
                $f = array_intersect( $f , $this->model->getFilter($p[$i],$min[$i],$max[$i]) );
            }
            
            $res = $f;

        } else {
            $f = $this->getAllBanques();
            foreach ($f as $key => $value) {
                if ($value != null) {
                    array_push($res,$value->getId_banque());
                }
                
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

    public function filtercollecter()
    {
        $pController = new PrestationController('prestation','');

        $t = array(array(),array(),array());

        $prestations = array(array(),array());
        $prestations = $pController->getPrestationsNomCategorie();


        foreach ($_POST as $key => $value) {
            if ($key != 'Sortasc_desc' && $key != 'Sort') {
                $keyEx = explode('_', $key);
                
                if ( $keyEx[0] == 'filter' && ( $_POST['low-price_'.$keyEx[1].'_'.$keyEx[2]] != '' || $_POST['high-price_'.$keyEx[1].'_'.$keyEx[2]] != '' )) {

                    array_push($t[0],$_POST[$key]);
                    array_push($t[1],$_POST['low-price_'.$keyEx[1].'_'.$keyEx[2]]);
                    array_push($t[2],$_POST['high-price_'.$keyEx[1].'_'.$keyEx[2]]);

                    unset($_POST[$key]);
                    unset($_POST['low-price_'.$keyEx[1].'_'.$keyEx[2]]);
                    unset($_POST['high-price_'.$keyEx[1].'_'.$keyEx[2]]);

                } 
                

            }
        }

        foreach ($_POST as $key => $value) {
            if ($key != 'Sortasc_desc' && $key != 'Sort') {
                $keyEx = explode('_', $key);
                if ( $keyEx[0] == 'categorie' ) {

                    foreach ($_POST as $k => $v) {
                        if ($k != 'Sortasc_desc' && $k != 'Sort') {
                            $kEx = explode('_', $k);
                            if ( $kEx[0] != 'categorie' && $keyEx[1] == $kEx[1] && ($_POST['low-price_'.$kEx[1].'_'.$kEx[2]] != '' || $_POST['high-price_'.$kEx[1].'_'.$kEx[2]]  != '' )) {
                                array_push($t[0],$prestations[0][$kEx[2]]);
                                array_push($t[1],$_POST['low-price_'.$kEx[1].'_'.$kEx[2]]);
                                array_push($t[2],$_POST['high-price_'.$kEx[1].'_'.$kEx[2]]);
                            }
                            
                        }
                    }

                }
            }
            
        }
        return $t;
    }
        
}