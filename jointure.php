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

   

$reponse = $bdd->prepare('SELECT titre,contenu, auteur,commentaire, date_creation, date_commentaire FROM billets b, commentaires c WHERE c.id_billet = b.id AND b.id =?');
    
      $reponse->execute(array($_GET['billets']));

      $donnees = $reponse->fetch();

?>


<div class="container">
        <h1>Mon super Blog</h1>
        <a href="index.php">Retour à la liste des billets</a></br></br>
        <div class="titre"><?php echo htmlspecialchars($donnees['titre']); ?> <span
                class='italic'><?php echo '  Le '.$donnees['date_creation'];?></span> </div>
        <div class="contenu"><?php echo htmlspecialchars($donnees['contenu']); ?></div>
   
    </div>
    <h4>Commentaires</h4>

    <div><?php echo $donnees['auteur'] ;?>  <?php echo $donnees['date_commentaire']; ?></div></br>
            <div><?php echo nl2br(htmlspecialchars($donnees['commentaire']));?></div></br>
 <?php   
    while ($donnees = $reponse->fetch())
    {
        ?>
        
         <div><?php echo $donnees['auteur'] ;?>  <?php echo $donnees['date_commentaire']; ?></div></br>
            <div><?php echo nl2br(htmlspecialchars($donnees['commentaire']));?></div></br>

<?php

}
?>





<script src='main.js'></script>
</body>
</html>
 




<!-- SELECT CLI_NOM, TEL_NUMERO
FROM T_CLIENT C, T_TELEPHONE T
WHERE C.CLI_ID = T.CLI_ID
  AND TYP_CODE = 'FAX'

  Ici, la table T_CLIENT a été surnommée "C" et la table T_TELEPHONE "T". -->