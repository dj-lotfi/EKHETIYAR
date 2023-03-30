<?php
class Model
{
    protected $_db, $_table, $_modelNAme, $_softDelete = false;
    public $id;
    public function __construct($table)
    {
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_modelNAme = str_replace(' ', '', ucwords(str_replace('_',' ', $this->_table)));
    }


    public function get_columns()
    {
        return $this->_db->getColumns($this->_table);
    }

    public function find($params = [])
    //return les lignes qui correspond aux conditions $params dans un tableau de type nom_model[]
    {
        $results = [] ;
        $resultsQuery = $this->_db->find($this->_table, $params,get_class($this));
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

    public function save($indexid)
    {
        $fields = getObjectProperties($this);
        if(property_exists($this, 'id') && $this->id != '')//tester si il faut inserer or modifier
        {
            return $this->update($this->id, $fields,$indexid);
        } else {
            return $this->insert($fields);
        }
    }

    public function data()
    {
        $data = new stdClass();
        foreach (getObjectProperties($this) as $column=>$value) {
            $data->column = $value;//***************** */

        }
        return $data;
    }

    public function assign($params) //sanatize
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (property_exists($this,$key)) {
                    $this->$key = sanitize($value);
                }
            }
            return true;
        }
        return false;
    }

    public function insert($fields)
    {
        if (empty($fields)) {
            return false;
        }
        return $this->_db->insert($this->_table, $fields);
    }

    public function update($id, $fields,$indexid)
    {
        if(empty($fields) || $id == '')
        {
            return false;
        }
        return $this->_db->update($this->_table, $id, $fields,$indexid);
    }

    public function delete($indexid,$id ='')
    {
        if ($id == '' && $this->id == '') {
            return false;
        }
        $id = ($id == '') ? $this->id : $id ;
        if($this->_softDelete)
        {
            return $this->update($id, ['deleted' => 1],$indexid);
        }
        return $this->_db->delete($this->_table, $id,$indexid);
    }
} ?>
