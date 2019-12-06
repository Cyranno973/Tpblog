<!DOCTYPE html>
<html lang='fr'>
<head>
<meta charset='UTF-8'>
 <meta name='viewport' content='width=device-width, initial-scale=1.0'>
 <meta http-equiv='X-UA-Compatible' content='ie=edge'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
  <link rel='stylesheet' href='style.css'>
<title></title>
</head>
<body>
    <?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=blogtp;charset=utf8', 'olivier', 'aaa', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }

        $reponse = $bdd->query('SELECT * FROM infochat');

        $other = 'other';
        while ($donnees = $reponse->fetch())
        {
     ?>
<h1>Mon super Blog</h1>

<h2>Dernier billets du blog :</h2>
<div class="titre"></div>!

<script src='main.js'></script>
</body>
</html>