<?php

class view {
    protected $_head;
    protected $_body;
    protected $_siteTitle = SITE_TITLE;
    protected $_outputBuffer;//pour indiquer si le output buffer contient le head ou le body 
    protected $_layout = DEFAULT_LAYOUT;

    protected $controller;

    public function __construct($controller) {

        $this->controller = $controller;
    }
    /*
    public function render($viewName)
    {
        $viewArray = explode('/',$viewName);
        $viewString = implode(DS, $viewArray);
        if(file_exists(ROOT . DS . 'app'. DS . 'Views' . DS . $viewString . DS . 'index.php')){
            require_once(ROOT . DS . 'app'. DS . 'Views' . DS . $viewString . DS .  'index.php');//execute la page $viewString/index.php
            require_once(ROOT . DS .'app'. DS . 'Views' . DS . 'layouts' . DS . $this->_layout .'.php');//affiche la page layouts/default.php
        }else{
            die('The view "' . $viewName . '" does not exist.');
        }
    }
    */

    public function render(){}

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

    function generateHeader()
    { ?>
        <header>
            <a href="<?php echo PROOT . DS ;?>"><img aria-hidden="true" class="logo" src="<?= PROOT ?>/img/Site_Logo.svg" alt="Logo du site"></a>
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <nav class="navbar">
                <ul>
                    <button><span></span><a href="<?= PROOT ?>/accueil">Accueil</a><span></span></button>
                    <button><span></span><a href="<?= PROOT ?>/comparatif">Comparatif</a><span></span></button>
                    <button><span></span><a href="<?= PROOT ?>/qui_sommes_nous">Qui Sommes-Nous</a><span></span></button>
                </ul>
            </nav>
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span>
            </label>
        </header>
    <?php 
    }

    function generateFooter()
    { ?>
        <footer class="site-footer">
            <div class="footer--container">
                <div class="footer--logo">
                    <a href="<?php echo PROOT . DS ;?>" aria-label="Ikhteyar">
                        <img class="svg-icon" src="<?= PROOT ?>/img/Site_Logo.svg" alt="Logo du site" width="62"> </a>
                </div>
                <nav class="footer--nav">
                    <div class="footer--col">
                        <div class="col-title"><a href="<?php echo PROOT . DS ;?>">Ikhteyar</a></div>
                        <ul class="col-list">
                            <li><a href="<?= PROOT ?>/accueil">Accueil</a></li>
                            <li><a href="<?= PROOT ?>/comparatif">Comparatif</a></li>
                            <li><a href="<?= PROOT ?>/qui_sommes_nous">Qui Sommes-Nous</a></li>
                        </ul>
                    </div>
                </nav>
            </div>

        </footer>
    <?php }
    

}
