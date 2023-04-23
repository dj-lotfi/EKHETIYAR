<?php
    class BanqueView extends View 
    {
        function displayBank($bankId,$array)
        {
        
            $bank = $array[$bankId];

            
            
            
            $bank->getTelephone();
            $nom = $bank->getNom();
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
                        </div>
                        <div class="vertically-centered">
                            <a class="bank-logo" href="<?= $site_banque ?>" target="_blank"><img
                                    src="<?= PROOT ?>/app/logos/<?= $logo ?>" /></a>
                        </div>

                        <div class="general-info">
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
                            <div><a href="<?php echo $site_banque ?>" target="_blank" class="site-link"><?php echo $site_banque ?></a></div>
                            <div class="prestations-button vertically-centered">Prestations
                                <div class="prestations-button__handler" data-id="<?= $bankId ?>">?</div>
                            </div>
                            <div class="map__container">
                                <iframe src="<?= $lienmap ?>" frameborder="0" class="hide-map-bar"></iframe>
                            </div>
                        </div>
                        <button class="view-button">Voir Plus</button>
                    </div>


                    <!-- The Modal -->
                    <div class="modal">


                        <!--Modal content-->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Prestations</h2>
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

        public function displayAllBanques()
        {
            $res = $this->controller->getAllBanques();

            for ($i = 1; $i <= count($res); $i++) {
                $this->displayBank($i-1,$res);
            }
        }
    }
?>