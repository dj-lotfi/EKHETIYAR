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
        
        $contact = $this->_db->query("SELECT p.nom,c.nom_categorie FROM `prestations_details` p INNER JOIN `categories` c ON c.id_categorie = p.id_categorie AND pertinence = '1' ORDER BY c.nom_categorie , p.nom");
        $res = $contact->getResult();
        $array1 = array();
        $array2 = array();
        
        for ($i=0; $i < sizeof($res); $i++) { 
            array_push($array1 , $res[$i]->nom);
            array_push($array2, $res[$i]->nom_categorie);
        }
        $array =array($array1,$array2);
        return $array;
    }

    public function getPrestationsNom()
    {
        $contact = $this->_db->query("SELECT nom  FROM prestations_details WHERE pertinence = '1'");
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
        $contact = $this->_db->query("SELECT * FROM `prestations` p INNER JOIN `banque_prestation` bp ON p.id_prestation = bp.id_prestation INNER JOIN `devise` d ON d.id_devise=p.id_devise WHERE (id_banque=?) ORDER BY categorie, nom",array($id),get_class($this));
        return $contact->getResult();
    }
    public function getPrestationscom($id)
    {
        $contact = $this->_db->query("SELECT * FROM `prestations` p INNER JOIN `banque_prestation` bp ON p.id_prestation = bp.id_prestation INNER JOIN `devise` d ON d.id_devise=p.id_devise WHERE (id_banque=?) ORDER BY nom",array($id),get_class($this));
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

    public function generateid()
    {
        $i = 10 ; 
        $continue = true ; //DB_USER_ADMIN
        $conn = mysqli_connect(DB_HOST_ADMIN, DB_USER_ADMIN, DB_PASSWORD_ADMIN, DB_NAME_ADMIN);
        while($continue)
        {
            $sql = "SELECT COUNT(*) AS count FROM prestations WHERE id_prestation = {$i}";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_fetch_assoc($result)['count'];
            if($count==0)$continue = false  ;
            else $i++ ;
        }
        mysqli_close($conn);
        return $i ;
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

    public function getiso()
    {
        return $this->iso ;
    }
    public function getDescription()
    {
        return $this->description ;
    }
}
