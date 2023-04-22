<?php

class DB_admin {
    
    private static $_instance = null ;//la référance vers la bdd (static car instance de dbb unique pour chaque utilisateur)
    private $_pdo; //la connexion à la bdd
    private $_query, $_error = false, $_result, $_count = 0, $_lastInsertID = null;


    public function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host='.DB_HOST_ADMIN.';dbname='.DB_NAME_ADMIN, DB_USER_ADMIN, DB_PASSWORD_ADMIN);
            //$this->_pdo = new PDO("sqlsrv:server = " . DB_HOST . "; Database = "  . DB_NAME , DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {//assurer l'unicité de la bdd
            self::$_instance = new DB_admin();
        } 
        return self::$_instance;
        
    }

    public function query($sql, $params = [],$class = false)
    //fonction pour accérir des données cd depuis la bdd
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
                if ($class) {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_CLASS,$class);
                } else {
                    $this->_result = ($this->_query)->fetchAll(PDO::FETCH_OBJ);
                }
                
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

    protected function _read($table , $class , $params=[])
    //fonction qui créer une instruction "SELECT * FROM {$table}{$conditionString}{$order}{$limit}"
    //renvoie tous les éléments du tableau $table qui vérifie les conditions {$conditionString} dans l'ordre {$order} et pas plus de {$limit} éléments
    /* $table
        [
            'conditions' => "condition, condition, ...",// colomn_name = ? ,colomn_name2 > ?
            'bind' => ['value, ...'],//la valeur qui va remplacer le ?
            'order' => "colomn_name, colomn_name, ...",
            'limit' => integer
        ]
        //si on ne veut pas utiliser une option ,on ne met pas le '=>' correspendant
    */
    {
        $conditionString = '';
        $bind = [];
        $order = '';//la colonne d'aprés laquel les resultats sont ordonnés
        $limit = '';//nombre max d'element a renvoier

        //conditions
        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as $condition ) {
                    $conditionString .= ' ' . $condition . ' AND';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, ' AND');
            } else {
                $conditionString = $params['conditions'];
            }
            if($conditionString != '') {
                $conditionString = ' WHERE ' . $conditionString;
            }
        }

        //bind
        if (array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }
        
        //order
        if (array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }

        //limit
        if (array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }


        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
        if($this->query($sql, $bind,$class)) {
            if (!count($this->_result)) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function find($table, $params=[],$class=false)
    {
        if ($this->_read($table ,$class, $params)) {
            return $this->getResult();
        }
        return false;
    }

    public function findFirst($table, $params=[],$class=false)
    {
        if ($this->_read($table ,$class, $params)) {
            return $this->getFirstResult();
        }
        return false;
    }



    public function getResult()
    {
        return $this->_result;
    }

    public function getCount()
    {
        return $this->_count;
    }

    public function getColumns($table)
    {
        return $this->query("SHOW COLUMNS FROM {$table}")->getResult();
    }

    public function getFirstResult()
    {
        return (!empty($this->_result))? $this->_result[0] : [];
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

    public function update($table, $id,$indexid , $fields =[])
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
        $sql = "UPDATE {$table} SET {$fieldString} WHERE {$indexid} = {$id}";
        if (!$this->query($sql, $values)->error()) {//modification réussite
            return true;
        }
        return false;
    }

    public function delete($table, $id ,$indexid)
    //fonction pour supprimer la ligne avec l'identifiant $id 
    {
        $sql = "DELETE FROM {$table} WHERE {$indexid} = {$id}";
        if (!$this->query($sql)->error()) {//suppression réussite
            return true;
        }
        return false;
    }

}