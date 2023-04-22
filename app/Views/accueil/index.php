<?php $this->setSiteTitle('Accueil'); ?>
<?php include __DIR__ . "../../CommenViewFunctions.php";
    include "AccueilView.php" ?>
<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="utf8mb4">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='css/accueil.css?v=<?php echo time(); ?>'>
    <script defer src='js/carousel.js?v=<?php echo time(); ?>'></script>
</head>

</html>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<body class="main-layout">
    <?php generateHeader(); ?>
    <?php generateCarousel(); ?>
    <main class="content-layout">
        <div class="filters">
            <dl class="filters-subcategory">
                <dt>Gestion et tenue de comtpe</dt>
                <dd class="criteres">
                    <ul>
                        <li>Doit avoir: </li>
                        <ul class="scrollable-checkboxes">
                            <li>
                                <input type="checkbox" id="check1"
                                    value="shouldBePrestationName/SpecialIDFoundInDATABASE" checked>
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
        <div>
            <div class="sort-section">
                <span>Trier Par:</span>
                <div class="custom-select">
                    <select autocomplete="off">
                        <?php
                        function generateOrderChoices()
                        {
                            $model = new PrestationModel();

                            $nom = array();
                            $nom = $model->getPrestationsNom();

                            echo '<option value="" selected>Defaut</option>';
                            for ($i = 0; $i < count($nom); $i++) {
                                echo '<option value="' . $nom[$i] . '">' . $nom[$i] . '</option>';
                            }
                        }
                        generateOrderChoices();
                        ?>
                    </select>
                    <span class="custom-arrow"></span>
                </div>
                <input class="sort-order-toggle" type="checkbox" id="sortOrder">
                <label class="sort-order-toggle-label" for="sortOrder">
                    <span></span>
                </label>
            </div>

            <?php
            function displayBank($bankId)
            {
                $model = new BanqueModel();
                $bank = $model->getBanque($bankId);
                $logo = $model->getLogo($bankId);
                $map = $model->getMap($bankId);

                $buttonId = 'prestations-button-' . $bankId;
                $modalId = 'prestations-modal-' . $bankId;
                ?>

                <div class="bank-card__container">
                    <div class="bank-card">
                        <div class="vertically-centered">
                            <p class="title">
                                <?php echo $bank->nom ?>
                            </p>
                        </div>
                        <div class="vertically-centered">
                            <a class="bank-logo" href="<?= $bank->site_banque ?>" target="_blank"><img
                                    src="<?= PROOT ?>/app/logos/<?= $logo->logo ?>" /></a>
                        </div>

                        <div class="general-info">
                            <div class="seige-social">
                                <?php echo $bank->adresse_siege_social ?>
                            </div>
                            <div class="tel">
                                <?php echo $bank->telephone ?>
                            </div>
                            <div class="fax">
                                <?php echo $bank->fax ?>
                            </div>
                        </div>
                        <div class="more-info">
                            <div><a href="<?php echo $bank->site_banque ?>" target="_blank" class="site-link"><?php echo $bank->site_banque ?></a></div>
                            <div class="prestations-button vertically-centered">Prestations
                                <div class="prestations-button__handler" data-id="<?= $bankId ?>">?</div>
                            </div>
                            <div class="map__container">
                                <iframe src="<?= $map->lienmap ?>" frameborder="0" class="hide-map-bar"></iframe>
                            </div>
                        </div>
                        <button class="view-button">Voir Plus</button>
                    </div>


                    <!-- The Modal -->
                    <div class="modal">


                        <!--Modal content-->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Prestations</h2>
                            <!-- Add a loading screen -->
                            <div class="loader">
                                <div class="justify-content-center jimu-primary-loading"></div>
                            </div>

                            <div class="prestations-content"></div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div>
                <?php
                for ($i = 1; $i <= 20; $i++) {
                    displayBank($i);
                }
                ?>
            </div>
        </div>



    </main>
    <?php generateFooter(); ?>
</body>
<?php $this->end(); ?>