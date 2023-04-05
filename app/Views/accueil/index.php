<?php $this->setSiteTitle('Accueil'); ?>

<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="utf8mb4">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/banks_squares.css">
    <script defer src="js/prestation.js"></script>
</head>

</html>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<!DOCTYPE html>
<html>

<body class="main-layout">
    <header>
        <h3 class="logo">Logo</h3>
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
    </header>
    <section>
        <div class="carousel">

            <button class="carousel__button carousel__button--left">
                <img src="<?= PROOT ?>/img/left.svg" alt="">
            </button>

            <div class="coursel__track-container">
                <ul class="carousel__track">
                    <li class="carousel__slide current-slide">
                        <img class="carousel__image" src="<?= PROOT ?>/img/img.jpg" alt="">
                    </li>
                    <li class="carousel__slide">
                        <img class="carousel__image" src="<?= PROOT ?>/img/img1.webp" alt="">
                    </li>
                    <li class="carousel__slide">
                        <img class="carousel__image" src="<?= PROOT ?>/img/img2.jpg" alt="">
                    </li>
                </ul>
            </div>

            <button class="carousel__button carousel__button--right">
                <img src="<?= PROOT ?>/img/right.svg" alt="">
            </button>

            <div class="carousel__nav">
                <button class="carousel__indicator current-slide"></button>
                <button class="carousel__indicator"></button>
                <button class="carousel__indicator"></button>
            </div>

        </div>
    </section>
    <main class="content-layout">
        <section></section>
        <div> <!--<div class="grid">-->
            <div class="sort-section">
                <span>Trier Par:</span>
                <div class="custom-select">
                    <select autocomplete="off">
                        <option selected value="0">Defaut</option>
                        <option value="1">Tarifs Croissantes</option>
                        <option value="2">Tarifs Décroissantes</option>
                    </select>
                    <span class="custom-arrow"></span>
                </div>
            </div>
            <?php
            function displayPrestations($id)
            {
                $pres = new PrestationModel();
                $table = 'table' . $id;
                ?>
                <table id="<?php echo $table; ?>">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Categorie</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $prpr = $pres->getPrestations($id);
                        for ($i = 0; $i < sizeof($prpr); $i++) {
                            echo '<tr>';
                            echo '<td>' . $prpr[$i]->nom . '</td>';
                            echo '<td>' . $prpr[$i]->categorie . '</td>';
                            if ($prpr[$i]->prix == null) {
                                echo '<td>' . '?' . '</td>';
                            } else {
                                echo '<td>' . $prpr[$i]->prix . '</td>';
                            }


                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>

            <?php
            function displayBank($bankId)
            {
                $model = new BanqueModel();
                $bank = $model->getBanque($bankId);

                $buttonId = 'prestations-button-' . $bankId;
                $modalId = 'prestations-modal-' . $bankId;
                ?>

                <!-- #region --><div class="bank-card">
                    <p class="title">
                        <?php echo $bank->nom ?>
                    </p>
                    <div class="bank-logo"><img src="img/right.svg"></div>
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
                    <div class="more-info"></div>
                    <div><a href="<?php echo $bank->site_banque ?>" class="site-link"><?php echo $bank->site_banque ?></a></div>
                    <div class="prestations-button">Prestations<div class="prestations-button__handler">?</div>
                    </div>
                    
                    <div class="map__container"><iframe
                            src="https://www.google.com/maps/d/embed?mid=1n3rOTqTkG_JeSe_0sCcn4lGBXiv4DrU&ehbc=2E312F&z=12"
                            frameborder="0" class="hide-map-bar"></iframe></div> 
                    <button class="view-button">Voir Plus</button>
                    <div>
                        <!-- The Modal -->
                        <div class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Prestations</h2>
                                <?php displayPrestations($bankId); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="rectangle">
                    <p>
                        Nom:
                        <?php /*echo iconv('ISO-8859-1', 'UTF-8', $bank->nom) ?><br>
                        Adresse:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->adresse_siege_social) ?><br>
                        Telephone:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->telephone) ?><br>
                        Fax:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->fax) ?><br>
                        Site:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->site_banque) ?>
                    </p>
                    <div>
                        <button id="<?php echo $buttonId; ?>" class="prestations-button">Prestations</button>
                        /* The Modal 
                        <div id="<?php echo $modalId; ?>" class="modal">
                            /* Modal content 
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Prestations</h2>
                                <?php displayPrestations($bankId); ?>

                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById("<?php echo $modalId; ?>").getElementsByClassName("close")[0].onclick = function () {

                            document.getElementById("<?php echo $modalId; ?>").style.display = "none";
                        };
                        document.getElementById("<?php echo $buttonId; ?>").onclick = function () {

                            document.getElementById("<?php echo $modalId; */?>").style.display = "block";

                        };
                    </script>
                </div>-->

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