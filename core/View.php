<?php

class view {
    protected $_head;
    protected $_body;
    protected $_siteTitle = SITE_TITLE;
    protected $_outputBuffer;//pour indiquer si le output buffer contient le head ou le body 
    protected $_layout = DEFAULT_LAYOUT;

    public function render($viewName)
    {
        $viewArray = explode('/',$viewName);
        $viewString = implode(DS, $viewArray);
        if(file_exists(ROOT . DS . 'app'. DS . 'views' . DS . $viewString . '.php')){
            include(ROOT . DS . 'app'. DS . 'views' . DS . $viewString . '.php');//execute la page $viewString/index.php
            include(ROOT . DS .'app'. DS . 'views' . DS . 'layouts' . DS . $this->_layout .'.php');//affiche la page layouts/default.php
        }else{
            die('The view "' . $viewName . '" does not exist.');
        }
    }

    public function content($type)
    {
        if($type == 'head') {
            return $this->_head;
        }elseif ($type == 'body') {
            return $this->_body;
        }
        return false;
    }



    public function start($type)
    {
        $this->_outputBuffer = $type;//stocker quelle parti il traite head/body
        ob_start();//allume le buffer de sortie, il intercepte et stocke toutes les sorties (rien ne s'affiche par exemple lors de echo)
    }

    public function end()
    //vide le buffer de sortie dans _head/_body tout son contenu
    {
        if ($this->_outputBuffer == 'head') {
            $this->_head = ob_get_clean();//vide le output buffer dans head
        } elseif ($this->_outputBuffer == 'body'){
            $this->_body = ob_get_clean();//vide le output buffer dans body
        } else {
            die('You must first run the start method.');//buffer vide
        }
        
    }

    public function siteTitle()
    {
        return $this->_siteTitle;
    }
    public function setSiteTitle($title)
    {
        $this->_siteTitle=$title;
    }

    public function setLayout($path)
    {
        $this->_layout= $path;
    }
}
