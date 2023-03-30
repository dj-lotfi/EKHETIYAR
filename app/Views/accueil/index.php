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
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(1)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(1)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(1)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(1)->fax) ?>
                    <br> Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(1)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(2)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(2)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(2)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(2)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(2)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(3)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(4)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(4)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(4)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(4)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(4)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(5)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(5)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(5)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(5)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(5)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(6)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(6)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(6)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(6)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(6)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(7)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(7)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(7)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(7)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(7)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(8)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(8)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(8)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(8)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(8)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(9)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(9)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(9)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(9)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(9)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(10)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(10)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(10)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(10)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(10)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(11)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(11)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(11)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(11)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(11)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(12)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(12)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(12)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(12)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(12)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(13)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(13)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(13)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(13)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(13)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(14)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(14)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(14)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(14)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(14)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(15)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(15)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(15)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(15)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(15)->site_banque);?>
            </p>
        </div>
        <br>
        <div class="rectangle" >
            <p>
                <?php $model = new BanqueModel();?>
                    Nom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(16)->nom) ?>
                    <br> Prenom :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(16)->adresse_siege_social) ?>
                    <br> Telephone :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(16)->telephone) ?>
                    <br> Fax :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(16)->fax) ?>
                    <br>Site :
                    <?php echo iconv('ISO-8859-1', 'UTF-8',$model->getBanque(16)->site_banque);?>
            </p>
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