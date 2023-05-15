<?php
class ComparatifView extends View
{

    public function logoCorrespondense($banks,$id)
    {
        foreach ($banks as $object) {
            if ($object->id_banque == $id) {
              return $object->logo;
            }
          }
        
          return null;
    }

    public function render()
    {
        $this->setSiteTitle('Comparatif');

        $this->start('head'); ?>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/comparatif.css?v=<?php echo time(); ?>">
        <script defer src="js/comparaison.js?v=<?php echo time(); ?>"></script>

        <?php $this->end();

        $this->start('body'); ?>

        <body class="cmp-layout">
            <?php $this->generateHeader(); ?>
            <main class="comparatif-layout">
                <?php
                $model = new BanqueModel();
                $b = array();
                $b= $model->getBanknames();

                ?>
                <div class="container">
                    <h1>Comparaison</h1>
                    <form id="choix" method="post">
                        <div class="select-container">
                            <div class="vertically-centered">
                                <img class="bank-logo__cmp" src="/ProjectFileV5/app/logos/blank.svg" id="b1">
                                <select id="bank1" name="bank1" onchange="changelogo(this)">
                                    <option value="disabled1" disabled selected="selected" >--Selectioner une banque</option>
                                    <?php for ($i = 0; $i < count($b); $i++) { ?>
                                        <option value="<?php echo $b[$i]->id_banque; ?>" id="<?php echo $b[$i]->logo ?>"><?php echo $b[$i]->nom; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="vertically-centered">
                                <img class="bank-logo__cmp" src="/ProjectFileV5/app/logos/blank.svg" id="b2">
                                <select id="bank2" name="bank2" onchange="changelogo(this)">
                                    <option value="disabled2" disabled selected="selected" >--Selectioner une banque</option>
                                    <?php for ($i = 0; $i < count($b); $i++) { ?>
                                        <option value="<?php echo $b[$i]->id_banque; ?>" id="<?php echo $b[$i]->logo ?>"><?php echo $b[$i]->nom; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="submit" id="SubmitBtn" value="Comparer" >
                            
                        </div>
                    </form>
                </div>

                <div id="loader" class="loader">
                    <div class="justify-content-center jimu-primary-loading"></div>
                </div>

                <div id="comparaison" class="comparison-slider__container"></div>

                <div id="error" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closePopup()">&times;</span>
                        <h3>Selectionnez deux banques differents !!</h3>
                    </div>
                </div>


                </div>
                </div>

            </main>
            <?php $this->generateFooter(); ?>
        </body>

        <?php $this->end();

        require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php
    }

    public function displayComparaison($bank1, $bank2)
    {
        $pres1 = array();
        $pres2 = array();


        $mod = new PrestationModel();

        $bm = new BanqueModel();

        $pres1 = $mod->getPrestationscom($bank1);
        $pres2 = $mod->getPrestationscom($bank2);
        $bank = new BanqueModel();

        $categories = array('Gestion et tenue de compte','Opération de paiement','Monétique/CARTE C.I.B','Monétique/Carte internationale');

        //var_dump($categories);
        ?>
        <input class="category-input" type="radio" name="label-accordion" id="CAT-1" checked>
        <input class="category-input" type="radio" name="label-accordion" id="CAT-2">
        <input class="category-input" type="radio" name="label-accordion" id="CAT-3">
        <input class="category-input" type="radio" name="label-accordion" id="CAT-4">

        <div class="label-accordion">
            <label for="CAT-1" class="category-label">
                <svg viewBox="0 0 384 512">
                    <path
                        d="M288 256H96v64h192v-64zm89-151L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zM64 72c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8V72zm0 64c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8v-16zm256 304c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-200v96c0 8.84-7.16 16-16 16H80c-8.84 0-16-7.16-16-16v-96c0-8.84 7.16-16 16-16h224c8.84 0 16 7.16 16 16z" />
                </svg>
                <p>Gestion</p>
            </label>
            <label for="CAT-2" class="category-label">
                <svg viewBox="0 0 512 512">
                    <path
                        d="M0 168v-16c0-13.255 10.745-24 24-24h360V80c0-21.367 25.899-32.042 40.971-16.971l80 80c9.372 9.373 9.372 24.569 0 33.941l-80 80C409.956 271.982 384 261.456 384 240v-48H24c-13.255 0-24-10.745-24-24zm488 152H128v-48c0-21.314-25.862-32.08-40.971-16.971l-80 80c-9.372 9.373-9.372 24.569 0 33.941l80 80C102.057 463.997 128 453.437 128 432v-48h360c13.255 0 24-10.745 24-24v-16c0-13.255-10.745-24-24-24z" />
                </svg>
                <p>Opération</p>
            </label>
            <label for="CAT-3" class="category-label">
                <svg viewBox="0 0 640 512">
                    <path
                        d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z" />
                </svg>
                <p>Monétique C.I.B</p>
            </label>
            <label for="CAT-4" class="category-label">
                <svg viewBox="0 0 496 512">
                    <path
                        d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z" />
                </svg>
                <p>Monétique International</p>
            </label>
        </div>

        <div class="category-accordion">
            <?php
            foreach ($categories as $key => $category) {
                ?>
                <ul class="category-slide">
                    <?php
                    for ($i = 0; $i < count($pres1); $i++) {
                        $trouv = 0;
                        $j = 0;
                        while ( ($trouv == 0) && ($j < count($pres2)) ) {
                            if ($pres1[$i]->getNom() == $pres2[$j]->getNom() && $pres1[$i]->getCategorie() == $category && $pres2[$j]->getCategorie() == $category ) {
                                $trouv =1;
                            } else {
                                $j++;
                            }
                        }

                        if ($trouv == 1 && ($pres1[$i]->getPrix() != null || $pres2[$j]->getPrix() != null)) {
                            ?>
                            <li class="prestation">
                                <div class="name">
                                    <?php echo $pres1[$i]->getNom() ?>
                                </div>
                                <div class="values">
                                    <?php if (($pres1[$i]->getPrix() < $pres2[$j]->getPrix() && $pres1[$i]->getPrix() != null ) || $pres2[$j]->getPrix() == null) { ?>
                                        <div class="lower">
                                            <div class="value">
                                                <?php echo $pres1[$i]->getPrix(); ?><span class="currency"><?php if($pres1[$i]->getPrix() != null){echo $pres1[$i]->getiso();} ?></span>
                                            </div>
                                            <div><?php echo $pres1[$i]->getDateValeur(); ?></div>
                                        </div>
                                        <div class="higher">
                                            <div class="value">
                                                <?php if($pres2[$j]->getPrix() != null){echo $pres2[$j]->getPrix();} else {echo "NC";} ?><span class="currency"><?php if($pres2[$j]->getPrix() != null){echo $pres2[$j]->getiso();} ?></span>
                                            </div>
                                            <div><?php echo $pres2[$j]->getDateValeur(); ?></div>
                                        </div>
                                    </div>
                                    <?php ;
                                    } elseif (($pres1[$i]->getPrix() > $pres2[$j]->getPrix() && $pres2[$j]->getPrix() != null) || $pres1[$i]->getPrix() == null) { ?>
                                    <div class="higher">
                                        <div class="value">
                                            <?php if($pres1[$i]->getPrix() != null) {echo $pres1[$i]->getPrix();} else {echo "NC";} ?><span class="currency"><?php if($pres1[$i]->getPrix() != null){echo $pres1[$i]->getiso();} ?></span>
                                        </div>
                                        <div><?php echo $pres1[$i]->getDateValeur(); ?></div>
                                    </div>
                                    <div class="lower">
                                        <div class="value">
                                            <?php echo $pres2[$j]->getPrix(); ?><span class="currency"><?php if($pres2[$j]->getPrix() != null){echo $pres2[$j]->getiso();} ?></span>
                                        </div>
                                        <div><?php echo $pres2[$j]->getDateValeur(); ?></div>
                                    </div>
                                    <?php ;
                                    } else { ?>
                                    <div>
                                        <div class="value">
                                            <?php echo $pres1[$i]->getPrix(); ?><span class="currency"><?php if($pres1[$i]->getPrix() != null){echo $pres1[$i]->getiso();} ?></span>
                                        </div>
                                        <div><?php echo $pres1[$i]->getDateValeur(); ?></div>
                                    </div>
                                    <div>
                                        <div class="value">
                                            <?php echo $pres2[$j]->getPrix(); ?><span class="currency"><?php if($pres2[$j]->getPrix() != null){echo $pres1[$i]->getiso();} ?></span>
                                        </div>
                                        <div><?php echo $pres2[$j]->getDateValeur(); ?></div>
                                    </div>
                                    <?php ;
                                    }
                        }

                    }

                    for ($i=0; $i < count($pres1) ; $i++) { 
                        if ($pres1[$i]->getCategorie() == $category) {
                            $trouv = 0;
                        } else {
                            $trouv = 1;
                        }
                        $j = 0;
                        while ( ($trouv == 0) && ($j < count($pres2)) ) {
                            if ($pres1[$i]->getCategorie() == $category) {
                                if ($pres1[$i]->getNom() == $pres2[$j]->getNom()  && $pres2[$j]->getCategorie() == $category ) {
                                    $trouv =1;
                                } else {
                                    $j++;
                                }
                            } else {
                                $j++;
                            }
                            
                        }

                        if ($trouv == 0 && $pres1[$i]->getPrix() != null) {
                            ?>
                            <li class="prestation">
                                <div class="name">
                                    <?php echo $pres1[$i]->getNom() ?>
                                </div>
                                <div class="values">
                                    <div class="lower">
                                        <div class="value">
                                            <?php echo $pres1[$i]->getPrix(); ?><span class="currency"><?php if($pres1[$i]->getPrix() != null){echo $pres1[$i]->getiso();} ?></span>
                                        </div>
                                        <div><?php echo $pres1[$i]->getDateValeur(); ?></div>
                                    </div>
                                    <div class="higher">
                                        <div class="value">
                                            <?php echo 'NC'; ?><span class="currency"></span>
                                        </div>
                                        <div></div>
                                    </div>
                                </div>
                            <?php ;

                        }
                    }

                    for ($i=0; $i < count($pres2) ; $i++) { 
                        if ($pres2[$i]->getCategorie() == $category  ) {
                            $trouv = 0;
                        } else {
                            $trouv = 1;
                        }

                        $j = 0;
                        while ( ($trouv == 0) && ($j < count($pres1)) ) {
                            if ($pres2[$i]->getCategorie() == $category) {
                                if ($pres2[$i]->getNom() == $pres1[$j]->getNom() && $pres1[$j]->getCategorie() == $category) {
                                    $trouv =1;
                                } else {
                                    $j++;
                                }
                            } else {
                                $j++;
                            }
                        }

                        if ($trouv == 0 && $pres2[$i]->getPrix() != null) {

                            ?>
                            <li class="prestation">
                                <div class="name">
                                    <?php echo $pres2[$i]->getNom() ?>
                                </div>
                                <div class="values">
                                    <div class="higher">
                                        <div class="value">
                                            <?php echo 'NC'; ?><span class="currency"></span>
                                        </div>
                                        <div></div>
                                    </div>
                                    <div class="lower">
                                        <div class="value">
                                            <?php echo $pres2[$i]->getPrix(); ?><span class="currency"><?php if($pres2[$i]->getPrix() != null){echo $pres2[$i]->getiso();} ?></span>
                                        </div>
                                        <div><?php echo $pres2[$i]->getDateValeur(); ?></div>
                                    </div>
                            <?php ;
    
                        }

                    }
                    
                    
                    
                    ?>

                </ul>

                <?php
            }
            ?>
        </div>
        <?php
    }
}

?>