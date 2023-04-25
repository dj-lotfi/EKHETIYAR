<?php
class adminView extends View
{
  public function render()
  {
    $this->setSiteTitle('Admin');

    $this->start('head'); ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <script defer src="js/login.js"></script>


    <?php $this->end(); ?>

    <?php $this->start('body');
    if ($_SESSION['loggedin'] == false) {
      Router::redirect(Login);
      exit;
    }
    $_SESSION["loggedin"] = false;
    ?>

    <h>admin</h>

<?php $this->end();

    require_once(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . $this->_layout . '.php'); //affiche la page layouts/default.php


  }
}

?>