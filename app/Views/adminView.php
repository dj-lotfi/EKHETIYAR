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
            <li class="nav-item" id="add_bnq" onclick="AjoutBanque()" style="color: Blue;">
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
          <p>A Propos</p>
          <ul>
            <li class="nav-item">
              <p>Description</p>
            </li>
            <li class="nav-item">
              <p>Contact1</p>
            </li>
            <li class="nav-item">
              <p>Contact2</p>
            </li>
          </ul>
        </label>
      </div>
      <div class="show-at-first">
        <h1>Welcome to the admin page , please select an option on the left to proceed</h1>
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
        <!--
        <div class="bank-info">
          <div class="general">
            <input class="bank-name" type="text" placeholder="Nom">
            <input class="abbreviation" type="text" placeholder="Abbreviation">
            <input class="seige-social" type="text" placeholder="Seige Social">
          </div>
          <div class="contacts">
            <input class="tel" type="text" placeholder="Téléphone">
            <input class="fax" type="text" placeholder="Fax">
            <input class="logo" type="file">
          </div>
          <div class="image-preview">
            <img src="" alt="Image Preview Here">
          </div>
          <div class="map">
            <input class="map-link" type="text" placeholder="Lien-map">
            <div class="map__container">
              <iframe class="hide-map-bar" src="" frameborder="0">
              </iframe>
            </div>
          </div>
        </div>-->
      </div>
    </body>

    <?php $this->end();

    require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php


  }

  public function ajBanque()
  {
    ?>
    <div id="addbanquePop" class="modifying-window">
      <form id="addbanque" method="post" onsubmit="ajoutSubmitted();event.preventDefault();">
        <div class="general">
          <input class="bank-name" type="text" name="nom" placeholder="Nom">
          <input class="abbreviation" type="text" name="abbreviation" placeholder="Abbreviation">
          <input class="seige-social" type="text" name="siege_social" placeholder="Adresse siege social">
        </div>
        <div class="contacts">
          <input class="tel" type="text" name="telephone" placeholder="Phone number">
          <input class="fax" type="text" name="fax" placeholder="Fax">
          <input type="text" name="site" placeholder="Site officiel">
          <input class="logo" type="text" name="logo">
        </div>
        <input class="map-link" type="text" name="map">
        <button name="submit" type="submit" class="button">Ajouter</button>
      </form>
    </div>
    <?php
  }

  public function displayBankButtons()
  {
    $bdd = new BanqueModel();
    $res = $bdd->getAllBanques();
    //var_dump($res); ?>

    <?php

    for ($i = 0; $i < count($res); $i++) {
      ?>
      <li class="nav-item" id="<?= $res[$i]->getId_banque() ?>" onclick="ModifBanque(this.id);this.disabled=true;">
        <p>
          <?php echo $res[$i]->getAbbr(); ?>
        </p>
        <button class="DeleteBtn" type="button" id="<?= $i ?>" onclick="SupprimBanque(this.parentNode.id)">
          <img src="img/delete-icon.png" alt="-">
        </button>
      </li>
      <?php
    }
    ?>
    <?php
  }

  public function Affichagebanque($id)
  {
    $mod = new AdminModel();
    $var = $mod->get($id ,'banques');
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
    <?php $pres = new PrestationModel();
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
                <td data="<?php echo $pre[$i]->getId() ?>" id="<?= $pre[$i]->getId() ?>" class="update"
                  onclick="affichage(this.id)">
                  <h3> <b> update </b> </h3>
                </td>
              </tr>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    </div>
    <div id="feedback_place"></div>
    <div id="popup" class="modal">
      <div class="modal-content2">
        <span class="close" onclick="closePopup()">&times;</span>
        <form id="updatepres" method="post" enctype="multipart/form-data">
          <h4>Nom : </h4><input class="bank-name" type="text" id="nompres" placeholder="Nom" value="" required><br><br>
          <h4>Prix : </h4><input class="abbreviation" type="text" id="prixpres" value="" placeholder="Prix"><br><br>
          <h4>date de valeur : </h4><input class="abbreviation" type="text" id="datevaleur" value=""
            placeholder="Prix"><br><br>
          <h4>Categorie : </h4><input class="seige-social" type="text" id="categoriepres" value=""
            placeholder="Categorie"><br><br>
          <h4>Description : </h4><input class="bank-name" type="text" id="description" value=""
            placeholder="Description"><br><br>
          <input type="submit" name="submit" class="button" value="Update">
        </form>
        <div id="error">

        </div>
      </div>
    </div>
    
  <?php }
}

?>