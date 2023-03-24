<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>This is a propos description</title>
        <!-- Latest compiled and minified CSS -->
    </head>
    <body>
      <?php //var_dump($res); ?>

        <h1> Description </h1>
        <p> 
        <?php echo $_SESSION['result']->description ?> 
        </p>
        <h1> Telephone </h1>
        <p>
        <?php echo $_SESSION['result']->telephone ; ?>
        </p>
        <h1>Email</h1>
        <p>
        <?php echo $_SESSION['result']->email?>
        </p>
           
    </body>
</html>
