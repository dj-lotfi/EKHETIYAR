<?php

function generateFiltersSection() {

    $filters= '<div class="filters">
    <dl class="filters-subcategory">
      <dt>Gestion et tenue de comtpe</dt>
      <dd class="criteres">
        <ul>
          <li>Doit avoir: </li>
          <ul class="scrollable-checkboxes">
            <li>
              <input type="checkbox" id="check1" value="shouldBePrestationName/SpecialIDFoundInDATABASE" checked>
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
    ';

    return $filters;

}

function generateSortSection() {

    $sort= '<div class="sort-section">
    <span>Trier Par:</span>
    <div class="custom-select">
      <select autocomplete="off">
        <option selected value="0">Defaut</option>
        <option value="1">Tarif 1</option>
        <option value="2">Tarif 2</option>
      </select>
      <span class="custom-arrow"></span>
    </div>
    <input class="sort-order-toggle" type="checkbox" id="sortOrder">
    <label class="sort-order-toggle-label" for="sortOrder">
      <span></span>
    </label>
  </div>';

    return $sort;

}
function imageFinder($dirPath = 'M:/xampp/htdocs' . PROOT . '/'.'img')// Directory path to search for files

{
    // Open the directory
    $dirHandle = opendir($dirPath);

    // Check if directory was opened successfully
    if ($dirHandle) {
        $imgArray= array();
        // Loop through all files and directories in the directory
        while (($file = readdir($dirHandle)) !== false) {
            // Exclude special directories . and ..
            if ($file != '.' && $file != '..') {
                // Get the file's extension
                $extension = pathinfo($file, PATHINFO_EXTENSION);

                // Check if the entry is a file and has an extension
                if (is_file($dirPath . '/' . $file) && !empty($extension)) {
                    // Output the file name and extension
                    if ($extension == 'jpg' || $extension == 'png' || $extension == 'webp' || $extension == 'jpeg' ) {
                        array_push($imgArray,$dirPath . '/' . $file);
                    }
                }
            }
        }

        $_SESSION['img']=$imgArray;

        // Close the directory handle
        closedir($dirHandle);
    } else {
        echo "Failed to open directory.";
    }
}

function imageGenerator($array)
{
    if (sizeof($array)>0) {
        for ($i=0; $i < sizeof($array) ; $i++) { 
            echo '<img src="' . $array[$i] . '" alt="Image '. $i+1 .'">';
        }
        echo '<img src="' . $array[0] . '" alt="Image 1">';
    } 
}

function generateCarousel() {
  
  echo '<div class="slider-container" style="max-width: 800px; height: 400px;">
        <div class="slider" style="width: 100%;">';
            imageFinder();
            imageGenerator($_SESSION['img']);
  echo '</div>
        <div class="slider-control" id="prev">&#10094;</div>
        <div class="slider-control" id="next">&#10095;</div>
        <div class="slider-dots" id="dots"></div>
    </div>
    <script>
      window.onload = function() {
        // Create dots based on number of images
        const images =', json_encode($_SESSION['img']),
       'const maxIndex = images.length;
        for (let i = 0; i < images.length; i++) {
            const dot = document.createElement(\'div\');
            dot.className = \'slider-dot\';

            dot.addEventListener(\'click\', () => {
                clearInterval(slideShow);
                currentPosition = -i * sliderContainer.offsetWidth;
                slider.style.transform = `translateX(${currentPosition}px)`;
                activateDot(i);
                slideShow = setInterval(goToNextSlide, 3000);
            });
            dotsContainer.appendChild(dot);
        }
        activateDot(0); // Set the first dot as active
        
      }
    </script>';
}


?>