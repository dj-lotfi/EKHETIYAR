<?php 
class CommentaireModel extends Model{
    public function __construct(){
        $table = 'Commentaires';
        parent::__construct($table);
    }
    public function Rate($id_bank,$id_commentaire,$texte,$date_heure) {
        $TabReview =array("id_commentaire"=>$id_commentaire ,"banque"=> $id_bank ,"texte"=> $texte ,"date_heure"=> $date_heure); 
        if($this->findById($id_commentaire,"id_commentaire"))$this->update($id_commentaire,"id_commentaire",$TabReview);
        else $this->insert($TabReview);
    }
    public function delelteRatinb($idreveiw)
    {
       $this->delete($idreveiw,"id_commentaire");
    }
}