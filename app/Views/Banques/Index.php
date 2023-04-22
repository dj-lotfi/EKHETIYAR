<?php

            function displayBank($bankId)
            {
                $model = new BanqueModel();
                $bank = $model->getBanque($bankId);
                $logo = $model->getLogo($bankId);
                $map = $model->getMap($bankId);

                $buttonId = 'prestations-button-' . $bankId;
                $modalId = 'prestations-modal-' . $bankId;
            ?>

                <!-- #region -->
                <div class="bank-card__container">
                    <div class="bank-card">
                        <p class="title">
                            <?php echo $bank->nom ?>
                        </p>
                        <div class="bank-logo"><img src="<?= PROOT ?>/app/logos/<?= $logo->logo ?>" /></div>
                        <div class="general-info">
                            <div class="seige-social">
                                <?php echo $bank->adresse_siege_social ?>
                            </div>
                            <div class="tel">
                                <?php echo $bank->telephone ?>
                            </div>
                            <div class="fax">
                                <?php echo $bank->fax ?>
                            </div>
                        </div>
                        <div class="more-info">
                            <div><a href="<?php echo $bank->site_banque ?>" class="site-link"><?php echo $bank->site_banque ?></a></div>
                            <div class="prestations-button">Prestations
                                <div class="prestations-button__handler" data-id="<?= $bankId ?>">?</div>
                            </div>



                            <div class="map__container">
                                <iframe src="<?= $map->lienmap ?>" frameborder="0" class="hide-map-bar"></iframe>
                            </div>
                        </div>
                        <button class="view-button">Voir Plus</button>
                    </div>


                    <!-- The Modal -->
                    <div class="modal">


                        <!--Modal content-->
                        <div class="modal-content">
                        <div id="modal" class="modal">
                            <div class="modal-content" id="modal-content">
                                <!-- Modal content will be inserted here -->
                            </div>
                            </div>
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


            <?php } ?>
            <div>
                <?php
                for ($i = 1; $i <= 20; $i++) {
                    displayBank($i);
                }
                ?>
            </div>