<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Editer mon profil</title>
  <link rel="icon" href="./assets/img/logoIcon.gif"/>
    <link rel="stylesheet" href="./assets/css/.css"/>
</head>

<body>

<!-- Barre de navigation -->


<!--Ancre-->
<div>
    <a class="bouton-footer" href=#footer><img src="./img/down.png" alt="aller en bas de la page"/></a>
    <a class="bouton-top" href="#"><img src="./img/top.png" alt="aller en haut de la page"/></a>
</div>



<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);
        if($mdp1 == $mdp2) {
            $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        } else {
            $msg = "Vos deux mots de passe ne correspondent pas !";
        }
    }
    ?>

    <div align="center">
        <h2>Editer mon profil</h2>
        <div>
            <form method="POST" action="" enctype="multipart/form-data">
                <label>Pseudo :</label>
                <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
                <label>Mail :</label>
                <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
                <label>Mot de passe :</label>
                <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
                <label>Confirmation - mot de passe :</label>
                <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
                <input type="submit" value="Mettre à jour mon profil" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
        </div>
    </div>

    <?php
}
else {
    header("Location: connexion.php");
}
?>

</body>
<footer>
    <a id="footer"></a>
</footer>
</html>
