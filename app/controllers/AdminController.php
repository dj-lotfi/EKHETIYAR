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

    public function ajBanque()
    {
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
        if (isset($_POST['site'])) {
            $adm = new AdminModel();
            if ($_FILES['file']['name'] != "") {
                $newinfo = array(
                    "id_banque" => $_POST['id'],
                    "nom" => $_POST['nom'],
                    "abb" => $_POST['abbreviation'],
                    "logo" => $_FILES['file']['name'],
                    "adresse_siege_social" => $_POST['siege_social'],
                    "telephone" => $_POST['telephone'],
                    "fax" => $_POST['fax'],
                    "rating" => 0,
                    "lienmap" => $_POST['map'],
                    "site_banque" => $_POST['site'],
                );
                $response['choix1'] = '1';
            }else{
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
                $response['choix2'] = '2';
            }
            $adm->UpdateBank($newinfo);
            $response['data'] = 'Data sent successufully';
        }
        echo json_encode($response);
    }

    public function DeleteBank($id)
    {
        $this->model->DeleteBank($id);
    }
    function UploadLogo($id)
    {
        if (isset($_FILES['file']['name'])) {

            /* Getting file name */
            $filename = $_FILES['file']['name'];

            /* Location */
            $location = "app/logos/" . $filename;

            /* Extension */
            $extension = pathinfo($location, PATHINFO_EXTENSION);
            $extension = strtolower($extension);

            /* Allowed file extensions */
            $allowed_extensions = array("jpg", "jpeg", "png", "svg");

            $response = array();
            $status = 0;

            /* Check file extension */
            if (in_array(strtolower($extension), $allowed_extensions)) {

                /* Upload file */
                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {

                    $status = 1;
                    $response['path'] = $location;
                    $response['extension'] = $extension;

                }
            }

            $response['status'] = $status;
            $response['name'] = $filename;
            echo json_encode($response);
            exit;
        }
        echo 0;


    }

    public function indexAction()
    {
        $this->view->render();
    }
}