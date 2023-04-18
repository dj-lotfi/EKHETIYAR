<?php $this->setSiteTitle('Comparatif'); ?>
<?php include __DIR__ . "../../CommenViewFunctions.php"; ?>
<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/comparatif.css">
</head>

</html>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<!DOCTYPE html>
<html>

<body class="main-layout">
<?php generateHeader(); ?>
    <!--<section>
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
    </section>-->
    <main class="comparatif-layout">
        <?php
        $model = new BanqueModel();

        ?>
        <div class="container">
            <h1>Select Banks</h1>
            <form method="post">
                <div class="select-container">
                    <div></div>
                    <div>
                        <label for="bank1">Select Bank 1:</label>
                        <select id="bank1" name="bank1">
                            <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $model->getBanque($i)->nom; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label for="bank2">Select Bank 2:</label>
                        <select id="bank2" name="bank2">
                            <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $model->getBanque($i)->nom; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>

    </main>
    <section></section>
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