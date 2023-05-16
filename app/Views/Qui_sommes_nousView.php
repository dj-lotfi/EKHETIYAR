<?php
class qui_sommes_nousView extends View
{
    public function render()
    {
        $this->setSiteTitle('Qui Sommes-Nous');

        $this->start('head'); ?>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel='stylesheet' type='text/css' href='css/qui_sommes_nous.css?v=<?php echo time(); ?>'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php $this->end();

        $this->start('body'); ?>

        <body class="qsn-layout">
            <?php $this->generateHeader(); ?>
            <main class="prop">


                <?php
                $m = new qui_sommes_nousModel();
                $m = $this->controller->getApropos();
                ?>
                <section>
                    <h1 class="section-title">Notre Vision</h1>
                    <p class="section-body">
                        <?php echo $m->getVision(); ?>
                    </p>
                </section>
                <section>
                    <h1 class="section-title">Comment Nous Fonctionnons</h1>
                    <p class="section-body">
                        <?php echo $m->getFonctionnement(); ?>
                    </p>
                </section>
                <section>
                    <h1 class="section-title">À Propos de Nous</h1>
                    <p class="section-body">
                        <?php echo $m->getProp(); ?>
                    </p>
                    <h1 class="section-title">Notre équipe</h1>
                    <?php
                    $m = array();
                    $m = $this->controller->getContacts(); ?>


                    <div class="contacts__container">
                        <?php
                        $this->generateContact($m[5]);
                        $this->generateContact($m[0]);
                        $this->generateContact($m[1]);
                        ?>
                    </div>
                    <div class="contacts__container">
                        <?php
                        $this->generateContact($m[2]);
                        $this->generateContact($m[3]);
                        $this->generateContact($m[4]);
                        ?>

                    </div>
                </section>
            </main>
            <?php $this->generateFooter(); ?>
        </body>

        <?php $this->end();

        require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php


    }

    private function generateVision()
    { ?>
        <section>
            <h1 class="section-title">Notre Vision</h1>
            <p class="section-body">
                <?php $this->controller->getVision(); ?>
            </p>
        </section>

        <?php
    }

    private function generateFonctionnement()
    { ?>
        <section>
            <h1 class="section-title">Comment Nous Fonctionnons</h1>
            <p class="section-body">
                <?php $this->controller->getFonctionnement(); ?>
            </p>
        </section>

        <?php
    }

    private function generateProp()
    { ?>
        <section>
            <h1 class="section-title">À Propos de Nous</h1>
            <p class="section-body">
                <?php $this->controller->getProp(); ?>
            </p>
        </section>

        <?php
    }

    private function generateContact($contact)
    { ?>
        <div class="contact" style="color:<?php echo $contact->theme_color; ?>;">
            <div class="person">
                <div class="person__container">
                    <img class="circle" src="./img/contact_avatars/<?php echo $contact->background; ?>" alt="">
                    <img class="avatar__circle" src="./img/contact_avatars/<?php echo $contact->avatar; ?>"
                        alt="memeber avatar">
                </div>
            </div>
            <div class="full-name" style="border-top: 2px solid <?php echo $contact->theme_color; ?>;">
                <?php echo $contact->nom; ?>
                <?php echo $contact->prenom; ?>
                <?php if ($contact->{'2eme_prenom'} != null)
                    echo $contact->{'2eme_prenom'}; ?>
            </div>
            <div class="email">
                <?php echo $contact->email; ?>
            </div>
            <div class="tel">
                <?php if ($contact->getTel() != null) {
                    echo "( <span>" . $contact->getCtry_code() . "</span> ) <span>" . $contact->getTel() . "</span>";
                } ?>
            </div>

        </div>

        <?php
    }
}
?>