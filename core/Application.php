<?php

class Application {
    public function __construct(){
        $this->_set_reporting();
        $this->_unregister_globals();
    }

    private function _set_reporting(){
    //Gestion des errors (enregistrements dans un fichier)
        if(DEBUG){
            error_reporting(E_ALL);
            ini_set('display_errors', 1);//This determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.
        } else {
            error_reporting(0);
            ini_set('display_errors', 0);//This setting will not allow showing errors while running PHP project in the specified host.
            ini_set('log_errors', 1);//Name of the file where script errors should be logged. 
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors.log');//Name of the file where script errors should be logged. 
        }
    }

    private function _unregister_globals(){
    //Fonction pour securité
    //Efface le registre des variables globales 
        if(ini_get('register_globals')) {
            $globalArray = ['_SESSION', '_COOKIE', '_POST', '_GET', '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            foreach ($globalArray as $value) {
                if(isset($GLOBALS[$value]))
                {
                    foreach ($GLOBALS[$value] as $key => $var) {
                        unset($GLOBALS[$value][$key]);
                    }
                }
            }
        }
    }
}