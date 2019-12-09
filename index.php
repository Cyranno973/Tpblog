<?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=blogtp;charset=utf8', 'olivier', 'aaa', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }

        // $reponse = $bdd->query('SELECT * FROM billets, DATE ORDER BY id DESC LIMIT 0, 5' );
        $reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d%m%Y à %Hh%imin%ss\') AS date_creation FROM billets ORDER BY date_creation DESC LIMIT 0, 5' );
        
?>


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

        <h1>Mon super Blog</h1>

        <h2>Dernier billets du blog :</h2>
        <?php
        while ($donnees = $reponse->fetch())
        {
     ?>


<div class="titre"><?php echo htmlspecialchars($donnees['titre']); ?> <span class ='italic'><?php echo '  Le '.$donnees['date_creation'];?></span>  </div>
<div class="contenu"><?php echo htmlspecialchars($donnees['contenu']); ?></div>

<a href="commentaires.php?billets=<?php echo $donnees['id']; ?>">Commentaires</a>

<?php
};
$reponse->closeCursor();
?>

<script src='main.js'></script>
</body>
</html>

