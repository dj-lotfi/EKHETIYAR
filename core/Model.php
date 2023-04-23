<?php

#[AllowDynamicProperties]
class Model
{
    protected $_db, $_table, $_modelName, $_softDelete = false;
    public $id;
    public function __construct($table)
    {
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_',' ', $this->_table)));
    }


    public function get_columns()
    {
        return $this->_db->getColumns($this->_table);
    }

    public function find($params = [])
    //return les lignes qui correspond aux conditions $params dans un tableau de type nom_model[]
    {
        $resultsQuery = $this->_db->find($this->_table, $params,get_class($this));
        if (!$resultsQuery) {
            return [];
        }
        return $resultsQuery;
    }

    public function findInTable($Table,$params = [])
    //return les lignes qui correspond aux conditions $params dans un tableau de type nom_model[]
    {
        $resultsQuery = $this->_db->find($Table, $params,get_class($this));
        if (!$resultsQuery) {
            return [];
        }
        return $resultsQuery;
    }

    public function findFirst($params = [])
    {
        $resultsQuery = $this->_db->findFirst($this->_table, $params,get_class($this));
        return $resultsQuery;
    }

    public function findById($id,$indexid)
    {
        return $this->findFirst(['conditions'=>"$indexid = ?", 'bind' =>[$id]]);
    }

    protected function populateObjData($result)
    {
        foreach ($result as $key => $value) {
            $this->$key = $value;
        }
    }

}
