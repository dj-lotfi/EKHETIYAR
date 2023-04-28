<?php
class ComparatifView extends View
{
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
                    <h1>Comparaison</h1>
                    <form id="choix" method="post">
                        <div class="select-container">
                            <div></div>
                            <div>
                                <label for="bank1"></label>
                                <select id="bank1" name="bank1">
                                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $model->getBanque($i)->nom; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <label for="bank2"></label>
                                <select id="bank2" name="bank2">
                                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $model->getBanque($i)->nom; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </form>
                    <button type="submit" id="SubmitBtn" form="choix">Comparer</button>


                    <div id="popup" class="modal1">

                        <div class="modal-content1">
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
                </div>

            </main>
            <section></section>
            <?php
    }

    public function displayComparaison($bank1, $bank2)
    {
        $mod = new PrestationModel();
        $pres1 = $mod->getPrestations($bank1);
        $pres2 = $mod->getPrestations($bank2);
        $bank = new BanqueModel();
        ?>
            <div>
                <?php
                for ($k = 0; $k < count(min($pres1, $pres2)); $k++) {
                    $cat1[$k] = $pres1[$k]->categorie;
                    $cat2[$k] = $pres2[$k]->categorie;

                }

                $categories = array_unique(array_merge($cat1, $cat2));
                unset($cat1, $cat2);

                //var_dump($categories);
        


                foreach ($categories as $key => $category) {
                    ?>

                    <div class="navigi">

                        <label for="<?= $key ?>"><span class="title">
                                <?php echo $category ?>
                            </span>
                        </label>
                        <input id="<?= $key ?>" class="touch" type="checkbox" onchange="afficheCategorie(this);"></input>
                        <div class="slide">
                            <table class="aligned-table">
                                <thead>
                                    <tr>
                                        <th>Prestation</th>
                                        <th>
                                            <?php echo $bank->getBanque($bank1)->abbreviation ?>
                                        </th>
                                        <th>
                                            <?php echo $bank->getBanque($bank2)->abbreviation ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count(min($pres1, $pres2)); $i++) {
                                        if ($pres1[$i]->getNom() == $pres2[$i]->getNom() && $pres1[$i]->getCategorie() == $category && $pres2[$i]->getCategorie() == $category /*&& $pres1[$i]->getPrix() != null && $pres2[$i]->getPrix() != null*/) {
                                            ?>
                                            <tr>

                                                <td class="left-column">
                                                    <?php echo $pres1[$i]->getNom() ?>
                                                </td>
                                                <td class="center-column"
                                                    style="color: <?php echo $pres1[$i]->getPrix() <= $pres2[$i]->getPrix() ? 'green' : 'red'; ?>;">
                                                    <?php echo $pres1[$i]->getPrix() ?: '?'; ?></td>
                                                <td class="right-column"
                                                    style="color: <?php echo $pres2[$i]->getPrix() <= $pres1[$i]->getPrix() ? 'green' : 'red'; ?>;">
                                                    <?php echo $pres2[$i]->getPrix() ?: '?'; ?></td>
                                            </tr>

                                            <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>

                        </div>

                    </div>

                    <?php
                }
                ?>
            </div>
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