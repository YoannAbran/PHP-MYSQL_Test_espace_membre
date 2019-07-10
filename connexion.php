
<?php 
session_start();?>

<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8" name="author" lang="fr" content="Yoann ABRAN">
        <title>Connexion</title>
    </head>
    
    <form action="connexion.php" method="post">
        <p>
            <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo"/> <br/>
            <label for="pass">Mot de passe</label> : <input type="password" name="pass" id="pass"/> <br/>
            
                <input type="submit" value="Envoyer" />
        </p>
    </form>
    
    
       <?php
/*connexion bdd*/
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=membres;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
 
 $pseudo= $_POST['pseudo'];
   
//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}