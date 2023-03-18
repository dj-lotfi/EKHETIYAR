<?php

class DB  
{
    private static $_instance = null ;//la référance vers la bdd (static car instance de dbb unique pour chaque utilisateur)
    private $_pdo; //la connexion à la bdd
    private $_query, $_error = false, $_result, $_count = 0, $_lastInsertID = null;

    public function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {//assurer l'unicité de la bdd
            self::$_instance = new DB();
        } 
        return self::$_instance;
        
    }

    public function query($sql, $params = [])
    //fonction pour accérir des donnéescddepuis la bdd
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {//optimisation des requêtes (preparer) //$sql existe et prerare reussite
            $x =1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if(($this->_query)->execute()) {
                $this->_result = ($this->_query)->fetchAll(PDO::FETCH_OBJ);
                $this->_count =  $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();
            }else {
                $this->_error = true;
            }     
        }
        return $this; 
        
    }

    public function error(){
        return $this->_error;
    }

    public function insert($table, $fields = [])
    //fonction pour inserer les champs $feilds dans la table $table
    //fields tableau associative des noms des colonnes et les valeurs
    //resiste les attaques injections
    {
        $fieldString = '';
        $valueString = '';
        $values = [];

        foreach ($fields as $field => $value) {
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value;//inserer à la fin du tableau
        }
        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
        if (!$this->query($sql, $values)->error()) {//insertion réussite
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields =[])
    //modifier certains données $fields une ligne avec l'identifiant $id
    //fields tableau associative des noms des colonnes et les valeurs
    //resiste les attaques injections
    {
        $fieldString = '';
        $values = [];
        foreach ($fields as $field => $value) {
            $fieldString .= ' ' .$field . ' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString,',');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
        if (!$this->query($sql, $values)->error()) {//modification réussite
            return true;
        }
        return false;
    }

    public function delete($table, $id)
    //fonction pour supprimer la ligne avec l'identifiant $id 
    {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if (!$this->query($sql)->error()) {//suppression réussite
            return true;
        }
        return false;
    }


}
