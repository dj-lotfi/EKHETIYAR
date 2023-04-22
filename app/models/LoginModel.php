<?php 
class LoginModel extends Model_admin {
    private $table = 'adminLogs';

    public function __construct(){
        parent::__construct($this->table);
    }

     public function getLogs()
    {
        return $this->find();//return all logs
    }
}