<?php
class AdminModel extends Model_admin
{
    public $NombreBanque = 20;
    function __construct($i)
    {
        $this->_db = DB_admin::getInstance($i);
    }
    public function get($id, $table) // $table : le nom du tableau du dbb  
    {
        // geter du tous les tableaux 
        $this->_table = $table;
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        if ($table == "Agences" || $table == "Commentaires")
            $ind = "banque";
        else if ($table == "banques" || $table == "banque_prestation")
            $ind = "id_banque";
        else if ($table == "a_propos")
            $ind = "id";
        else
            $ind = "devise_id";
        if ($id != '*') {
            $contact = $this->_db->query("SELECT * FROM {$table} WHERE {$ind}=" . $id);
            $res = $contact->getFirstResult();
        } else {
            $contact = $this->_db->query("SELECT * FROM {$table}");
            $res = $contact->getResult();
        }
        return $res;
    }
    public function UpdateBank($bank)
    {
        if (isset($bank["id_banque"])) {
            $this->_table = 'banques';
            $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
            $this->update($bank['id_banque'], $bank, 'id_banque');
        }
    }
    public function AddBanque($bank)
    {
        if (isset($bank["id_banque"])) {
            $this->_table = 'banques';
            $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
            $this->insert($bank);
        }
        $this->NombreBanque = +1;
    }
    public function DeleteBank($IdBank)
    {
        $this->_table = 'banques';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete('id_banque', $IdBank);
        $this->DeletePrestationBanque($IdBank);
        //$this->DeleteCommentaireBanque($IdBank);
        //$this->DeleteAgenceBanque($IdBank);
        $this->NombreBanque = -1;
    }
    public function UpdatePrestation($Prestation)
    {
        $this->_table = 'prestations';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->update($Prestation['id_prestation'], $Prestation, 'id_prestation');
    }
    public function AddPrestation($prestation, $idbank)
    {
        $this->_table = 'prestations';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->insert($prestation);
        $this->_table = 'banque_prestation';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        if (isset($prestation["id_prestation"])) {
            $tab = array("id_banque" => $idbank, "id_prestation" => $prestation["id_prestation"]);
            $this->insert($tab);
        }
    }
    public function DeletePrestationCategorie($categorie)
    {
        $this->_table = 'prestations';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete('categorie', $categorie);
        $this->_table = 'banque_prestation';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));


    }
    public function DeletePrestationBanque($idbank)
    {
        $this->_table = 'banque_prestation';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $contact = $this->_db->query("SELECT * FROM banque_prestation WHERE id_banque=" . $idbank);
        $res = $contact->getResult();
        $this->delete('id_banque', $idbank);
        $this->_table = 'prestations';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        for ($i = 0; $i < sizeof($res); $i++) {
            $this->delete('id_prestation', $res[$i]->id_prestation);
        }
    }
    public function DeletePrestationId($id)
    {
        $this->_table = 'prestations';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete('id_prestation', $id);
        $this->_table = 'banque_prestation';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete('id_prestation', $id);
    }
    public function deleltecommentaire($idreveiw)
    {
        $this->_table = 'Commentaires';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete("id_commentaire", $idreveiw);
    }
    public function DeleteCommentaireBanque($idbank)
    {
        $this->_table = 'Commentaires';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete("banque", $idbank);
    }
    public function AddDevise($devise_id, $nom_devise, $code_ISO, $symbole)
    {
        $this->_table = 'Devise';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $Tab = array("devise_id" => $devise_id, "nom_devise" => $nom_devise, "code_ISO" => $code_ISO, "symbole" => $symbole);
        if ($this->findById($devise_id, "devise_id"))
            $this->update($devise_id, "devise_id", $Tab);
        else
            $this->insert($Tab);
    }
    public function DeleteDevise($devise_id)
    {
        $this->_table = 'Devise';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete("devise_id", $devise_id);
    }
    public function ModificationInfs($NewInfo)
    {
        $this->_table = 'a_propos';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->update(1, $NewInfo, "id");
    }

    public function getApropos()
    {
        $contact = $this->_db->query("select * from  a_propos");
        $res = $contact->getFirstResult();
        return $res;
    }
    /*public function UpdateAgence($Agence)
    {
        if (isset($bank["id_agence"])) {
            $this->_table = 'agences';
            $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
            $this->update($bank['id_agence'], $bank, 'id_agence');
        }
    }
    public function AddAgence($agence)
    {
        if (isset($bank["id_agence"])) {
            $this->_table = 'agences';
            $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
            $this->insert($agence);
        }
    }
    public function DeleteAgence($IdAgence)
    {
        $this->_table = 'agences';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete('id_agence', $IdAgence);
    }
    public function DeleteAgenceBanque($IdBank)
    {
        $this->_table = 'agences';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $this->delete('banque', $IdBank);
    }*/
    public function ChangeNomUtilisateur($username)
    {
        $this->_table = 'adminLogs';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $InfoAdmin = $this->findById(1, "id");
        $InfoAdmin["username"] = $username;
        $this->update(1, $InfoAdmin, "id");
    }
    public function ChangeMotPass($password)
    {
        $this->_table = 'adminLogs';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $InfoAdmin = $this->findById(1, "id");
        $InfoAdmin["password"] = $password;
        $this->update(1, $InfoAdmin, "id");
    }
    public function getMotPass()
    {
        $this->_table = 'adminLogs';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $InfoAdmin = $this->findById(1, "id");
        return $InfoAdmin["password"];
    }
    public function getNomUtilisateur()
    {
        $this->_table = 'adminLogs';
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
        $InfoAdmin = $this->findById(1, "id");
        return $InfoAdmin["username"];
    }
}