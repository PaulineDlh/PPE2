<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <?php include 'assets/php/allcss.php'; ?>
  </head>
  <body>
    <?php
    //navbar
    include 'assets/php/nav.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'assets/php/PHPMailer/src/Exception.php';
    require 'assets/php/PHPMailer/src/PHPMailer.php';
    require 'assets/php/PHPMailer/src/SMTP.php';
    //Server settings
    $mailValidation = new PHPMailer(true);
    $mailValidation->SMTPDebug = 0;                                 // Enable verbose debug output
    $mailValidation->isSMTP();                                      // Set mailer to use SMTP
    $mailValidation->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mailValidation->SMTPAuth = true;                               // Enable SMTP authentication
    $mailValidation->Username = 'cornichon66820@gmail.com';                 // SMTP username
    $mailValidation->Password = 'concombre';                           // SMTP password
    $mailValidation->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mailValidation->Port = 465;// or 587                           // TCP port to connect to
    function random_str($nbr) {
      $str = "";
      $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ0123456789";
      $nb_chars = strlen($chaine);

      for($i=0; $i<$nbr; $i++){
        $str .= $chaine[ rand(0, ($nb_chars-1)) ];
      }

      return $str;
    }
    //Traitement inscription
    if(isset($_POST['forminscription'])) {
      $pseudo = htmlspecialchars($_POST['pseudo']); /* Fonction qui permet d'enlever tous les caractères html */
      $mail = htmlspecialchars($_POST['mail']);
      $mail2 = htmlspecialchars($_POST['mail2']);
      $mdp = sha1($_POST['mdp']); /* fonction qui permet la sécurisation du mdp */
      $mdp2 = sha1($_POST['mdp2']);
      $nom = htmlspecialchars($_POST['nom']);
      $prenom = htmlspecialchars($_POST['prenom']);
      $civilite = htmlspecialchars($_POST['civilite']);
      $telephone = htmlspecialchars($_POST['telephone']);
      $avatarurl = 'defaultavatarurl.png';

      if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
        $pseudolength = strlen($pseudo); /* Trouve le nombre de caractères */
        if($pseudolength <= 20) {
          $reqpseudo = $bdd->prepare("SELECT * FROM client WHERE Pseudo = ?");
          $reqpseudo->execute(array($pseudo));
          $pseudoexist = $reqpseudo->rowCount(); /* Fonction qui compte le nombre de colonnes existantes pour ce que l'on à rentrer */
          if($pseudoexist == 0) {
            if($mail == $mail2) {
              if(filter_var($mail, FILTER_VALIDATE_EMAIL)) { /* Fonction qui permet de voir si c'est bien un email */
                $reqmail = $bdd->prepare("SELECT * FROM client WHERE Email = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if($mailexist == 0) {
                  if($mdp == $mdp2) {
                    $token = random_str(40);
                    $insertmbr = $bdd->prepare("INSERT INTO client(Pseudo, Email, MotDePasse, Nom, Prenom, Civilite, Telephone, AvatarUrl, Token) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insertmbr->execute(array($pseudo, $mail, $mdp, $nom, $prenom, $civilite, $telephone, $avatarurl, $token));
                    $erreur = "<br />Votre compte a bien été créé !<br /><a href=\"/accueil.php\"><br />Revenir sur la page d'accueil<br /></a><a href=\"/connexion.php\"><br />Se connecter!</a>";
                    $mailValidation->setFrom('cornichon66820@gmail.com');
                    $mailValidation->addAddress($mail);
                    //Content
                    $mailValidation->isHTML(true);
                    $mailValidation->Subject = 'Bienvuenue a Ô\'Tako';
                    $mailValidation->Body    = '
                    <html>
                      <body>
                        <h1>Nous vous remercions de vous être inscrit sur notre site ^_^</h1>
                        <br/>
                        <h3>Pour confirmez l\'inscription veuillez entrer le token sur le site</h3>
                        <h3>'.$token.'</h3>
                      </body>
                    </html>
                    ';
                    $mailValidation->AltBody = 'utiliser une boit de messageri qui supporte les mail html';
                    $mailValidation->send();
                  } else {
                    $erreur = "Vos mots de passe ne correspondent pas !";
                  }
                } else {
                  $erreur = "L'adresse mail est déjà utilisée !";
                  //
                }
              } else {
                $erreur = "Votre adresse mail n'est pas valide !";
              }
            } else {
              $erreur = "Vos adresses mail ne correspondent pas !";
            }
          } else {
            $erreur = "Le pseudo \"".$pseudo."\" est déjà utilisé !";
          }
        } else {
          $erreur = "Votre pseudo ne doit pas dépasser 20 caratères !";
        }
      } else {
        $erreur = "Tous les champs doivent être complétés !";
      }
    }
    ?>
    <!-- formulaire d'inscription -->
    <div align="center">
      <div class="container">
        <div class="card card-container" style="max-width: 350px; padding: 40px 40px;">
          <h1>Inscription</h1>
          <br /><br />
          <form method="POST">
            <!-- pseudo -->
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" /> <!--Permet de laisser affiché après validation si erreur-->
              </div>
              <!-- mail -->
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
              </div>
              <!-- confirmation mail -->
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
              </div>
              <!-- mdp -->
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Votre mot de passe" id="mdp" name="mdp" />
              </div>
              <!-- confirmation mdp -->
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2" />
              </div>
              <!-- Nom -->
              <div class="form-group">
                <input type="nom" class="form-control" placeholder="Votre nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
              </div>
              <!-- Prénom -->
              <div class="form-group">
                <input type="prenom" class="form-control" placeholder="Votre prénom" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" />
              </div>
              <!-- Téléphone -->
              <div class="form-group">
                <input type="telephone" class="form-control" placeholder="Votre n° de téléphone" id="telephone" name="telephone" value="<?php if(isset($telephone)) { echo $telephone; } ?>" />
              </div>
              <!--Civilité-->
              <div class="form-group">
                  <label>Civilité : </label><br />
                  <input type="radio" name="civilite" value="homme" checked>Monsieur<br>
                  <input type="radio" name="civilite" value="femme">Madame<br>
              </div>
              <input type="submit" class="btn btn-primary" name="forminscription" value="Je m'inscris" />
            </form>
          <?php
            if(isset($erreur)) {
              echo '<font color="red">'.$erreur."</font>";
            }
          ?>
      </div>
    </div>
  </div>
    <?php include 'assets/php/footer.php'; ?>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/BSanimation.js"></script>
  </body>
</html>
