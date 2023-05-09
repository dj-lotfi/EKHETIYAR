<?php
class AccueilView extends view
{

    private function imageFinder($dirPath = '.' . DS . 'img' . DS . 'carousel_images') // Directory path to search for files
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

    private function imageGenerator($array)
    {
        if (sizeof($array) > 0) {
            for ($i = 0; $i < sizeof($array); $i++) {
                echo '<img src="' . $array[$i] . '" alt="Image ' . $i + 1 . '">';
            }
        }
    }

    public function generateCarousel()
    { ?>
        <div class="slider-container" style="max-width: 800px; height: 400px;">
            <div class="slider" style="width: 100%;">
                <?php
                $this->imageFinder();
                $this->imageGenerator($_SESSION['img']);
                ?>
            </div>
            <div class="slider-control" id="prev" tableinde>
            <svg viewBox="0 0 8 8"><path d="M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z"/></svg>
            </div>
            <div class="slider-control" id="next">
            <svg viewBox="0 0 8 8"><path d="M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z"/></svg>
            </div>
            <div class="slider-dots" id="dots"></div>
        </div>
    <?php }

    private function generateOrderChoices()
    {
        $p = new PrestationController('PrestationController', '');

        $nom = array();
        $nom = $p->getPrestationsNom();

        echo '<option value="alphabetical" selected>Defaut</option>';
        for ($i = 0; $i < count($nom); $i++) {
            echo '<option value="' . $nom[$i] . '">' . $nom[$i] . '</option>';
        }
    }

    public function generateSortField()
    { ?>
    <form id="SortFieldForm" onsubmit="return loadbanks()">
        <div class="sort-section">
            <span>Trier Par:</span>
                <div class="custom-select">
                    
                    <select autocomplete="off" id="Sort" name="Sort" onchange="return loadbanks()">
                        <?php
                        $this->generateOrderChoices();
                        ?>
                    </select>
                    <span class="custom-arrow"></span>
                    
                    
                </div>
                <input class="sort-order-toggle" type="checkbox" id="Sortasc_desc" name="Sortasc_desc" value='DESC' onchange="return loadbanks()">
                <label class="sort-order-toggle-label" for="Sortasc_desc">
                <span></span>
                </label>

            
        </div>
    </form>
    
    <?php }

    public function generateFilterField()
    {

        $p = new PrestationController('PrestationController', '');
        $res = array(array(),array());
        $res = $p->getPrestationsNomCategorie();
        $categorie = '';
        $i = 0;
        $j = -1;
        ?>
        <div class="filters">
            <div class="filtre-heading">
                <p>Filtrer</p>
                <input class="filter-button" id="filter" type="button" value="filtrer" onclick="loadbanks()">
                <label for="filter" class="filter">
                <svg viewBox="0 0 512 512">
                    <path
                    d="M487.976 0H24.028C2.71 0-8.047 25.866 7.058 40.971L192 225.941V432c0 7.831 3.821 15.17 10.237 19.662l80 55.98C298.02 518.69 320 507.493 320 487.98V225.941l184.947-184.97C520.021 25.896 509.338 0 487.976 0z">
                    </path>
                </svg>
                </label>
            </div>
            <?php
            while ($i < count($res[0])) {
                if ($res[1][$i] != $categorie) {   
                    $categorie = $res[1][$i];
                    $j++;
                    ?>
                    <dl class="filters-subcategory">
                        <dt><?php echo  $categorie ?></dt>
                        <dd class="criteres expanded">
                            <ul>
                                <li>Doit avoir: </li>
                                <ul class="scrollable-checkboxes">
                                    <li>
                                        <input type="checkbox" id="<?php echo $res[1][$i] ?>" name="<?php echo 'categorie' . '_' . $j ?>" value="<?php echo $res[1][$i] ?>"  checked >
                                        <label for="<?php echo $res[1][$i] ?>">Tous</label>
                                    </li>
                                    <?php
                                        while ($i < count($res[0]) && $res[1][$i] == $categorie) {
                                            ?>
                                            
                                            <li>
                                            <input type="checkbox" id="<?php echo $res[0][$i]; ?>" name="<?php echo 'filter' . '_' . $j . '_' . $i ?>" value="<?php echo $res[0][$i]; ?>">
                                            <label for="<?php echo $res[0][$i]; ?>" ><?php echo $res[0][$i] ?></label>
                                            <div class="tarifs-interval">
                                                <input type="text" maxlength="6" class="low-price" id="low-price<?php echo $i ;?>" placeholder="Min" name="<?php echo 'low-price' . '_' . $j . '_' .$i ;?>">
                                                <input type="text" maxlength="6" class="high-price" id="high-price<?php echo $i ;?>" placeholder="Max" name="<?php echo 'high-price'. '_' . $j . '_' .$i ;?>">
                                            </div>
                                            </li>
                                            <?php
                                            $i++;
                                        }

                                    ?>
                                </ul>
                            </ul>
                        </dd>
                    </dl>
                    <?php
                }
            }
            ?>
            </div>
        </form>
        <?php

    }

    public function displayAllBanque()
    {
        $this->controller->displayAllBanques();
    }

    public function render()
    {
        $this->setSiteTitle('Accueil');

        $this->start('head');
    ?>

        <meta charset="utf8mb4">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' type='text/css' href='css/accueil.css?v=<?php echo time(); ?>'>
        <link rel='stylesheet' type='text/css' href='css/prestation.css?v=<?php echo time(); ?>'>
        <script defer src='js/carousel.js?v=<?php echo time(); ?>'></script>
        <script defer src='js/banque.js?v=<?php echo time(); ?>'></script>
        <script defer src='js/custom.js?v=<?php echo time(); ?>'></script>


        <?php
        $this->end();

        $this->start('body'); ?>

        <body class="main-layout">
            <?php $this->generateHeader(); ?>
            <?php $this->generateCarousel(); ?>
            <main class="content-layout">

                <?php $this->generateFilterField(); ?>
                <div>
                    <?php $this->generateSortField(); ?>
                    <!-- 
                        display banks
                    -->
                    <div>
                        <div id="loader" class="loader">
                            <div class="justify-content-center jimu-primary-loading"></div>
                        </div>
                        <div id="banks">
                            
                            <?php $this->displayAllBanque(); ?>
                            
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->generateFooter(); ?>
        </body>
<?php $this->end();

        require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php

    }


} ?>