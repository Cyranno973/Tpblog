<?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=blogtp;charset=utf8', 'olivier', 'aaa', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
        
        $pseudo = $_POST['pseudo'];
       
        $message = $_POST['message'];
        $id_billet = $_POST['billet_id'];

$reponse = $bdd ->prepare('INSERT INTO commentaires (auteur,commentaire,id_billet) VALUES(:auteur, :commentaire, :id_billet )');

$reponse->execute(array(
'auteur' => $pseudo,
'commentaire' => $message,
'id_billet' => $id_billet
));

     
header("Location: http://localhost/tp%20blog/commentaires.php?billets=$id_billet");       


?>