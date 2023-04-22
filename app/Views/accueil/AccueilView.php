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
function generateCarousel()
{ ?>
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
<?php } ?>