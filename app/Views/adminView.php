<?php
class AdminView extends View
{
  public function render()
  {
    $this->setSiteTitle('Admin');

    $this->start('head'); ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <script defer src="js/admin.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <?php $this->end(); ?>

    <?php $this->start('body');
    /*if ($_SESSION['loggedin'] == false) {
    Router::redirect(Login);
    exit;
    }
    $_SESSION["loggedin"] = false;*/
    ?>

    <body class="admin-layout">
      <div class="no-content-available">Please use a suitable device</div>

      <div class="nav">

        <input class="nav-input" type="radio" id="banques" checked>
        <input class="nav-input" type="radio" id="prestations_globales">
        <input class="nav-input" type="radio" id="a_props">
        <label for="banques" class="nav-label">
          <p>Banques</p>
          <ul>
            <li class="nav-item" id="add_bnq" onclick="AjoutBanque(this.id)" style="color: Blue;">
              <p>
                Ajouter
              </p>
            </li>
            <?php $this->displayBankButtons(); ?>
          </ul>
        </label>

        <label for="prestations_globales" class="nav-label">
          <p>Prestations Globales</p>
        </label>

        <label for="a_props" class="nav-label">
          <p>Autres</p>
          <ul>
            <li id="modifaprop" class="nav-item" onclick="ModifApropos(this.id);">
              <p>A propos</p>
            </li>
            <li id="modifpub" class="nav-item" onclick="ModifPub(this.id);">
              <p>Publicites</p>
            </li>
          </ul>
        </label>
      </div>
      <div id="warning" class="modal">
        <div class="modal-content2">
          <span class="close" onclick="closeWarning()">&times;</span>
          <h3 class="supp-warning">Vous etes sur de supprimer cette banque ?</h3>
          <button class="confirm" id="confirm">Confirmer</button>
          <button class="annul" id="annul" onclick="closeWarning()">Annuler</button>
        </div>
      </div>
      <div class="modifying-window">
        <div id="loader" class="loader">
          <div class="justify-content-center jimu-primary-loading"></div>
        </div>
        <div class="modification" id="modification"></div>
      </div>
    </body>

    <?php $this->end();

    require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php


  }

  public function ModifApropos()
  {
    ?>
    <div id="updatePropos">
      <?php $adm = new AdminModel();
      $prop = $adm->getApropos(); ?>
      <form id="updateProposhh" method="post" onsubmit="event.preventDefault();AjouterSiteLogo();SendApropos();">
        <h4>Logo du site : <!--</h4><input class="bank-name" type="text" name="Logo_site" placeholder="Nom"
            value="<?php /*echo $prop->site_logo;*/?>" required><br><br>-->
          <div class="image-preview">
            <img src="img/<?php echo $prop->site_logo ?>" alt="<?php echo $prop->site_logo ?>" class="img">
          </div>
          <!-- Site logo Upload -->
          <label for="sitelogo" class="upload-label">
            <span class="upload-label-text">Upload a Logo for the site:</span>
            <span class="upload-label-button">Choose File</span>
          </label>
          <input type="file" id="sitelogo" name="sitelogo" style="display:none;" />

          <h4>Prop : </h4><input class="bank-name" type="text" name="prop" value="<?php echo $prop->prop; ?>"
            placeholder="Prix"><br><br>
          <h4>Vision : </h4><input class="bank-name" type="text" name="vision" value="<?php echo $prop->vision; ?>"
            placeholder="Prix"><br><br>
          <h4>Fonctionnement : </h4><input class="seige-social" type="text" name="fonctionnement"
            value="<?php echo $prop->fonctionnement; ?>" placeholder="Categorie"><br><br>
          <h4>Email : </h4><input class="bank-name" type="text" name="email" value="<?php echo $prop->email; ?>"
            placeholder="Description"><br><br>
          <h4>Telephone : </h4><input class="bank-name" type="text" name="tele" value="<?php echo $prop->telephone; ?>"
            placeholder="Description"><br><br>
          <input type="text" id="idbank" value="<?php echo $prop->id ?>" hidden>
          <input type="submit" name="submitprop" class="button" value="Update">
      </form>
    </div>
    </div>
    <?php
  }
  public function ajBanque()
  {
    ?>
    <div id="addbanquePop" class="modifying-window">
      <form id="addbanque" method="post" enctype='multipart/form-data' onsubmit="event.preventDefault();ajoutSubmitted();">
        <div class="general">
          <input class="bank-name" type="text" name="nomj" placeholder="Nom">
          <input class="abbreviation" type="text" name="abbreviationj" placeholder="Abbreviation">
          <input class="seige-social" type="text" name="siege_socialj" placeholder="Adresse siege social">
        </div>
        <div class="contacts">
          <input class="tel" type="text" name="telephonej" placeholder="Phone number">
          <input class="fax" type="text" name="faxj" placeholder="Fax">
          <input type="text" name="sitej" placeholder="Site officiel">
          <label for="newbanklogo" class="upload-label">
            <span class="upload-label-text">Upload Bank Logo</span>
            <span class="upload-label-button">Choose File</span>
          </label>
          <input type="file" id="newbanklogo" name="newbanklogo" style="display:none;" />
        </div>
        <input class="map-link" type="text" name="mapj" placeholder="Map Agences">
        <input id="ajnewbank" name="submit" type="submit" class="button" value="Ajouter"/>
      </form>
    </div>
    <?php
  }

