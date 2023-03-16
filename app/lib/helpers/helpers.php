<?php //function for better and easier programming/debugging
function dnd($data)
// dump and die (for debugging)
//affiche le contenu d'une variable 
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}