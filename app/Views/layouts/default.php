<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <title> <?=$this->siteTitle(); ?></title>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel='stylesheet' type='text/css' media='screen' href='<?=PROOT?>/css/custom.css'>
    <script src='<?=PROOT?>/js/custom.js'></script>

    <?= $this->content('head'); ?>

</head>
<body>
    <?= $this->content('body'); ?>

    
</body>
</html>