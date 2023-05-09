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
                <section>
                    <h1 class="section-title">Notre Vision</h1>
                    <p class="section-body">
                        Nous croyons que le choix d'une banque devrait être facile et transparent pour tout le monde. Nous
                        voulons aider les gens à trouver la banque qui répond le mieux à leurs besoins et à leurs objectifs
                        financiers.
                    </p>
                </section>

                <section>
                    <h1 class="section-title">Comment Nous Fonctionnons</h1>
                    <p class="section-body">
                        Nous recueillons des informations sur les offres bancaires de différentes banques et les affichons
                        de manière claire et concise sur notre site web. Nous fournissons également des outils de
                        comparaison pour aider les gens à trouver l'offre qui convient le mieux à leurs besoins. Nous ne
                        sommes affiliés à aucune banque et nous ne sommes pas payés pour promouvoir une offre en
                        particulier. Nous nous engageons à être honnêtes et transparents dans notre processus de
                        comparaison.
                    </p>
                </section>
                <section>
                    <h1 class="section-title">À Propos de Nous</h1>
                    <p class="section-body">
                        Nous sommes une équipe de six étudiants de l'ESI (École Supérieure d'Informatique) à Alger, Algérie.
                        Nous avons fondé ce site web dans le cadre de notre projet 2CP en 2023. Notre mission est de
                        faciliter le choix d'une banque pour tout le monde en fonction de ce qu'ils recherchent.
                    </p>
                </section>
                <section>
                    <h1 class="section-title">Notre équipe</h1>
                    <div class="contacts__container">
                        <div class="contact" style="color:#2cb502;">
                            <div class="person">
                                <div class="person__container">
                                    <img class="circle" src="./img/contact_avatars/a-bg_arr.png" alt="">
                                    <img class="avatar__circle" src="./img/contact_avatars/a_arr.png" alt="memeber avatar">
                                </div>
                            </div>
                            <div class="full-name" style="border-top: 2px solid #2cb502;">
                                ARROUCHE Abdellah
                            </div>
                            <div class="email">
                                la_arrouche@esi.dz
                            </div>
                            <div class="tel">
                            </div>
                        </div>
                        <div class="contact" style="color:#2b4c6d;">
                            <div class="person">
                                <div class="person__container">
                                    <img class="circle" src="./img/contact_avatars/a-bg_claudeMonet.jpg" alt="">
                                    <img class="avatar__circle" src="./img/contact_avatars/" alt="memeber avatar">
                                </div>
                            </div>
                            <div class="full-name" style="border-top: 2px solid #2b4c6d;">
                                DJEGHRI Lotfi
                            </div>
                            <div class="email">
                                ll_djeghri@esi.dz
                            </div>
                            <div class="tel">
                                (<span> 213 </span>) <span>555 27 87 89</span>
                            </div>
                        </div>
                        <div class="contact" style="color:#e38452;">
                            <div class="person">
                                <div class="person__container">
                                    <img class="circle" src="./img/contact_avatars/a-bg_placeholder.webp" alt="">
                                    <img class="avatar__circle" src="./img/contact_avatars/a_placeholder.png" alt="memeber avatar">
                                </div>
                            </div>
                            <div class="full-name" style="border-top: 2px solid #e38452;">
                                KASSOUSSI Oussama Mehdi
                            </div>
                            <div class="email">
                                lo_kassoussi@esi.dz
                            </div>
                            <div class="tel">
                                (<span> 213 </span>) <span>555 27 87 89</span>
                            </div>
                        </div>
                    </div>
                    <div class="contacts__container">
                        <div class="contact" style="color:red;">
                            <div class="person">
                                <div class="person__container">
                                    <img class="circle" src="./img/contact_avatars/" alt="">
                                    <img class="avatar__circle" src="./img/contact_avatars/" alt="memeber avatar">
                                </div>
                            </div>
                            <div class="full-name" style="border-top: 2px solid red;">
                                MEGDAD Imed
                            </div>
                            <div class="email">
                                li_megdad@esi.dz
                            </div>
                            <div class="tel">
                                (<span> 213 </span>) <span>555 27 87 89</span>
                            </div>
                        </div>
                        <div class="contact" style="color:red;">
                            <div class="person">
                                <div class="person__container">
                                    <img class="circle" src="./img/contact_avatars/" alt="">
                                    <img class="avatar__circle" src="./img/contact_avatars/" alt="memeber avatar">
                                </div>
                            </div>
                            <div class="full-name" style="border-top: 2px solid red;">
                                MENASSEL Rayan Ibrahim
                            </div>
                            <div class="email">
                                lr_menassel@esi.dz
                            </div>
                            <div class="tel">
                                (<span> 213 </span>) <span>555 27 87 89</span>
                            </div>
                        </div>
                        <div class="contact" style="color:red;">
                            <div class="person">
                                <div class="person__container">
                                    <img class="circle" src="./img/contact_avatars/" alt="">
                                    <img class="avatar__circle" src="./img/contact_avatars/" alt="memeber avatar">
                                </div>
                            </div>
                            <div class="full-name" style="border-top: 2px solid red;">
                                TIROUCHE Mohamed Mahdi
                            </div>
                            <div class="email">
                                lm_tirouche@esi.dz
                            </div>
                            <div class="tel">
                                (<span> 213 </span>) <span>555 27 87 89</span>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <?php $this->generateFooter(); ?>
        </body>

        <?php $this->end();

        require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php


    }
}
?>