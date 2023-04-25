<?php

class PrestationView extends View
{

    public function displayPrestation($id)
    {
        $p = $this->controller->getPrestationsById($id);
        $categorie = '';
        $i = 0;
        while ($i < count($p)) {
            if ($p[$i]->getCategorie() != $categorie) {
                $categorie = $p[$i]->getCategorie();
                ?>
                <dt class="category">
                    <?php echo $categorie; ?>
                </dt>
                <dd class="prestations">
                    <?php
                    while ($i < count($p)) {
                        if ($p[$i]->getCategorie() == $categorie) {
                            ?>
                            <ul class="prestation">
                                <li class="prestation-name">
                                    <?php echo $p[$i]->getNom(); ?>
                                </li>
                                <li class="prestation-value">
                                    <p>
                                        <?php echo (($p[$i]->getPrix() == null)||($p[$i]->getPrix() == '?')) ? 'NC' : $p[$i]->getPrix(); ?>
                                    </p>
                                    <?php if (($p[$i]->getPrix() != null)&&($p[$i]->getPrix() != '?')&&($p[$i]->getPrix() != '')) { ?>
                                        <p>
                                            <?php echo $p[$i]->getDateValeur(); ?>
                                        </p>
                                    <?php } ?>
                                </li>
                            </ul>
                            <?php
                            $i++;
                        } else {
                            break;
                        }
                    }
                    ?>

                </dd>
                <?php
            }
        }
    }
}




?>