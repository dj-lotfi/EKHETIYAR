<?php
class BanqueModel extends Model
{
    private $table = 'banques';
    public function __construct()
    {
        //$table = 'Banques';
        parent::__construct($this->table);
    }

    public function getId_banque()
    {
        return $this->id_banque;
    }

    public function getBanknames()
    {
        $contact = $this->_db->query("SELECT `nom` , `id_banque` , `logo` FROM banques ORDER BY `nom`");
        $res = $contact->getResult();
        return $res;
    }

    public function getBanque($bank)
    {
        $contact = $this->_db->query("select * from banques where id_banque=" . $bank);
        $res = $contact->getFirstResult();
        return $res;
    } 

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

    public function getAdresse_siege_social()
    {
        return $this->adresse_siege_social;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function getSite_banque()
    {
        return $this->site_banque;
    }

    public function getLienmap()
    {
        return $this->lienmap;
    }

    public function getAllBanques()
    {
        return $this->find(array('order' => 'id_banque'));
    }

    public function getAlphabeticalOrder($asc_desc)
    {
        if ($asc_desc == 'ASC') {
            $int = 1;
            $o = $this->_db->query("SELECT id_banque FROM `banques` b ORDER BY `nom` ASC");
        } elseif ($asc_desc == 'DESC') {
            $o = $this->_db->query("SELECT id_banque  FROM `banques` b ORDER BY `nom` DESC");
        } else {
            return null;
        }
        return $o->getResult();
    }

    public function getFilter($p, $min, $max)
    {        
        //$o = $this->_db->query('SELECT bp.id_banque FROM `banque_prestation` bp INNER JOIN `prestations` p ON bp.id_prestation = p.id_prestation WHERE p.nom = ? AND (p.prix / p.iteration BETWEEN ? AND ? ) AND p.prix IS NOT NULL AND p.iteration IS NOT NULL', array($p, $min, $max),false  );
        if ($min != '' && $max != '') {
            $o = $this->_db->query('SELECT * FROM `banque_prestation` bp INNER JOIN `prestations` p ON bp.id_prestation = p.id_prestation WHERE p.nom = ? AND ( (p.prix * p.iteration) BETWEEN ? AND ? ) AND p.prix IS NOT NULL', array($p, $min, $max),get_class($this)  );
        } elseif ($min != '' && $max == '') {
            $o = $this->_db->query('SELECT * FROM `banque_prestation` bp INNER JOIN `prestations` p ON bp.id_prestation = p.id_prestation WHERE p.nom = ? AND (p.prix * p.iteration >= ?) AND p.prix IS NOT NULL', array($p, $min),get_class($this)  );
        } elseif ($min == '' && $max != '') {
            $o = $this->_db->query('SELECT * FROM `banque_prestation` bp INNER JOIN `prestations` p ON bp.id_prestation = p.id_prestation WHERE p.nom = ? AND (p.prix * p.iteration <= ?) AND p.prix IS NOT NULL', array($p, $max),get_class($this)  );
        }

        return $o->getResult();
    }

    public function getOtherOrder($order, $asc_desc)
    {
        if ($asc_desc == 'ASC') {
            //$o = $this->_db->query("SELECT a.id_banque FROM (SELECT  (bp.id_banque), p.prix , p.iteration FROM `banque_prestation` bp INNER JOIN `prestations` p ON p.id_prestation = bp.id_prestation WHERE p.nom = ? ) a INNER JOIN banques ON a.id_banque = banques.id_banque ORDER BY (a.prix / a.iteration) ASC", array($order), false);
            $o = $this->_db->query("SELECT a.id_banque FROM (SELECT  (bp.id_banque), p.prix , p.iteration FROM `banque_prestation` bp INNER JOIN `prestations` p ON p.id_prestation = bp.id_prestation WHERE p.nom = ? ) a INNER JOIN banques ON a.id_banque = banques.id_banque ORDER BY (a.prix * a.iteration ) ASC", array($order), get_class($this));

            //$no = $this->_db->query("SELECT a.id_banque FROM (SELECT  (bp.id_banque) FROM `banque_prestation` bp INNER JOIN `prestations` p ON p.id_prestation = bp.id_prestation WHERE p.nom <> ? ) a INNER JOIN banques ON a.id_banque = banques.id_banque ORDER BY a.nom  ",array($order),false);

        } elseif ($asc_desc == 'DESC') {
            //$o = $this->_db->query("SELECT a.id_banque FROM (SELECT  (bp.id_banque), p.prix , p.iteration FROM `banque_prestation` bp INNER JOIN `prestations` p ON p.id_prestation = bp.id_prestation WHERE p.nom = ? ) a INNER JOIN banques ON a.id_banque = banques.id_banque ORDER BY (a.prix / a.iteration) DESC", array($order), false);
            $o = $this->_db->query("SELECT a.id_banque FROM (SELECT  (bp.id_banque), p.prix , p.iteration FROM `banque_prestation` bp INNER JOIN `prestations` p ON p.id_prestation = bp.id_prestation WHERE p.nom = ? ) a INNER JOIN banques ON a.id_banque = banques.id_banque ORDER BY (a.prix * a.iteration ) DESC", array($order), get_class($this));

            //$no = $this->_db->query("SELECT a.id_banque FROM (SELECT  (bp.id_banque) FROM `banque_prestation` bp INNER JOIN `prestations` p ON p.id_prestation = bp.id_prestation WHERE p.nom <> ? ) a INNER JOIN banques ON a.id_banque = banques.id_banque ORDER BY a.nom  ",array($order),false);   
        } else {
            return null;
        }

        $a = array();
        $a = $o->getResult();
        //array_push($a,null);
        //return array_merge($a,$no->getResult());
        return $a;
    }
}
?>
