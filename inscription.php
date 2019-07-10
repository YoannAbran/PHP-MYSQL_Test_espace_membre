<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8" name="author" lang="fr" content="Yoann ABRAN">
        <title>Inscription</title>
    </head>
    
    <form action="inscription.php" method="post">
        <p>
            <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo"/> <br/>
            <label for="pass">Mot de passe</label> : <input type="password" name="pass" id="pass"/> <br/>
            <label for="verifpass">Retaper mot de passe</label> : <input type="password" name="verifpass" id="verifpass"/> <br/>
            <label for="mail">Adresse mail</label> : <input type="email" name="mail" id="mail"/> <br/>
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
    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $pseudo= $_POST['pseudo'];
    $email= $_POST['mail'];
   
    
    $req = $bdd->prepare('INSERT INTO membres (pseudo, pass, mail, date_inscription) VALUES(:pseudo, :pass, :mail, CURDATE())');
$req->execute(array(
    'pseudo' => $pseudo,
    'pass' => $pass_hache,
    'mail' => $email));