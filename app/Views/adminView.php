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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?php $this->end(); ?>

    <?php $this->start('body');
    ?>

    <body class="admin-layout">
      <div class="no-content-available">Please use a suitable device</div>

      <div class="nav">
        <div class="nav-item">
          <p tabindex="0">Banques</p>
          <button class="addButton" type="button" id="add_bnq"
            onclick="localStorage.setItem('lastvisitedelement', this);AjoutBanque();"></button>
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

        <div class="nav-item" id="AdminsSection"
          onclick="localStorage.setItem('lastvisitedelement', this.id);Modifadmins();">
          <p tabindex="0">Admins</p>
        </div>

        <div class="nav-item">
          <p tabindex="0">Autres</p>
          <div class="item-list__container">
            <ul class="item-list">
              <li id="modifaprop" onclick="localStorage.setItem('lastvisitedelement', this.id);ModifApropos();">
                <p tabindex="0">A propos</p>
              </li>
              <li id="modifpub" onclick="localStorage.setItem('lastvisitedelement', this.id);ModifPub();">
                <p tabindex="0">Publicites</p>
              </li>
            </ul>
          </div>
        </div>

        <div class="nav-item" onclick="Logout();">
          <p tabindex="0">Logout</p>
        </div>

      </div>
      <div class="modifying-window">
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

  public function Modifadmins()
  {
    ?>
    <div id="mdfadm" class="modifying-window">
      <table>
        <thead>
          <tr>
            <th colspan="3">Admins</th>
            <th class="material-icons bouton" onclick="AffAddAdmin();">add</th>
          </tr>
          <tr>
            <th>Username</th>
            <th colspan="2">Password</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $temp = new LoginModel();
          $res = $temp->getLogs();
          for ($i = 0; $i < sizeof($res); $i++) {
            ?>
            <tr>
              <td>
                <?php echo $res[$i]->username ?>
              </td>
              <td>
                <?php echo $res[$i]->password ?>
              </td>
              <td>
                <i class="material-icons bouton edit" onclick="AffEditAdm();">edit</i>
                <i class="material-icons bouton delete" onclick="DelAdm(<?= $res[$i]->id ?>);">delete</i>
              </td>
            </tr>


      </div>
    <?php } ?>
    </tbody>
    </table>
    <?php for ($i = 0; $i < sizeof($res); $i++) {
      ?>
      <div id="modifieradminpopup" class="modal">
        <div id="modif-admin-content" class="modal-content3">
          <span class="close" onclick="closeMdfAdm()">&times;</span>
          <form id="modifadminform<?php echo $res[$i]->id ?>" method="POST"
            onsubmit="event.preventDefault();EditAdm(<?php echo $res[$i]->id ?>);">
            <input type="text" id="username" placeholder="Username" value="" required /><br><br>
            <input type="password" id="password" value="" placeholder="Password" /><br><br>
            <input type="password" id="confirmpassword" value="" placeholder="Confirm Password" /><br>
            <div class="submit-bank-info"><input id="submitmodifadm" type="submit" name="submitadm" value="Modifier" /></div>
          </form>
        </div>
        <div id="errorModifAdm<?= $res[$i]->id ?>"></div>

      </div>
      <div id="ajouteradminpopup" class="modal">
        <div id="ajout-admin-content" class="modal-content3">
          <span class="close" onclick="closeAddAdm()">&times;</span>
          <form id="addadminform" method="POST" onsubmit="event.preventDefault();AddAdm();">
            <input type="text" id="adusername" placeholder="Username" value="" required /><br><br>
            <input type="password" id="adpassword" value="" placeholder="Password" /><br><br>
            <input type="password" id="adconfirmpassword" value="" placeholder="Confirm Password" /><br>
            <div class="submit-bank-info"><input id="submitaddadm" type="submit" name="submitadm" value="Ajouter" /></div>
          </form>
        </div>
        <div id="errorAjoutAdm"></div>

      </div>
      <?php
    }
  }

  public function ModifApropos()
  {
    ?>
    <div id="updatePropos" class="modifying-window">
      <?php $adm = new AdminModel(1);
      $prop = $adm->getApropos(); ?>
      <form id="updateProposhh" method="post" onsubmit="event.preventDefault();AjouterSiteLogo();SendApropos();">
        <h4>Logo du site :</h4>
        <div class="image-preview">
          <img src="img/<?php echo $prop->site_logo ?>" alt="<?php echo $prop->site_logo ?>" class="img">
        </div>
        <!-- Site logo Upload -->
        <label for="sitelogo" class="upload-label">
          <span class="upload-label-text">Upload a Logo for the site:</span>
          <span class="upload-label-button">Choose File</span>
        </label>
        <input type="file" id="sitelogo" name="sitelogo" style="display:none;" />

        <h4> A propos de nous : </h4>
        <textarea class="aprop-textbox" type="text" name="prop" rows="5" cols="70">
            <?php echo $prop->prop; ?>
            </textarea>
        <br>
        <h4>Vision : </h4>
        <textarea class="aprop-textbox" type="text" name="vision" rows="5" cols="70">
            <?php echo $prop->vision; ?>
            </textarea>

        <br>
        <h4>Fonctionnement : </h4>
        <textarea class="aprop-textbox" type="text" name="fonctionnement" rows="5" cols="70">
            <?php echo $prop->fonctionnement; ?>
            </textarea>

        <br>
        <h4>Email : </h4><input class="bank-name" type="text" name="email" value="<?php echo $prop->email; ?>"
          placeholder="Description"><br>
        <h4>Telephone : </h4><input class="bank-name" type="text" name="tele" value="<?php echo $prop->telephone; ?>"
          placeholder="Description"><br>
        <input type="text" id="idbank" value="<?php echo $prop->id ?>" hidden>
        <div class="submit-bank-info"><input type="submit" name="submitprop" value="Update"></div>
      </form>
    </div>
    </div>
    <?php
  }
  public function ajBanque()
  {
    ?>
    <div id="addbanquePop" class="modifying-window">
      <form class="bank-info" id="addbanque" method="post" enctype='multipart/form-data'
        onsubmit="event.preventDefault();ajoutSubmitted();">
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
        <div class="submit-bank-info"><input id="ajnewbank" name="submit" type="submit" value="Ajouter" /></div>
      </form>
    </div>
    <?php
  }

  public function displayBankButtons()
  {
    $bdd = new AdminModel(1);
    $res = $bdd->get("*", 'banques');
    //var_dump($res); ?>

    <?php

    for ($i = 0; $i < count($res); $i++) {
      ?>
      <li id="<?= $res[$i]->id_banque ?>">
        <p id="bank<?= $res[$i]->id_banque ?>" tabindex="0"
          onclick="localStorage.setItem('lastvisitedelement', this.id);ModifBanque(this.parentElement.id);">
          <?php echo $res[$i]->abbreviation; ?>
        </p>
        <button class="delButton" type="button" id="<?= $i . $res[$i]->abbreviation ?>"
          onclick="SupprimBanque(this.parentElement.id)"></button>
        <label for="<?= $i . $res[$i]->abbreviation ?>" tabindex="0">
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
    $mod = new AdminModel(1);
    $var = $mod->get($id, 'banques');
    ?>
    <form class="bank-info" id="update" method="post" onsubmit="MAJBanque();event.preventDefault();"
      enctype='multipart/form-data'>
      <div class="general">
        <input class="bank-name" type="text" name="nom" value="<?php echo $var->nom; ?>" placeholder="Nom" required>
        <input class="abbreviation" type="text" name="abbreviation" value="<?php echo $var->abbreviation; ?>"
          placeholder="Abbreviation" required>
        <input class="seige-social" type="text" name="siege_social" value="<?php echo $var->adresse_siege_social; ?>"
          placeholder="Adresse siege social" required>
      </div>
      <div class="contacts">
        <input class="tel" type="text" name="telephone" value="<?php echo $var->telephone; ?>" placeholder="Phone number"
          required>
        <input class="fax" type="text" name="fax" value="<?php echo $var->fax; ?>" placeholder="Fax" required>
        <input type="text" name="site" value="<?php echo $var->site_banque; ?>" placeholder="Site officiel" required>
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
        <input class="map-link" type="text" name="map" value="<?php echo $var->lienmap; ?>" required>
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
                  <button class="prestation-delete-button" type="button" onclick="deletepres(<?= $pre[$i]->getId() ?>)">
                    <svg>
                      <use href="#delete" />
                    </svg>
                  </button>
                </td>

              </tr>
              <div id="popup" class="modal">
                <div class="modal-content2">
                  <span class="close" onclick="closePopup()">&times;</span>
                  <form id="updatepres<?= $pre[$i]->getId() ?>" method="post">
                    <h4 style="color: black;">Nom : </h4>
                    <input class="bank-name" type="text" id="upnompres<?= $pre[$i]->getId() ?>" placeholder="Nom" value="<?php echo $pre[$i]->getNom() ?>" required><br>
                    <h4 style="color: black;">Prix : </h4>
                    <input class="bank-name" type="text" id="upprixpres<?= $pre[$i]->getId() ?>" value="<?php echo $pre[$i]->getPrix() ?>" placeholder="Prix"><br>
                    <h4 style="color: black;">Date de valeur : </h4>
                    <input class="bank-name" type="text" id="updatevaleur<?= $pre[$i]->getId() ?>" value="<?php echo $pre[$i]->getDateValeur() ?>" placeholder="Date Valeur"><br>
                    <h4 style="color: black;">Categorie : </h4>
                    <input class="seige-social" type="text" id="upcategoriepres<?= $pre[$i]->getId() ?>" value="<?php echo $pre[$i]->getCategorie() ?>" placeholder="Categorie"><br>
                    <h4 style="color: black;">Description : </h4>
                    <input class="bank-name" type="text" id="updescription<?= $pre[$i]->getId() ?>" value="<?php echo $pre[$i]->getDescription() ?>" placeholder="Description"><br>
                    <div class="submit-bank-info"><input type="submit" name="submit" value="Update"
                        onclick="updateprestation(<?= $pre[$i]->getId() ?>);" /></div>
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
        <form id="addpres" method="post" onsubmit="addpres();event.preventDefault();">
          <input class="bank-name" type="text" id="nompres" placeholder="Nom" value="" required><br>
          <input class="bank-name" type="text" id="prixpres" value="" placeholder="Prix"><br>
          <input class="bank-name" type="text" id="datevaleur" value=""
            placeholder="Date Valeur"><br>
          <input class="seige-social" type="text" id="categoriepres" value=""
            placeholder="Categorie"><br>
          <input class="bank-name" type="text" id="description" value=""
            placeholder="Description"><br>
          <input type="text" id="idbank" value="<?php echo $id ?>" hidden>
          <div class="submit-bank-info"><input type="submit" name="submitnew" value="Ajouter"></div>
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
      <h2 style="text-align=center;">Images Publicitaires</h2>
      <div>
        <div>
          <form id="uploadpub" method="post" onsubmit="AjouterPub();event.preventDefault();" enctype='multipart/form-data'>
            <label for="image" class="upload-label">
              <span class="upload-label-text">Ajouter image publicitaire:</span>
              <span class="upload-label-button">Choisir image</span>
            </label>
            <input type="file" id="image" name="image" style="display:none;" />
            <div class="submit-bank-info"><input type="submit" name="submitPub" value="Ajouter"></div>
          </form>
        </div>
      </div>
      <form id="suppub" method="post" onsubmit="SupprimerPub();event.preventDefault();">
        <?php
        // Define the path to the image folder
        $imagePath = "img/carousel_images/";

        // Get all image files in the folder
        $images = glob($imagePath . "*.{jpg,png,gif,svg}", GLOB_BRACE);
        $usles = 0;

        // Loop through each image and display it
        ?>
        <div class="wrapper">
          <?php
          foreach ($images as $image) { ?>
            <div class="selectimg">
              <label for="<?= $image . $usles ?>">
                <input class="checkimg" id="<?= $image . $usles ?>" type="checkbox" name="imagesToDelete[]"
                  value="<?= $image ?>" hidden>
                <img src="<?= $image ?>" width="auto" height="100">
              </label>
            </div>
            <?php
            $usles++;
          }
          ?>
        </div>
        <div class="submit-bank-info"><input type="submit" name="deleteImages" value="Supprimer"></div>
      </form>
    </div>
    <div id="pubfeedback"></div>
    <?php
  }
}