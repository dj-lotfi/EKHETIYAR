<?php
class ComparatifView extends View
{
    function displayComparaison($bank1, $bank2)
    {
        $mod = new PrestationModel();
        $pres1 = $mod->getPrestations($bank1);
        $pres2 = $mod->getPrestations($bank2);
        ?>
        <div>
            <?php
            $categorie = '';
            for ($k = 0; $k < count(min($pres1, $pres2)); $k++) {
                $cat1[$k] = $pres1[$k]->categorie;
                $cat2[$k] = $pres2[$k]->categorie;

            }
            $categories = array_unique(array_merge($cat1, $cat2));

            //var_dump($categories);
    


            $i = 0;
            while ($i < count($categories)) {
                if ($categories[$i] != $categorie) {
                    $categorie = $categories[$i];
                    ?>
                    <p>
                        <?php echo $categorie; ?>
                    </p>

                    <?php
                }
                $i++;
            }
            ?>
        </div>
        <?php

    }

    public function renderHead()
    {
        $this->setSiteTitle('Comparatif');

        $this->start('head'); ?>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/comparatif.css?v=<?php echo time(); ?>">

        <?php $this->end();
    }
    public function renderBody()
    {


        $this->start('body'); ?>

        <body class="main-layout">
            <?php $this->generateHeader(); ?>
            <main class="comparatif-layout">
                <?php
                $model = new BanqueModel();
                ?>
                <div class="container">
                    <h1>Select Banks</h1>
                    <form id="choix" method="post">
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


                            <div id="popup" class="modal">

                                <div class="modal-content2">
                                    <span class="close" onclick="closePopup()">&times;</span>
                                    <h1>Comparaison</h1>
                                    <div id="loader" class="loader">
                                        <div class="justify-content-center jimu-primary-loading"></div>
                                    </div>
                                    <div id="comparaison" class="comparaison"></div>
                                </div>

                            </div>
                            <div id="error" class="modal">
                                <div class="modal-content2">
                                    <span class="close" onclick="closePopup()">&times;</span>
                                    <h3>Selectionnez deux banques differents !!</h3>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>

            </main>
            <section></section>
            <?php
    }



    public function renderFooter()
    {
        $this->generateFooter(); ?>
            <script src="js\comparaison.js"></script>
        </body>

        <?php $this->end();

        require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php

    }
}

?>