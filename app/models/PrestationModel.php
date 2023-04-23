<?php
class PrestationModel extends Model
{
    public function __construct()
    {
        $table = "prestations";
        parent::__construct($table);
    }
    /*
    
    */


    public function getPrestationsNom()
    {
        
        $contact = $this->_db->query("SELECT DISTINCT nom FROM prestations");
        $res = $contact->getResult();
        $array =array();
        for ($i=0; $i < sizeof($res); $i++) { 
            array_push($array , $res[$i]->nom);
        }
        return $array;
    }

    /*
    public function FunctionName(Type $var = null)
    {
        # code...
    }
*/
    

    public function getPrestation($IdPrestation)
    {
        $contact = $this->_db->query("SELECT * FROM prestations WHERE id_prestation=" . $IdPrestation);
        $res = $contact->getFirstResult();
        return $res;
    }

/*
    public function getPrestations($IdBank)
    {
        // Banque_Prestation->id_banque->id_prestation
        $contact = $this->_db->query("SELECT * FROM banque_prestation WHERE id_banque=" . $IdBank);
        $res = $contact->getResult();
        for ($i = 0; $i < sizeof($res); $i++) {
            $pres = $this->getPrestation($res[$i]->id_prestation);
            $TabPrestation[$i] = $pres;
        }
        return $TabPrestation;
    }
*/

    public function getPrestations($id)
    {
        $contact = $this->_db->query("SELECT * FROM `prestations` p INNER JOIN `banque_prestation` bp ON p.id_prestation = bp.id_prestation  WHERE id_banque=" . $id . " ORDER BY categorie",[],get_class($this));
        return $contact->getResult();
    }

    public function getNom()
    {
        return $this->nom ;
    }

    public function getCategorie()
    {
        return $this->categorie ;
    }

    public function getPrix()
    {
        return $this->prix ;
    }

    public function getDateValeur()
    {
        return $this->date_valeur ;
    }

}
