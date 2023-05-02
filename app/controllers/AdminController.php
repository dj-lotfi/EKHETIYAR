<?php
class AdminController extends Controller
{
    private $model;
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        //$this->load_model('AdminModel');
        $this->view = new AdminView($this);
        $this->view->setLayout('default');
    }

    public function addbanque()
    {
        $adm = new AdminModel();
        $bn = new BanqueModel();
        $newbanque = array(
            "id_banque" => $bn->generateid(),
            "nom" => $_POST['nom'],
            "abb" => $_POST['abbreviation'],
            "logo" => $_POST['logo'],
            "adresse_siege_social" => $_POST['siege_social'],
            "telephone" => $_POST['telephone'],
            "fax" => $_POST['fax'],
            "rating" => 0,
            "lienmap" => $_POST['map'],
            "site_banque" => $_POST['site'],
        );
        $adm->AddBanque($newbanque);
    }

    public function ajBanque(){
        $this->view->ajBanque();
    }

    public function Affichagebanque($id)
    {
        $this->view->Affichagebanque($id);
    }

    public function updateprestation($id, $nom, $categorie, $prix, $date, $description)
    {
        $adm = new AdminModel();
        $newinfo = array(
            "id_prestation" => $id,
            "nom" => urldecode($nom),
            "categorie" => urldecode($categorie),
            "prix" => urldecode($prix),
            "date_valeur" => urldecode($date),
            "description" => urldecode($description),
        );
        $adm->UpdatePrestation($newinfo);
    }
    public function update()
    {
        $adm = new AdminModel();
        $newinfo = array(
            "id_banque" => $_POST['id'],
            "nom" => $_POST['nom'],
            "abb" => $_POST['abbreviation'],
            "logo" => $_POST['logo'],
            "adresse_siege_social" => $_POST['siege_social'],
            "telephone" => $_POST['telephone'],
            "fax" => $_POST['fax'],
            "rating" => 0,
            "lienmap" => $_POST['map'],
            "site_banque" => $_POST['site'],
        );
        $adm->UpdateBank($newinfo);
    }

    public function DeleteBank($id)
    {
        $this->model->DeleteBank($id);
    }
    function UploadLogo()
    {
        $target_dir = "C:/Users/Folokee/Desktop/zb/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                ?> <p> <?php   echo "File is an image - " . $check["mime"] . ".";?> </p> <?php
                $uploadOk = 1;
            } else {
                ?> <p> <?php echo "File is not an image."; ?> </p> <?php
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            ?> <p> <?php echo "Sorry, file already exists."; ?> </p> <?php
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            ?> <p> <?php echo "Sorry, your file is too large."; ?> </p> <?php
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "svg"
        ) {
            ?> <p> <?php echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";?> </p> <?php
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            ?> <p> <?php echo "Sorry, your file was not uploaded."; ?> </p> <?php
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                ?> <p> <?php echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded."; ?> </p> <?php
            } else {
                ?> <p> <?php echo "Sorry, there was an error uploading your file."; ?> </p> <?php
            }
        }

    }

    public function getUploadedLogoName(){
        return $_FILES["image"]["name"] ;
    }

    public function indexAction()
    {
        $this->view->render();
    }
}