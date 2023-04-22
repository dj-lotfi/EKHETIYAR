<?php $this->setSiteTitle('Login'); ?>

<?php $this->start('head'); ?>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login.css">
  <script defer src="js/login.js"></script>    

<?php $this->end(); ?>

<?php $this->start('body'); ?>
  <div class="center">
    <form class="frame" action="<?php $this->controller->authenticate() ?>"  method="post">
      <h1 class="loginTitle">Login</h1>
      
      <input type="text" id="username" name="username" placeholder="Username"><br><br>
      <input type="password" id="password" name="password" placeholder="Password"><br><br>
      <input type="button" onmousedown="displayPassword()" onmouseup="hidePassword()"> <!-- mettre le button sur input password -->
      <input type="submit" value="connect">
    </form>
    
  </div>

<?php $this->end(); ?>