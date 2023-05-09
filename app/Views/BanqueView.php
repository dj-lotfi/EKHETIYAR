<?php
class BanqueView extends View
{
    function displayBank($bank)
    {

        $pc = new PrestationController('','');
        $nom = $bank->getNom();
        $abbr = $bank->getAbbr();
        $logo = $bank->getLogo();
        $adresse_siege_social = $bank->getAdresse_siege_social();
        $telephone = $bank->getTelephone();
        $fax = $bank->getFax();
        $lienmap = $bank->getLienmap();
        $site_banque = $bank->getSite_banque();

        ?>

<div class="bank-card__container">
            <div class="bank-card">
                <div class="vertically-centered">
                    <p class="title">
                        <?php echo $nom ?>
                    </p>
                    <p class="mobile title">
                        <?php echo $abbr ?>
                    </p>
                </div>
                <div class="vertically-centered">
                    <a class="bank-logo" href="<?= $site_banque ?>" target="_blank">
                        <img src="<?= PROOT ?>/app/logos/<?= $logo ?>" />
                    </a>
                </div>

                <div class="general-info">
                    <p class="mobile sub-title">
                        <?php echo $nom ?>
                    </p>
                    <div class="seige-social">
                        <?php echo $adresse_siege_social ?>
                    </div>
                    <div class="tel">
                        <?php echo $telephone ?>
                    </div>
                    <div class="fax">
                        <?php echo $fax ?>
                    </div>
                </div>
                <div class="more-info">
                    <div>
                        <div><a href="<?php echo $site_banque ?>" target="_blank" class="site-link"><?php echo $site_banque ?></a>
                        </div>
                        
                        <?php  $pc->displayPrestation($bank->getId_banque()) ?>

                        <div class="map__container">
                            <iframe src="<?= $lienmap ?>" frameborder="0" class="hide-map-bar"></iframe>
                        </div>
                    </div>
                    
                </div>
                <button class="view-button">
                    <input type="checkbox" id="ViewMoreLess<?= $bank->getId_banque() ?>">
                    <label for="ViewMoreLess<?= $bank->getId_banque() ?>"></label>
                </button>
            </div>

            <!-- The Modal -->
            <div class="modal">
                <!--Modal content-->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <!-- Add a loading screen -->
                    <div class="loader">
                        <div class="justify-content-center jimu-primary-loading"></div>
                    </div>

                    <div class="prestations-content"></div>
                </div>
            </div>
        </div>
    <?php
    }

    public function getFilter($p,$min,$max)
    {
          $this->controller->getFilter($p,$min,$max);
    }
   

   public function displayAllBanques($order,$acs_desc)
   {
    
    $o = $this->controller->getOrder($order,$acs_desc);
    $t = $this->controller->filtercollecter();
    $p = $t[0];
    $min = $t[1];
    $max = $t[2];


    

    $f = $this->controller->getFilter($p,$min,$max);

    $res = $this->controller->getAllBanques();

    //var_dump($o);
        for ($i=0; $i < count($o); $i++) { 
            
            if(in_array($o[$i],$f))
            {
                $this->displayBank($res[$o[$i]]);
            }
            
        }
    
    
    

   }

}?>