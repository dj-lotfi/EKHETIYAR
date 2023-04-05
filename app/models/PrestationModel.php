<?php
class PrestationModel extends Model
{
    public function __construct()
    {
        $table = "Prestations";
        parent::__construct($table);
    }
    /*
    
    */
    public function getPrestation($IdPrestation)
    {
        $contact = $this->_db->query("SELECT * FROM Prestation WHERE id_prestation=" . $IdPrestation);
        $res = $contact->getFirstResult();
        return $res;
    }
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
}