<?php $this->setSiteTitle('Qui Sommes-Nous'); ?>

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
    <body class="main-layout">
        <header>
            <h3 class="logo">Logo</h3>
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <nav class="navbar">
                <ul>
                <li><a href="<?=PROOT?>/accueil">Accueil</a></li>
                <li><a href="<?=PROOT?>/comparatif">Comparatif</a></li>
                <li><a href="<?=PROOT?>/qui_sommes_nous">Qui Sommes-Nous</a></li>
                </ul>
            </nav>
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span>
            </label>
        </header>
        <section>
            <div class="carousel">
    
                <button class="carousel__button carousel__button--left">
                    <img src="<?=PROOT?>/img/left.svg" alt="">
                </button>
    
                <div class="coursel__track-container">
                    <ul class="carousel__track">
                        <li class="carousel__slide current-slide">
                            <img class="carousel__image" src="<?=PROOT?>/img/img.jpg" alt="">
                        </li>
                        <li class="carousel__slide">
                            <img class="carousel__image" src="<?=PROOT?>/img/img1.webp" alt="">
                        </li>
                        <li class="carousel__slide">
                            <img class="carousel__image" src="<?=PROOT?>/img/img2.jpg" alt="">
                        </li>
                    </ul>
                </div>
    
                <button class="carousel__button carousel__button--right">
                    <img src="<?=PROOT?>/img/right.svg" alt="">
                </button>
    
                <div class="carousel__nav">
                    <button class="carousel__indicator current-slide"></button>
                    <button class="carousel__indicator"></button>
                    <button class="carousel__indicator"></button>
                </div>
    
            </div>
        </section>
        <main class="content-layout">
            <?php $dump = new qui_sommes_nousModel();
            $res = $dump->getQSN(); ?>
            <h4> Description </h4>
            <p> <?php echo $res->description;    ?>
            </p>
            <h4>Telephone </h4>
            <p><?php echo $res->telephone ?></p>
            <h4>Email </h4>
            <p><?php echo $res->email ?></p>
        </main>
        <footer>
            <ul>
                <li><a href="<?=PROOT?>/accueil">Accueil</a></li>
                <li><a href="<?=PROOT?>/comparatif">Comparatif</a></li>
                <li><a href="<?=PROOT?>/qui_sommes_nous">Qui Sommes-Nous</a></li>
            </ul>
            <div class="copyright">Copyright © 2023. All Rights Reserved.</div>
        </footer>
    </body>
</html>
<?php $this->end(); ?>

<!--<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>This is a propos description</title>
       //Latest compiled and minified CSS
    </head>
    <body>
      <?php //var_dump($res); ?>

        <h1> Description </h1>
        <p> 
        <?php echo $_SESSION['result']->description ?> 
        </p>
        <h1> Telephone </h1>
        <p>
        <?php echo $_SESSION['result']->telephone ; ?>
        </p>
        <h1>Email</h1>
        <p>
        <?php echo $_SESSION['result']->email?>
        </p>
           
    </body>
</html>-->
