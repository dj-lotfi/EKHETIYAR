<?php $this->setSiteTitle('Accueil'); ?>
<?php include "accueilView.php";
include __DIR__ . "../../CommenViewFunctions.php"; ?>
<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="utf8mb4">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/banks_squares.css">
    <script defer src="js/carousel.js"></script>
</head>

</html>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<!DOCTYPE html>
<html>

<body class="main-layout">
    <?php generateHeader(); ?>
    <section>
        <?php generateCarousel(); ?>
    </section>
    <main class="content-layout">
        <?php echo generateFiltersSection(); ?>
        <div>
            <?php echo generateSortSection(); ?>

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

                <!-- #region -->
                <div class="bank-card__container">
                    <div class="bank-card">
                        <p class="title">
                            <?php echo $bank->nom ?>
                        </p>
                            <div class="bank-logo"><a href="<?= $bank->site_banque ?>" target="_blank"><img src="<?= PROOT ?>/app/logos/<?= $logo->logo ?>" /></a></div>
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
                            <div class="prestations-button">Prestations
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
    <footer>
        <ul>
            <li><a href="<?= PROOT ?>/accueil">Accueil</a></li>
            <li><a href="<?= PROOT ?>/comparatif">Comparatif</a></li>
            <li><a href="<?= PROOT ?>/qui_sommes_nous">Qui Sommes-Nous</a></li>
        </ul>
        <div class="copyright">Copyright © 2023. All Rights Reserved.</div>
    </footer>
</body>

</html>
<?php $this->end(); ?>