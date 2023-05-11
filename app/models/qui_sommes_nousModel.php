<?php 
class qui_sommes_nousModel extends Model {
    private $table = 'a_propos';
    public function __construct(){
        parent::__construct($this->table);
    }

    public function getQSN(){
        $contact = $this->_db->query("select * from {$this->table};");
        return $contact->getFirstResult();
    }

    public function getVision()
    {
        return $this->vision;
    }

    public function getProp()
    {
        return $this->prop;
    }

    public function getFonctionnement()
    {
        return $this->fonctionnement;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getContacts()
    {
        $contact = $this->_db->query("select * from contacts_info ORDER BY nom ASC;");
        return $contact->getResult();
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getSecondPrenom()
    {
        return $this->{'2eme_prenom'};
    }

    public function getCtry_code()
    {
        return $this->ctry_code;
    }
    public function getTel()
    {
        return $this->tel;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getBackground()
    {
        return $this->background;
    }

    public function getThemeColor()
    {
        return $this->theme_color;
    }
}
?>