<?php

class ComparatifController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);


        $this->view = new comparatifView($this);
        $this->view->setLayout('default');
    }

    public function indexAction() //nom_de_la_method+Action
    {
        $this->view->renderHead();
        $this->view->renderBody();
        $this->view->renderFooter();

        if (isset($_POST['Submit'])) {
            $bank1 = $_POST['bank1'];
            $bank2 = $_POST['bank2'];
        }
    }



    public function displayComparaison($bank1, $bank2)
    {
        //$this->view->displayComparaison($bank1,$bank2);
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
                <h3 style="color: blue">
                    <?php echo $category ?>
                </h3>
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
                <?php
            }
            ?>
        </div>
        <?php
    }
}