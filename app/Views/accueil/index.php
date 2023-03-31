<?php $this->setSiteTitle('Accueil'); ?>

<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="utf8mb4">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\banks_squares.css">
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
        <div class="grid">
        <?php
            function displayBank($bankId)
            {
                $model = new BanqueModel();
                $bank = $model->getBanque($bankId);
                $pres = new PrestationModel();
                $buttonId = 'prestations-button-' . $bankId;
                $modalId = 'prestations-modal-' . $bankId;
                $table = 'table' . $bankId;
                ?>
                <div class="rectangle">
                    <p>
                        Nom:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->nom) ?><br>
                        Adresse:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->adresse_siege_social) ?><br>
                        Telephone:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->telephone) ?><br>
                        Fax:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->fax) ?><br>
                        Site:
                        <?php echo iconv('ISO-8859-1', 'UTF-8', $bank->site_banque) ?>
                    </p>
                    <button id="<?php echo $buttonId; ?>" class="prestations-button" >Prestations</button>
                    <!-- The Modal -->
                    <div id="<?php echo $modalId; ?>" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Prestations</h2>
                            <table id="<?php echo $table; ?>" >
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Categorie</th>
                                        <th>Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $prpr = $pres->getPrestations($bankId);
                                    for ($i=0 ; $i<sizeof($prpr);$i++) {
                                        echo '<tr>';
                                        echo '<td>' . iconv('ISO-8859-1', 'UTF-8', $prpr[$i]->nom) . '</td>';
                                        echo '<td>' . iconv('ISO-8859-1', 'UTF-8', $prpr[$i]->categorie) . '</td>';
                                        echo '<td>' . iconv('ISO-8859-1', 'UTF-8', $prpr[$i]->prix) . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <script>
                        // Get the modal
                        var modal = document.getElementById("<?php echo $modalId; ?>");

                        // Get the button that opens the modal
                        var btn = document.getElementById("<?php echo $buttonId; ?>");

                        // Get the <span> element that closes the modal
                        var span = modal.getElementsByClassName("close")[0];

                        // When the user clicks on the button, open the modal
                        btn.onclick = function () {
                            modal.style.display = "block";
                        }

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal.style.display = "none";
                        }

                        // When the user clicks anywhere outside of the modal
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>
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