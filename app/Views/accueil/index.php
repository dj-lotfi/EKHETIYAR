<?php $this->setSiteTitle('Accueil'); ?>
<?php include __DIR__ . "../../CommenViewFunctions.php"; ?>
<?php $this->start('head'); ?>
<html>

<head>
    <meta charset="utf8mb4">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='css/accueil.css?v=<?php echo time(); ?>'>
    <script defer src='js/carousel.js?v=<?php echo time(); ?>'></script>
</head>

</html>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<!DOCTYPE html>
<html>

<body class="main-layout">
    <?php generateHeader(); ?>
    <section>
        <?php

        function imageFinder($dirPath = '.' . DS . 'img' . DS . 'carousel_images') // Directory path to search for files
        {
            // Open the directory
            $dirHandle = opendir($dirPath);

            // Check if directory was opened successfully
            if ($dirHandle) {
                $imgArray = array();
                // Loop through all files and directories in the directory
                while (($file = readdir($dirHandle)) !== false) {
                    // Exclude special directories . and ..
                    if ($file != '.' && $file != '..') {
                        // Get the file's extension
                        $extension = pathinfo($file, PATHINFO_EXTENSION);

                        // Check if the entry is a file and has an extension
                        if (is_file($dirPath . DS . $file) && !empty($extension)) {
                            // Output the file name and extension
                            if ($extension == 'jpg' || $extension == 'png' || $extension == 'webp' || $extension == 'jpeg') {
                                array_push($imgArray, $dirPath . DS . $file);
                            }
                        }
                    }
                }

                $_SESSION['img'] = $imgArray;

                // Close the directory handle
                closedir($dirHandle);
            } else {
                echo "Failed to open directory.";
            }
        }

        function imageGenerator($array)
        {
            if (sizeof($array) > 0) {
                for ($i = 0; $i < sizeof($array); $i++) {
                    echo '<img src="' . $array[$i] . '" alt="Image ' . $i + 1 . '">';
                }
            }
        }
        ?>

        <div class="slider-container" style="max-width: 800px; height: 400px;">
            <div class="slider" style="width: 100%;">
                <?php
                imageFinder();
                imageGenerator($_SESSION['img']);
                ?>
            </div>
            <div class="slider-control" id="prev">&#10094;</div>
            <div class="slider-control" id="next">&#10095;</div>
            <div class="slider-dots" id="dots"></div>
        </div>
    </section>
    <main class="content-layout">
        <div class="filters">
            <dl class="filters-subcategory">
                <dt>Gestion et tenue de comtpe</dt>
                <dd class="criteres">
                    <ul>
                        <li>Doit avoir: </li>
                        <ul class="scrollable-checkboxes">
                            <li>
                                <input type="checkbox" id="check1"
                                    value="shouldBePrestationName/SpecialIDFoundInDATABASE" checked>
                                <label for="check1">Tous</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check2">
                                <label for="check2">Compte en devise</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check3">
                                <label for="check3">Compte d’épargne</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check4">
                                <label for="check4">Compte professionnel</label>
                            </li>
                        </ul>
                    </ul>
                    <ul class="tarifs-interval">
                        <input type="text" maxlength="6" class="low-price" placeholder="Min" name="low-price">
                        <input type="text" maxlength="6" class="high-price" placeholder="Max" name="high-price">
                    </ul>
                </dd>
                </dd>
            </dl>
            <dl class="filters-subcategory">
                <dt>Opérations</dt>
                <dd class="criteres">
                    <ul>
                        <li>Doit avoir: </li>
                        <ul class="scrollable-checkboxes">
                            <li>
                                <input type="checkbox" id="check1" checked>
                                <label for="check1">Tous</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check2">
                                <label for="check2">Versement espèces tiers</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check3">
                                <label for="check3">Virement devise reçue de l’étranger</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check4">
                                <label for="check4">Émission Chèque de banque déplacée</label>
                            </li>
                        </ul>
                    </ul>
                    <ul class="tarifs-interval">
                        <input type="text" maxlength="6" class="low-price" placeholder="Min" name="low-price">
                        <input type="text" maxlength="6" class="high-price" placeholder="Max" name="high-price">
                    </ul>
                </dd>
            </dl>
            <dl class="filters-subcategory">
                <dt>Monétique</dt>
                <dd class="criteres">
                    <ul>
                        <li>Doit avoir: </li>
                        <ul class="scrollable-checkboxes">
                            <li>
                                <input type="checkbox" id="check1" checked>
                                <label for="check1">Tous</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check2">
                                <label for="check2">Commission de paiement sur TPE/Commerçant</label>
                            </li>
                            <li>
                                <input type="checkbox" id="check3">
                                <label for="check3">Changement de code PIN</label>
                            </li>
                        </ul>
                    </ul>
                    <ul class="tarifs-interval">
                        <input type="text" maxlength="6" class="low-price" placeholder="Min" name="low-price">
                        <input type="text" maxlength="6" class="high-price" placeholder="Max" name="high-price">
                    </ul>
                </dd>
            </dl>
        </div>
        <div>
            <div class="sort-section">
                <span>Trier Par:</span>
                <div class="custom-select">
                    <select autocomplete="off">
                    <?php
                        function generateOrderChoices()
                        {
                            $model = new PrestationModel();

                            $nom = array() ;
                            $nom = $model->getPrestationsNom();

                            echo '<option value="" selected>Defaut</option>';
                            for ($i=0; $i < count($nom); $i++) { 
                                echo '<option value="'.$nom[$i].'">'.$nom[$i].'</option>';
                            }
                        }
                            generateOrderChoices();
                        ?>
                    </select>
                    <span class="custom-arrow"></span>
                </div>
                <input class="sort-order-toggle" type="checkbox" id="sortOrder">
                <label class="sort-order-toggle-label" for="sortOrder">
                    <span></span>
                </label>
            </div>

            
            <!-- display banque-->
        </div>



    </main>
    <?php generateFooter(); ?>
</body>


</html>



<?php $this->end(); ?>