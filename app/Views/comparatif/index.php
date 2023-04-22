<?php $this->setSiteTitle('Comparatif'); ?>
<?php include __DIR__ . "../../CommenViewFunctions.php"; ?>
<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/comparatif.css?v=<?php echo time(); ?>">
</head>

</html>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<!DOCTYPE html>
<html>

<body class="main-layout">
    <?php generateHeader(); ?>
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
    <?php generateFooter(); ?>
</body>

</html>
<?php $this->end(); ?>