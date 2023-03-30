<?php 
class qui_sommes_nousModel extends Model {
    public function __construct(){
        $table = 'A_propos';
        parent::__construct($table);
    }

    public function getQSN(){
        $contact = $this->_db->query("select * from A_propos;");
        $_SESSION['result'] = $contact->getFirstResult();

    }
}
?>