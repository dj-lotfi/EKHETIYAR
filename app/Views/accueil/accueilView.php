<?php
function generateHeader() {
    
    echo '
    <header>
        <img class="logo" src="<?= PROOT ?>/img/Site_Logo.svg" alt="Logo du site">
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <nav class="navbar">
            <ul>
                <li><a href="<?= PROOT ?>/accueil">Accueil</a></li>
                <li><a href="<?= PROOT ?>/comparatif">Comparatif</a></li>
                <li><a href="<?= PROOT ?>/qui_sommes_nous">Qui Sommes-Nous</a></li>
            </ul>
        </nav>
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label>
    </header>';
}

function generateCarousel() {

}

function generateFiltersSection() {

    $filters= '<div class="filters">
    <dl class="filters-subcategory">
      <dt>Gestion et tenue de comtpe</dt>
      <dd class="criteres">
        <ul>
          <li>Doit avoir: </li>
          <ul class="scrollable-checkboxes">
            <li>
              <input type="checkbox" id="check1" value="shouldBePrestationName/SpecialIDFoundInDATABASE" checked>
              <label for="check1">Tous</label>
            </li>
            <li>
              <input type="checkbox" id="check2">
              <label for="check2">Compte en devise</label>
            </li>
            <li>
              <input type="checkbox" id="check3">
              <label for="check3">Compte d’épargne</label>
            </li>
            <li>
              <input type="checkbox" id="check4">
              <label for="check4">Compte professionnel</label>
            </li>
          </ul>
        </ul>
        <ul class="tarifs-interval">
          <input type="text" maxlength="6" class="low-price" placeholder="Min" name="low-price">
          <input type="text" maxlength="6" class="high-price" placeholder="Max" name="high-price">
        </ul>
      </dd>
      </dd>
    </dl>
    <dl class="filters-subcategory">
      <dt>Opérations</dt>
      <dd class="criteres">
        <ul>
          <li>Doit avoir: </li>
          <ul class="scrollable-checkboxes">
            <li>
              <input type="checkbox" id="check1" checked>
              <label for="check1">Tous</label>
            </li>
            <li>
              <input type="checkbox" id="check2">
              <label for="check2">Versement espèces tiers</label>
            </li>
            <li>
              <input type="checkbox" id="check3">
              <label for="check3">Virement devise reçue de l’étranger</label>
            </li>
            <li>
              <input type="checkbox" id="check4">
              <label for="check4">Émission Chèque de banque déplacée</label>
            </li>
          </ul>
        </ul>
        <ul class="tarifs-interval">
          <input type="text" maxlength="6" class="low-price" placeholder="Min" name="low-price">
          <input type="text" maxlength="6" class="high-price" placeholder="Max" name="high-price">
        </ul>
      </dd>
    </dl>
    <dl class="filters-subcategory">
      <dt>Monétique</dt>
      <dd class="criteres">
        <ul>
          <li>Doit avoir: </li>
          <ul class="scrollable-checkboxes">
            <li>
              <input type="checkbox" id="check1" checked>
              <label for="check1">Tous</label>
            </li>
            <li>
              <input type="checkbox" id="check2">
              <label for="check2">Commission de paiement sur TPE/Commerçant</label>
            </li>
            <li>
              <input type="checkbox" id="check3">
              <label for="check3">Changement de code PIN</label>
            </li>
          </ul>
        </ul>
        <ul class="tarifs-interval">
          <input type="text" maxlength="6" class="low-price" placeholder="Min" name="low-price">
          <input type="text" maxlength="6" class="high-price" placeholder="Max" name="high-price">
        </ul>
      </dd>
    </dl>
  </div>
    ';

    return $filters;

}

function generateSortSection() {

    $sort= '<div class="sort-section">
    <span>Trier Par:</span>
    <div class="custom-select">
      <select autocomplete="off">
        <option selected value="0">Defaut</option>
        <option value="1">Tarifs Croissantes</option>
        <option value="2">Tarifs Décroissantes</option>
      </select>
      <span class="custom-arrow"></span>
    </div>
    <input class="sort-order-toggle" type="checkbox" id="sortOrder">
    <label class="sort-order-toggle-label" for="sortOrder">
      <span class="sort-arrow"></span>
      <span></span>
    </label>
  </div>';

    return $sort;

}

?>