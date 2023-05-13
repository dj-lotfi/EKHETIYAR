<?php
class AdminController extends Controller
{
    private $model;
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        //$this->load_model('AdminModel');
        $this->view = new AdminView($this);
        $this->model = new AdminModel();
        $this->view->setLayout('default');
    }

    public function addbanque()
    {
        if (isset($_POST['nomj'])) {

            $response['isset'] = 'it is set';
            $adm = new AdminModel();
            $bn = new BanqueModel();
            if ($_FILES['newbanklogo']['name'] != "") {
                $newbanque = array(
                    "id_banque" => $bn->generateid(),
                    "nom" => $_POST['nomj'],
                    "abbreviation" => $_POST['abbreviationj'],
                    "logo" => $_FILES['newbanklogo']['name'],
                    "adresse_siege_social" => $_POST['siege_socialj'],
                    "telephone" => $_POST['telephonej'],
                    "fax" => $_POST['faxj'],
                    "rating" => 0,
                    "lienmap" => $_POST['mapj'],
                    "site_banque" => $_POST['sitej'],
                );
            }
            $adm->AddBanque($newbanque);

        }
        echo json_encode($response);

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

    public function addprestation($idbank, $nom, $categorie, $prix, $date, $description)
    {
        $adm = new AdminModel();
        $bn = new PrestationModel();
        $newbanque = array(
            "id_prestation" => $bn->generateid(),
            "nom" => urldecode($nom),
            "categorie" => urldecode($categorie),
            "prix" => urldecode($prix),
            "date_valeur" => urldecode($date),
            "description" => urldecode($description),
        );
        $adm->AddPrestation($newbanque, $idbank);
    }

    public function Deleteprestation($id)
    {
        $adm = new AdminModel();
        $adm->DeletePrestationId($id);
    }

    public function ModifPub()
    {
        $this->view->ModifPub();
    }

    public function ModifApropos()
    {
        $this->view->ModifApropos();
    }
    public function update()
    {
        if (isset($_POST['site'])) {
            $adm = new AdminModel();
            if ($_FILES['file']['name'] != "") {
                $newinfo = array(
                    "id_banque" => $_POST['id'],
                    "nom" => $_POST['nom'],
                    "abbreviation" => $_POST['abbreviation'],
                    "logo" => $_FILES['file']['name'],
                    "adresse_siege_social" => $_POST['siege_social'],
                    "telephone" => $_POST['telephone'],
                    "fax" => $_POST['fax'],
                    "rating" => 0,
                    "lienmap" => $_POST['map'],
                    "site_banque" => $_POST['site'],
                );
                $response['choix1'] = '1';
            } else {
                $newinfo = array(
                    "id_banque" => $_POST['id'],
                    "nom" => $_POST['nom'],
                    "abbreviation" => $_POST['abbreviation'],
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
        $response['data sent'] = 'yes data sent';
        echo json_encode($response);
    }
    function Upload()
    {
        if (isset($_FILES['file']['name']) || isset($_FILES['image']['name']) || isset($_FILES['sitelogo']['name']) || isset($_FILES['newbanklogo']['name'])) {

            /* Getting file name */
            if ($_FILES['file']['name'] != "") {
                $filename = $_FILES['file']['name'];
            } else {
                if ($_FILES['image']['name'] != "") {
                    $filename = $_FILES['image']['name'];
                } else {
                    $filename = $_FILES['newbanklogo']['name'];
                }
            }
            $path = $_POST['path'];

            /* Location */
            $location = $path . $filename;

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

    function deleteImage()
    {

        // Check if any images have been selected
        if (isset($_POST['imagesToDelete'])) {
            // Loop through each selected image and delete it
            foreach ($_POST['imagesToDelete'] as $image) {
                if (file_exists($image)) {
                    $response['status'] = 'deleted';
                    unlink($image); ?>
                    <p> Deleted
                        <?php echo $image ?>
                    </p>
                    <?php
                } else {
                    $response['status2'] = 'not deleted';
                }
            }
        } else {
            ?>
            <p> No images selected. </p>
            <?php
        }
        echo json_encode($response);
    }

    public function updateApropos()
    {
        if (isset($_POST["tele"])) {
            if ($_FILES['sitelogo']['name'] != "") {
                $tab = array(
                    "id" => 1,
                    "site_logo" => $_FILES['sitelogo']['name'],
                    "prop" => $_POST["prop"],
                    "vision" => $_POST["vision"],
                    "fonctionnement" => $_POST["fonctionnement"],
                    "email" => $_POST["email"],
                    "telephone" => $_POST["tele"],
                );
            } else {
                $tab = array(
                    "id" => 1,
                    "site_logo" => $_POST["Logo_site"],
                    "prop" => $_POST["prop"],
                    "vision" => $_POST["vision"],
                    "fonctionnement" => $_POST["fonctionnement"],
                    "email" => $_POST["email"],
                    "telephone" => $_POST["tele"],
                );
            }
            $this->model->ModificationInfs($tab);
        }
    }

    public function Logout()
    {
        $_SESSION["loggedin"] = false;
        exit;
    }

    public function Modifadmins(){
        $this->view->Modifadmins();
    }

    public function indexAction()
    {
        if ($_SESSION['loggedin'] == false) {
            Router::redirect(Login);
            exit;
        }
        $_SESSION["loggedin"] = true;
        $this->view->render();
    }
}