  public function displayBankButtons()
  {
    $bdd = new AdminModel();
    $res = $bdd->get("*", 'banques');
    //var_dump($res); ?>

    <?php

    for ($i = 0; $i < count($res); $i++) {
      ?>
      <li class="nav-item" id="<?= $res[$i]->id_banque ?>" onclick="ModifBanque(this.id);">
        <p>
          <?php echo $res[$i]->abb; ?>
        </p>

      </li>
      <button class="DeleteBtn" type="button" id="<?= $i . $res[$i]->abb ?>"
        onclick="SupprimBanque(this.previousElementSibling.id)">
        <img src="img/delete-icon.png" alt="-">
      </button>
      <?php
    }
  ?>
  <?php
  }

  public function Affichagebanque($id)
  {
    $mod = new AdminModel();
    $var = $mod->get($id, 'banques');
    ?>
    <form id="update" method="post" onsubmit="MAJBanque();event.preventDefault();" enctype='multipart/form-data'>
      <div class="general">
        <input class="bank-name" type="text" name="nom" value="<?php echo $var->nom; ?>" placeholder="Nom">
        <input class="abbreviation" type="text" name="abbreviation" value="<?php echo $var->abb; ?>"
          placeholder="Abbreviation">
        <input class="seige-social" type="text" name="siege_social" value="<?php echo $var->adresse_siege_social; ?>"
          placeholder="Adresse siege social">
      </div>
      <div class="contacts">
        <input class="tel" type="text" name="telephone" value="<?php echo $var->telephone; ?>" placeholder="Phone number">
        <input class="fax" type="text" name="fax" value="<?php echo $var->fax; ?>" placeholder="Fax">
        <input type="text" name="site" value="<?php echo $var->site_banque; ?>" placeholder="Site officiel">
        <input class="logo" type="text" name="logo" value="<?php echo $var->logo; ?>" placeholder="Logo" hidden>
      </div>
      <div class="image-preview">
        <img src="app/logos/<?php echo $var->logo ?>" alt="<?php echo $var->logo ?>" class="img">
      </div>
      <!-- Upload a new logo section -->
      <div>
        <div>
          <label for="file" class="upload-label">
            <span class="upload-label-text">Upload a logo:</span>
            <span class="upload-label-button">Choose File</span>
          </label>
          <input type="file" id="file" name="file" style="display:none;" />
          <!--<input type="button" class="button" value="Upload" id="but_upload">-->
          <input type="hidden" id="bank_id" value="<?= $id ?>">
        </div>
      </div>
      <!---->
      <div class="map">
        <input class="map-link" type="text" name="map" value="<?php echo $var->lienmap; ?>">
        <div class="map__container">
          <iframe class="hide-map-bar" src="<?php echo $var->lienmap ?>" frameborder="0">
          </iframe>
        </div>
      </div>
      <input type="text" name="id" value="<?php echo $var->id_banque ?>" hidden>
      <button name="submit" type="submit" class="button">sauvegarder</button>
    </form>
    <?php $pres = new PrestationAdminModel();
    $pre = $pres->getPrestations($id);
    ?>
    <div class="background-table">
      <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Categorie</th>
              <th>Prix (DAZ)</th>
              <th>Date_valeur</th>
              <th>Description</th>
              <th>Update</th>
              <th onclick="NewInfoPres()" class="update">ADD</button></th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tbl-content">
        <table cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <?php
            for ($i = 0; $i < sizeof($pre); $i++) {
              ?>
              <tr>
                <td>
                  <?php echo $pre[$i]->getNom() ?>
                </td>
                <td>
                  <?php echo $pre[$i]->getCategorie() ?>
                </td>
                <td>
                  <?php echo $pre[$i]->getPrix() ?>
                </td>
                <td>
                  <?php echo $pre[$i]->getDateValeur() ?>
                </td>
                <td>
                  <?php echo $pre[$i]->getDescription() ?>
                </td>
                <td id="<?= $pre[$i]->getId() ?>" class="update">
                  <h3 onclick="affichage()"> <b> update </b> </h3>
                </td>
                <td>
                  <button class="DeleteBtn" type="button" onclick="deletepres(<?= $pre[$i]->getId() ?>,<?= $id ?>)">
                    <img src="img/delete-icon.png" alt="-">
                  </button>
                </td>

              </tr>
              <div id="popup" class="modal">
                <div class="modal-content2">
                  <span class="close" onclick="closePopup()">&times;</span>
                  <form id="updatepres" method="post">
                    <h4>Nom : </h4><input class="bank-name" type="text" id="upnompres" placeholder="Nom" value=""
                      required><br><br>
                    <h4>Prix : </h4><input class="bank-name" type="text" id="upprixpres" value="" placeholder="Prix"><br><br>
                    <h4>date de valeur : </h4><input class="bank-name" type="text" id="updatevaleur" value=""
                      placeholder="Prix"><br><br>
                    <h4>Categorie : </h4><input class="seige-social" type="text" id="upcategoriepres" value=""
                      placeholder="Categorie"><br><br>
                    <h4>Description : </h4><input class="bank-name" type="text" id="updescription" value=""
                      placeholder="Description"><br><br>
                    <input type="submit" name="submit" value="UpdatePrestation"
                      onclick="updateprestation(<?= $pre[$i]->getId() ?>,<?= $id ?>);" />
                  </form>
                </div>
                <div id="error">

                </div>
              </div>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    </div>

    </div>

    <div id="ajprestation" class="modal">
      <div class="modal-content2">
        <span class="close" onclick="closeAjPres()">&times;</span>
        <form id="addpres" method="post" onsubmit="addpres(<?= $id ?>);event.preventDefault();">
          <h4>Nom : </h4><input class="bank-name" type="text" id="nompres" placeholder="Nom" value="" required><br><br>
          <h4>Prix : </h4><input class="bank-name" type="text" id="prixpres" value="" placeholder="Prix"><br><br>
          <h4>date de valeur : </h4><input class="bank-name" type="text" id="datevaleur" value=""
            placeholder="Prix"><br><br>
          <h4>Categorie : </h4><input class="seige-social" type="text" id="categoriepres" value=""
            placeholder="Categorie"><br><br>
          <h4>Description : </h4><input class="bank-name" type="text" id="description" value=""
            placeholder="Description"><br><br>
          <input type="text" id="idbank" value="<?php echo $id ?>" hidden>
          <input type="submit" name="submitnew" class="button" value="Update">
        </form>
      </div>
      <div id="error">
      </div>
    </div>
    <div id="feedback_place"></div>

    <?php
  }

  public function ModifPub()
  {
    ?>
    <div class="container">
      <h2>Ajouter une publicite au carousel</h2>
      <div>
        <div>
          <form id="uploadpub" method="post" onsubmit="AjouterPub();event.preventDefault();" enctype='multipart/form-data'>
            <label for="image" class="upload-label">
              <span class="upload-label-text">Upload a carousel image:</span>
              <span class="upload-label-button">Choose File</span>
            </label>
            <input type="file" id="image" name="image" style="display:none;" />
            <input type="submit" name="submitPub" class="button" value="Ajouter Pub">
          </form>
        </div>
      </div>

      <h2>Select Images to Delete</h2>
      <form id="suppub" method="post" onsubmit="SupprimerPub();event.preventDefault();">
        <?php
        // Define the path to the image folder
        $imagePath = "img/carousel_images/";

        // Get all image files in the folder
        $images = glob($imagePath . "*.{jpg,png,gif,svg}", GLOB_BRACE);

        // Loop through each image and display it
        foreach ($images as $image) {
          echo '<div><label><input type="checkbox" name="imagesToDelete[]" value="' . $image . '">';
          echo '<img src="' . $image . '" width="100" height="100"></label></div>';
        }
        ?>
        <input type="submit" name="deleteImages" value="Delete Selected Images">
      </form>
    </div>
    <div id="pubfeedback"></div>
    <?php
  }
}