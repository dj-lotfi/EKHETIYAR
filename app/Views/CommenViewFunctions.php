<?php
function generateHeader()
{ ?>
    <header>
        <img class="logo" src="<?= PROOT ?>/img/Site_Logo.svg" alt="Logo du site">
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <nav class="navbar">
            <ul>
                <li><a href="<?= PROOT ?>/accueil">Accueil</a></li>
                <li><a href="<?= PROOT ?>/comparatif">Comparatif</a></li>
                <li><a href="<?= PROOT ?>/qui_sommes_nous">Qui Sommes-Nous</a></li>
            </ul>
        </nav>
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label>
    </header>
<?php } ?>
<?php
function generateFooter()
{ ?>
    <footer class="site-footer">
        <div class="footer--container">
            <div class="footer--logo">
                <a href="<?= PROOT ?>/accueil" aria-label="Ikhteyar">
                    <img class="svg-icon" src="<?= PROOT ?>/img/Site_Logo.svg" alt="Logo du site" width="62"> </a>
            </div>
            <nav class="footer--nav">
                <div class="footer--col">
                    <div class="col-title"><a href="<?= PROOT ?>/accueil">Ikhteyar</a></div>
                    <ul class="col-list">
                        <li><a href="<?= PROOT ?>/accueil">Accueil</a></li>
                        <li><a href="<?= PROOT ?>/comparatif">Comparatif</a></li>
                        <li><a href="<?= PROOT ?>/qui_sommes_nous">Qui Sommes-Nous</a></li>
                    </ul>
                </div>
            </nav>
        </div>

    </footer>
<?php } ?>