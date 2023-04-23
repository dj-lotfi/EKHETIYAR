<?php 

  class LoginView extends View 
  {
    public function render()
    {
      $this->setSiteTitle('Login');

      $this->start('head'); ?>

        <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
        <script defer src="js/login.js?v=<?php echo time(); ?>"></script>

      <?php $this->end();

      $this->start('body'); ?>

        <div class="center">
          <form class="frame" action="<?php $this->controller->authenticate() ?>" method="post">
            <h1 class="loginTitle">Log-in</h1>

            <input type="text" id="username" name="username" placeholder="Username">
            <div class="password-input">
              <input type="password" id="password" name="password" placeholder="Password">
              <span><img src="<?= PROOT ?>/img/eye-close.png" onmousedown="displayPassword()" onmouseup="hidePassword()"/></span>
            </div><!-- mettre le button sur input password -->
            
            <input type="submit" value="connect" id="button-log-in">
          </form>
        </div>

      <?php $this->end();

      require_once(ROOT . DS .'app'. DS . 'Views' . DS . 'layouts' . DS . $this->_layout .'.php');//affiche la page layouts/default.php
    }
  }
  
?>




