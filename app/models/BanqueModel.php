<?php 
class BanqueModel extends Model {
    private $table = 'banques';
    public function __construct(){
        //$table = 'Banques';
        parent::__construct($this->table);
    }

public function getBanque($bank){
    $contact = $this->_db->query("select * from banques where id_banque=" . $bank);
    $res = $contact->getFirstResult();
    return $res;
}/*

public function addBanque($nom , $logo , $adr , $tel ,$fax ,$site ,$id=null){
    if ($id == null ){
    $banque = array(
        "nom"=> $nom ,
        "logo"=> $logo ,
        "adresse_siege_social"=> $adr , 
        "telephone" => $tel , 
        "fax" => $fax , 
        "site_banque" => $site
    );   
    }
    else {
        $banque = array(
            "id_banque"=>$id ,
            "nom"=> $nom ,
            "logo"=> $logo ,
            "adresse_siege_social"=> $adr , 
            "telephone" => $tel , 
            "fax" => $fax , 
            "site_banque" => $site
        );

    }

    return $this->insert($banque); 

}
    public function addBanque($nom , $logo , $adr , $tel ,$fax ,$site ,$id=null){
        if ($id == null){
            $this->_db->query("INSERT INTO {$this->table} (nom ,logo , adresse_siege_social , telephone , fax , site ) 
            VALUES ({$nom}, {$logo}, {$adr}, {$tel}, {$fax}, {$site} )");
        }
        else {
            $this->_db->query("INSERT INTO {$this->table} ( id_banque ,nom ,logo , adresse_siege_social , telephone , fax , site ) 
            VALUES ({$id}, {$nom}, {$logo}, {$adr}, {$tel}, {$fax}, {$site} )");

        }
        
    }

    public function getLogo($idBank){
        $contact = $this->_db->query("select (`logo`) from banques where id_banque=" . $idBank);
        $res = $contact->getFirstResult();
        return $res;

    }
    public function getMap($idBank){
        $contact = $this->_db->query("select (`lienmap`) from banques where id_banque=" . $idBank);
        $res = $contact->getFirstResult();
        return $res;

    }
*/

public function getNom()
{
    return $this->nom;
}

public function getAbbr()
{
    return $this->abbreviation;
}

public function getLogo()
{
    return $this->logo;
}

public function getLienmap()
{
    return $this->lienmap;
}

public function getAdresse_siege_social()
{
    return $this->adresse_siege_social ;
}

public function getTelephone()
{
    return $this->telephone ;
}

public function getFax()
{
    return $this->fax ;
}

public function getSite_banque()
{
    return $this->site_banque ;
}

public function getAllBanques()
{
    return $this->find(array('order'=>'id_banque'));
}



}




 ?>