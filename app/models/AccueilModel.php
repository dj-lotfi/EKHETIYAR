<?php 
class AccueilModel extends Model {
    public function __construct(){
        $table = 'bank';
        parent::__construct($table);
    }

public function getBanque($db ,$bank){
    $contact = $db->query("select * from banques where id_banque=" . $bank);
    $res = $contact->getFirstResult();
    return $res;
}

}
 ?>