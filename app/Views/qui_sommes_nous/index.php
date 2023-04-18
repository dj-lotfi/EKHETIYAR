<?php $this->setSiteTitle('Qui Sommes-Nous'); ?>
<?php include __DIR__ . "../../CommenViewFunctions.php"; ?>
<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

</html>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<!DOCTYPE html>
<html>
<style>
    /*A propos styles*/
    .prop {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin: 20px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .prop section {
        margin-bottom: 20px;
    }

    .prop h1 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
        background-color: #f5f5f5;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .prop h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .prop p {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 10px;
    }

    .prop ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .prop li {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 5px;
    }

    @media screen and (max-width: 768px) {
        .prop {
            flex-direction: column;
        }
    }
</style>

<body class="main-layout">
<?php generateHeader(); ?>
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
    <main>
        <section></section>
        <div class="prop">
            <?php $dump = new qui_sommes_nousModel();
            $res = $dump->getQSN(); ?>
            <section>
                <h2>À Propos de Nous</h2>
                <p>
                    <?php echo $res->prop ?>
                </p>
                <p>Notre équipe se compose de:</p>
                <ul>
                    <li>MENASSEL Rayane</li>
                    <li>KASSOUSSI Oussama</li>
                    <li>DJEGHRI Lotfi</li>
                    <li>ARROUCHE Abdellah</li>
                    <li>MEGDAD Imed</li>
                    <li>TIROUCHE Mehdi</li>
                </ul>
            </section>
            <section>
                <h2>Notre Vision</h2>
                <p>
                    <?php echo $res->vision ?>
                </p>
            </section>
            <section>
                <h2>Comment Nous Fonctionnons</h2>
                <p>
                    <?php echo $res->fonctionnement ?>
                </p>
            </section>
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