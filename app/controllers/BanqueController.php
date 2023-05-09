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
        
/*
        echo '<p>'.$order.'</p>';
        echo '<p>'.$acs_desc.'</p>';

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
*/

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

            for ($i=1; $i < count($p)-1; $i++) { 
                $f = array_intersect( $f , $this->model->getFilter($p[$i],$min[$i],$max[$i]) );
            }

            foreach ($f as $key => $value) {
                array_push($res,$value->getId_banque());
            }

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

        $categories = array();

        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 9) == 'categorie') {
                $categories[$key] = $value;
            } 
        }

        

        foreach ($categories as $key => $value) {

                $min_max = array(array(),array());
            
                $cid = ltrim($key,'categorie_');
    
                foreach ($_POST as $k => $v) {
        
                    if ($k != 'Sortasc_desc' && $k != 'Sort') {
                        $parts = explode('_', $k);
    
                        if ($parts[0] . '_' . $parts[1] . '_' == 'high-price_' . $cid . '_') {
                            $min_max[1][$parts[2]] = $v;
                        }
                        
                        if ($parts[0] . '_' . $parts[1] . '_' == 'low-price_' . $cid . '_') {
                            $min_max[0][$parts[2]] = $v;
                        }
                    }

    
                }
    
                foreach ($min_max[0] as $k => $v) {
                    if ($min_max[0][$k] != '' ||  $min_max[1][$k] != '') {
                        array_push($t[0],$prestations[0][$k]);
                        array_push($t[1],$min_max[0][$k]);
                        array_push($t[2],$min_max[1][$k]);
                    }
                }
        }
        foreach ($_POST as $key => $value) {
            if ($key != 'Sortasc_desc' && $key != 'Sort') {
                $parts = explode('_', $key);
            
                if ($parts[0] == 'filter') {
    
                    if(isset($_POST['low-price'.'_'.$parts[1].'_'.$parts[2]]) || isset($_POST['high-price'.'_'.$parts[1].'_'.$parts[2]])){
                        array_push($t[0],$value);
                        array_push($t[1],$_POST['low-price'.'_'.$parts[1].'_'.$parts[2]]);
                        array_push($t[2],$_POST['high-price'.'_'.$parts[1].'_'.$parts[2]]);
                    }
                } 
            }

        }/*
        echo '<pre>';
        print_r($t);
        echo '</pre>';
        */

        return $t;
    }
        
}