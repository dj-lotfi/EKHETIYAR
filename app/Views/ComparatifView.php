<?php
class ComparatifView extends View
{
    public function render()
    {
        $this->setSiteTitle('Comparatif');

        $this->start('head'); ?>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/comparatif.css?v=<?php echo time(); ?>">

        <?php $this->end();

        $this->start('body'); ?>

        <body class="main-layout">
            <?php $this->generateHeader(); ?>
            <main class="comparatif-layout">
                <?php
                $model = new BanqueModel();
                ?>
                <div class="container">
                    <h1>Select Banks</h1>
                    <form method="post">
                        <div class="select-container">
                            <div></div>
                            <div>
                                <label for="bank1">Select Bank 1:</label>
                                <select id="bank1" name="bank1">
                                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $model->getBanque($i)->nom; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <label for="bank2">Select Bank 2:</label>
                                <select id="bank2" name="bank2">
                                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $model->getBanque($i)->nom; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>

            </main>
            <section></section>
            <?php $this->generateFooter(); ?>
        </body>

        <?php $this->end();

        require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php

    }
}

?>