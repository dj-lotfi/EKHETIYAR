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
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <script defer src="js/admin.js?v=<?php echo time(); ?>"></script>
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
        <div class="nav-item">
          <p tabindex="0">Banques</p>
          <button class="addButton" type="button" id="add_bnq" onclick="AjoutBanque(this.id)"></button>
          <label class="addBank" for="add_bnq" tabindex="0">
            <svg>
              <use href="#add" />
            </svg>
          </label>
          <div class="item-list__container expanded">
            <ul class="item-list">
              <?php $this->displayBankButtons(); ?>
            </ul>
          </div>
        </div>
        <div class="nav-item">
          <p tabindex="0">Prestations Globales</p>
        </div>

        <div class="nav-item">
          <p tabindex="0">Autres</p>
          <div class="item-list__container">
            <ul class="item-list">
              <li id="modifaprop" onclick="ModifBanque(this.id);">
                <p tabindex="0">A propos</p>
              </li>
              <li id="modifpub" onclick="ModifBanque(this.id);">
                <p tabindex="0">Publicites</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="modifying-window">
        <div id="warning" class="modal">
          <div class="modal-content2">
            <span class="close" onclick="closeWarning()">&times;</span>
            <h3 class="supp-warning">Vous etes sur de supprimer cette banque ?</h3>
            <button class="confirm" id="confirm">Confirmer</button>
            <button class="annul" id="annul" onclick="closeWarning()">Annuler</button>
          </div>
        </div>
        <div id="loader" class="loader">
          <div class="justify-content-center jimu-primary-loading"></div>
        </div>
        <div class="modification" id="modification"></div>
      </div>
      <svg style="display:none;">
        <symbol id="delete" viewBox="0 0 448 512">
          <path
            d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
        </symbol>
        <symbol id="add" viewBox="0 0 448 512">
          <path
            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
        </symbol>
      </svg>
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
      <form class="bank-info" id="addbanque" method="post" enctype='multipart/form-data' onsubmit="event.preventDefault();ajoutSubmitted();">
        <div class="general">
          <input class="bank-name" type="text" name="nomj" placeholder="Nom">
          <input class="abbreviation" type="text" name="abbreviationj" placeholder="Abbreviation">
          <input class="seige-social" type="text" name="siege_socialj" placeholder="Adresse siege social">
        </div>
        <div class="contacts">
          <input class="tel" type="text" name="telephonej" placeholder="Phone number">
          <input class="fax" type="text" name="faxj" placeholder="Fax">
          <input type="text" name="sitej" placeholder="Site officiel">
        </div>
        <label for="newbanklogo" class="upload-label">
            <span class="upload-label-text">Upload Bank Logo</span>
            <span class="upload-label-button">Choose File</span>
          </label>
          <input type="file" id="newbanklogo" name="newbanklogo" style="display:none;" />
        <input class="map-link" type="text" name="mapj" placeholder="Map Agences">
        <div class="submit-bank-info"><input id="ajnewbank" name="submit" type="submit" value="Ajouter"/></div>
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
      <li id="<?= $res[$i]->id_banque ?>">
        <p tabindex="0" onclick="ModifBanque(this.parentElement.id);">
          <?php echo $res[$i]->abb; ?>
        </p>
        <button class="delButton" type="button" id="<?= $i . $res[$i]->abb ?>"
          onclick="SupprimBanque(this.parentElement.id)"></button>
        <label for="<?= $i . $res[$i]->abb ?>" tabindex="0">
          <svg>
            <use href="#delete" />
          </svg>
        </label>
      </li>
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
    <form class="bank-info" id="update" method="post" onsubmit="MAJBanque();event.preventDefault();"
      enctype='multipart/form-data'>
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
        <div>
          <label for="file" class="upload-label">
            <span class="upload-label-text">Upload a logo:</span>
            <span class="upload-label-button">Choose File</span>
          </label>
          <input type="file" id="file" name="file" style="display:none;" />
          <input type="hidden" id="bank_id" value="<?= $id ?>">
        </div>
      </div>
      <div style="display: flex; margin: auto;align-items: center;">
        <div class="image-preview">
          <img src="app/logos/<?php echo $var->logo ?>" alt="<?php echo $var->logo ?>" class="img">
        </div>
      </div>
      <div class="map">
        <input class="map-link" type="text" name="map" value="<?php echo $var->lienmap; ?>">
        <div class="map__container">
          <iframe class="hide-map-bar" src="<?php echo $var->lienmap ?>" frameborder="0">
          </iframe>
        </div>
      </div>
      <input type="text" name="id" value="<?php echo $var->id_banque ?>" hidden>
      <div class="submit-bank-info"><button name="submit" type="submit">Sauvegarder</button></div>
    </form>
    <?php $pres = new PrestationAdminModel();
    $pre = $pres->getPrestations($id);
    ?>
    <div class="background-table">
      <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th width="181.92px">Nom</th>
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
                  <button class="prestation-delete-button" type="button" onclick="deletepres(<?= $pre[$i]->getId() ?>,<?= $id ?>)">
                    <svg>
                      <use href="#delete" />
                    </svg>
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