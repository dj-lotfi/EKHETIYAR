<?php
class PrestationAdminModel extends Model_admin
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

    public function getPrestations($id)
    {
        $contact = $this->_db->query("SELECT * FROM `prestations` p INNER JOIN `banque_prestation` bp ON p.id_prestation = bp.id_prestation  WHERE (id_banque=?) ORDER BY categorie , nom",array($id),get_class($this));
        return $contact->getResult();
    }
    public function getAllCategories()
    {
        $contact = $this->_db->query("SELECT DISTINCT categorie FROM prestations");
        return $contact->getResult();       
    }
    public function prestations()
    {
        $contact = $this->_db->query("SELECT DISTINCT nom FROM prestations");
        return $contact->getResult();       
    }
    public function getId()
    {
        return $this->id_prestation;
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
    public function getDescription()
    {
        return $this->description ;
    }
}