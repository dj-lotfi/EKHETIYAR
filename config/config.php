<?php
define('DEBUG', true);

define('DB_NAME',/*'bdd_projet'*/ 'bank_db'); // nom de la bdd
define('DB_USER','root'); //nom d'utilisateur
define('DB_PASSWORD',''); //mot de passe de la bdd 
define('DB_HOST','127.0.0.1:3307'); //host de la bdd (IP pour éviter DNS lookup)



define('DEFAULT_CONTROLLER','Accueil'); 
//controller par défaut s'il n'y a pas de controlleur
//Page pare défaut Accuil
//*********************************** */
define('DEFAULT_ACTION', 'indexAction');

define('DEFAULT_LAYOUT','default');
//view par défaut s'il n'y a pas de View

define('PROOT', '/ProjectFileV5');//set this to '/' for a live server

define('SITE_TITLE', 'projet_cp2');//titre par défaut
