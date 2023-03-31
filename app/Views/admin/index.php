<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action=<?=$_SESSION['filedir']?> >
  <label for="id">ID:</label>
  <input type="text" name="fields[id]" id="id">

  <label for="nom">Nom:</label>
  <input type="text" name="fields[nom]" id="nom">

  <label for="logo">Logo:</label>
  <input type="text" name="fields[logo]" id="logo">

  <label for="adresse">Adresse:</label>
  <input type="text" name="fields[adresse]" id="adresse">

  <label for="telephone">Téléphone:</label>
  <input type="text" name="fields[telephone]" id="telephone">

  <label for="fax">Fax:</label>
  <input type="text" name="fields[fax]" id="fax">

  <label for="site">Site:</label>
  <input type="text" name="fields[site]" id="site">

  <input type="submit" value="Submit">
</form>
    
</body>
</html>