<?php
class AdminView extends View
{

  public function displayBankButtons()
  {
    $bdd = new BanqueModel();
    $res = $bdd->getAllBanques();
    //var_dump($res); ?>
    <label for="banques" class="nav-label">
      <p>Banques</p>
      <ul>
        <?php

        for ($i = 0; $i < count($res); $i++) {
          ?>
          <li class="nav-item" id="<?= $i ?>" onclick="ModifBanque(this.id)">
            <p>
              <?php echo $res[$i]->getAbbr(); ?>
            </p>
          </li>
          <?php
        }
        ?>
      </ul>
    </label>
    <?php
  }

  
  public function render()
  {
    $this->setSiteTitle('Admin');

    $this->start('head'); ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <script defer src="js/admin.js"></script>


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

        <?php $this->displayBankButtons(); ?>

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
      <div class="modifying-window">
        <div class="bank-modif-content">
          <div id="loader" class="loader">
            <div class="justify-content-center jimu-primary-loading"></div>
          </div>
          <div class="modification" id="modification"></div>
        </div>
        <button id="up">UPLOAD IMADE</button>
        <div id="upload-image" class="modal">
          <div class="modal-content2">
            <span class="close" onclick="closeUpload()">&times;</span>
            <form method="post" enctype="multipart/form-data" id="upload-logo">
              <label for="image">Select an image to upload:</label>
              <input type="file" name="image" id="image">
              <input type="submit" value="Upload Image" name="submit">
            </form>
            <div id="upload-feedback"></div>
          </div>
        </div>
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
}

?>