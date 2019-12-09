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

   
        $reponse = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d%m%Y à %Hh%imin%ss\') AS date_creation FROM billets WHERE id = ?' );
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
    <?php
  $reponse->closeCursor(); 

    $reponse = $bdd->prepare('SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d%m%Y à %Hh%imin%ss\') AS
    date_commentaire FROM commentaires WHERE id_billet = ?' );
    $reponse->execute(array($_GET['billets']));

    while($donnees = $reponse->fetch())
    {
    ?>

    <div><?php echo $donnees['auteur'] ;?> <?php echo $donnees['date_commentaire']; ?></div></br>
    <div><?php echo nl2br(htmlspecialchars($donnees['commentaire']));?></div></br>

    <?php };
    $reponse->closeCursor(); ?>
    <form method="POST" action="ajout.php">
    <table >
    <tr>
             <td> <label for="pseudo">Pseudo</label></td>
        <td >
            <input id="pseudo" name="pseudo" type="text" placeholder ="Entrez votre Pseudo">
        </td>
    </tr>
    <tr>
    <td> <label for="message">Message</label></td>
        <td>
        <input id="message" name="message" type="text" placeholder ="Entrez votre Message"> 
        <input id = "billet_id" name="billet_id"  type="hidden" value="<?php echo $_GET['billets']; ?>">
        </td>
    </tr>
     <tr>
         <td></td>
         <td><input type="submit" value="Envoyer"></td>
     </tr>
    
      
    </table>
    </form>
    <script src='main.js'></script>
</body>

</html>