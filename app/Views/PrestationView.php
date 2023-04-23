<?php

    class PrestationView extends View 
    {

        public function displayPrestation($id)
        {
            ?>
            <div id="<?php echo 'table' . $id; ?>">
                <?php
                $p = $this->controller->getPrestationsById($id);
                $categorie = '';
                $i = 0;
                while ($i < count($p)) {
                    if ($p[$i]->getCategorie() != $categorie) {
                        $categorie = $p[$i]->getCategorie();
                        ?>
                            <p><?php echo $categorie ;?></p>
                            <table>
                                <tbody>
                                    <?php
                                        while ($i < count($p) ) {
                                            if ($p[$i]->getCategorie() == $categorie) {
                                                ?>
                                                    <tr>
                                                        <td align="left"><?php echo $p[$i]->getNom() ; ?></td>
                                                        <td align="center"><?php echo ($p[$i]->getPrix() == null) ? '?' : $p[$i]->getPrix() ; ?></td>
                                                        <td align="right"><?php echo ($p[$i]->getDateValeur() == null) ? '?' : $p[$i]->getDateValeur() ; ?></td>
                                                    </tr>
                                                <?php
                                                $i++;
                                            } else {
                                                break;
                                            }
                                        }
                                    ?>

                                </tbody>
                            </table>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
    }
    



?>
