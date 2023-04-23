<?php
    class qui_sommes_nousView extends View 
    {
        
        public function render()
        {
            $this->setSiteTitle('Qui Sommes-Nous'); 
            include __DIR__ . "../CommenViewFunctions.php";

            $this->start('head'); ?>

                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <link rel='stylesheet' type='text/css' href='css/qui_sommes_nous.css?v=<?php echo time(); ?>'>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <?php $this->end();

            $this->start('body'); ?>

                <body class="main-layout">
                    <?php generateHeader(); ?>
                    <section></section>
                    <main>
                        <div class="prop">
                            <?php $dump = new qui_sommes_nousModel();
                            $res = $dump->getQSN(); ?>
                            <section>
                                <h2>À Propos de Nous</h2>
                                <p>
                                    <?php echo $res->prop ?>
                                </p>
                                <p>Notre équipe se compose de:</p>
                                <ul>
                                    <li>MENASSEL Rayane</li>
                                    <li>KASSOUSSI Oussama</li>
                                    <li>DJEGHRI Lotfi</li>
                                    <li>ARROUCHE Abdellah</li>
                                    <li>MEGDAD Imed</li>
                                    <li>TIROUCHE Mehdi</li>
                                </ul>
                            </section>
                            <section>
                                <h2>Notre Vision</h2>
                                <p>
                                    <?php echo $res->vision ?>
                                </p>
                            </section>
                            <section>
                                <h2>Comment Nous Fonctionnons</h2>
                                <p>
                                    <?php echo $res->fonctionnement ?>
                                </p>
                            </section>
                        </div>

                    </main>
                    <?php generateFooter(); ?>
                </body>

            <?php $this->end();

            require_once(ROOT . DS .'app'. DS . 'Views' . DS . 'layouts' . DS . $this->_layout .'.php');//affiche la page layouts/default.php


        }
    }
        









