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
}
?>