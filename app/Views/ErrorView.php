<?php

class ErrorView extends View
{
  public function render()
  {
    $this->setSiteTitle('404 Not Found');
    $this->start('head'); ?>

    <link rel='stylesheet' type='text/css' href='css/error.css?v=<?php echo time(); ?>'>

    <?php $this->end();
    $this->start('body'); ?>

    <div class="container">
      <div class="error-code">4<span>0</span>4</div>
      <div class="error-message title">Oops! Page not found</div>
      <p class="error-message">Please check the URL and try again.</p>
      <a class="home-link" href="<?php echo PROOT . DS; ?>">Home page</a>
    </div>

    <?php $this->end();

    require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php

  }
}