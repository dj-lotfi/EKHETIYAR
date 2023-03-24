<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Accueil</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h3>Nom </h3>
    <p> <?php echo $_SESSION['res']->nom ?></p>
    <h3>Adresse Siege Sociale</h3>
    <p> <?php echo $_SESSION['res']->adresse_siege_social ?>    </p>
    <h3>Telephone</h3>
    <p> <?php echo $_SESSION['res']->telephone ?></p>
    <h3>Fax </h3>
    <p><?php echo $_SESSION['res']->fax ?></p>

    
</body>
</html>