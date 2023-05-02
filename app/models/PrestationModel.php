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


    public function getPrestationsNomCategorie()
    {
        
        $contact = $this->_db->query("SELECT DISTINCT nom , categorie FROM prestations ORDER BY categorie");
        $res = $contact->getResult();
        $array1 = array();
        $array2 = array();
        
        for ($i=0; $i < sizeof($res); $i++) { 
            array_push($array1 , $res[$i]->nom);
            array_push($array2, $res[$i]->categorie);
        }
        $array =array($array1,$array2);
        return $array;
    }

    public function getPrestationsNom()
    {
        $contact = $this->_db->query("SELECT DISTINCT nom  FROM prestations");
        $res = $contact->getResult();
        $array =array();
        for ($i=0; $i < sizeof($res); $i++) { 
            array_push($array , $res[$i]->nom);
        }
        return $array;
    }

    public function getCategoriesNom()
    {
        $contact = $this->_db->query("SELECT DISTINCT categorie FROM prestations");
        return $contact->getResult();
    }
    

    public function getPrestation($IdPrestation)
    {
        $contact = $this->_db->query("SELECT * FROM prestations WHERE id_prestation=" . $IdPrestation);
        $res = $contact->getFirstResult();
        return $res;
    }

    public function getPrestations($id)
    {
        $contact = $this->_db->query("SELECT * FROM `prestations` p INNER JOIN `banque_prestation` bp ON p.id_prestation = bp.id_prestation  WHERE (id_banque=?) ORDER BY categorie , nom",array($id),get_class($this));
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
