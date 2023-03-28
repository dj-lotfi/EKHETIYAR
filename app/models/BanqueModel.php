<?php 
class BanqueModel extends Model {
    public function __construct(){
        $table = 'Banques';
        parent::__construct($table);
    }

public function getBanque($bank){
    $contact = $this->_db->query("select * from Banques where id_banque=" . $bank);
    $res = $contact->getFirstResult();
    return $res;
}

}
 ?>