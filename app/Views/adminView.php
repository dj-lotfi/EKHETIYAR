<?php
class adminView extends View
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


    <?php $this->end(); ?>

    <?php $this->start('body');
    if ($_SESSION['loggedin'] == false) {
      Router::redirect(Login);
      exit;
    }
    $_SESSION["loggedin"] = false;
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
        <li class="nav-item">
          <p>bank1</p>
        </li>
        <li class="nav-item">
          <p>bank2</p>
        </li>
        <li class="nav-item">
          <p>bank3</p>
        </li>
        <li class="nav-item">
          <p>bank4</p>
        </li>
        <li class="nav-item">
          <p>bank5</p>
        </li>
        <li class="nav-item">
          <p>bank6</p>
        </li>
        <li class="nav-item">
          <p>bank7</p>
        </li>
        <li class="nav-item">
          <p>bank8</p>
        </li>
        <li class="nav-item">
          <p>bank9</p>
        </li>
        <li class="nav-item">
          <p>bank10</p>
        </li>
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
  <div class="modifying-window">
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
    </div>
  </div>
  </body>

<?php $this->end();

    require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php


  }
}

?>