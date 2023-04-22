<?php $this->setSiteTitle('404 Not Found'); ?>
<?php $this->start('head'); ?>

<link rel='stylesheet' type='text/css' href='css/error.css?v=<?php echo time(); ?>'>

<?php $this->end(); ?>


<?php $this->start('body'); ?>

<div class="container">
  <div class="error-code">4<span>0</span>4</div>
  <div class="error-message title">Oops! Page not found</div>
  <p class="error-message">Please check the URL and try again.</p>
  <a class="home-link" href="<?php echo PROOT . DS; ?>">Home page</a>
</div>

<?php $this->end(); ?>