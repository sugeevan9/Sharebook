<?php
//Permet de garder les variables de la session
session_start();

//Connexion à notre base de donnée
$bdd = new PDO('mysql:host=ls-0f927a463e6d389cf0f567dc4d5a58f8ca59fcd7.cq7na6hxonpd.eu-central-1.rds.amazonaws.com;dbname=ShareBook', 'sharebookuser', 'uA?BL6P8;t=P-JKl)]Su>L3Gj$[mz0q]');

$membres = $bdd->query('SELECT * FROM utilisateur ORDER BY ID_Utilisateur DESC LIMIT 0,5');

$lien = 'Location: create_utilisateurs.php';

//Restrindre l'accés à cette page au personne non connecté
if(!isset($_SESSION['id'])) {

         header('Location: errorConnexion.html');
         exit;
}

//Restrindre l'accés à cette page au personne qui ne sont pas admin

if (strcasecmp($_SESSION['Roles'], 'admin') ==! 0 AND strcasecmp($_SESSION['Roles'], 'gestionnaire') ==! 0){

         header('Location: errorAdmin.html');
         exit;    
}
    	
    //Permet de récuperer les informations de créeation de la nouvelle personne et rajouter cette personne dans la base de donnée
    if(isset($_POST['forminscription'])) {
       $pseudo = htmlspecialchars($_POST['pseudo']);
       $nom = htmlspecialchars($_POST['nom']);
       $prenom = htmlspecialchars($_POST['prenom']);
       $tel = htmlspecialchars($_POST['tel']);
       $mail = htmlspecialchars($_POST['mail']);
       $mail2 = htmlspecialchars($_POST['mail2']);
       $mdp = sha1($_POST['mdp']);
       $mdp2 = sha1($_POST['mdp2']);
       $droit = htmlspecialchars($_POST['droit']);
       $date_de_creation = date("Y-m-d H:i:s");
       $date_de_naissance = htmlspecialchars($_POST['datenaissance']);
/*
        echo $pseudo;
        echo '<td>'."\r\n";
        echo $nom;
        echo '<td>'."\r\n";
        echo $prenom;
        echo '<td>'."\r\n";
        echo $tel;
        echo '<td>'."\r\n";
        echo $mail;
        echo '<td>'."\r\n";
        echo $mail2;
        echo '<td>'."\r\n"; 
        echo $mdp;
        echo '<td>'."\r\n";
        echo $mdp2; 
        echo '<td>'."\r\n";
        echo $droit; 
        echo '<td>'."\r\n";
        echo $date_de_creation;
        echo '<td>'."\r\n";
        echo $date_de_naissance;*/

       if(!empty($_POST['droit'])){

         if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['tel']) AND !empty($_POST['date'])) {
            $pseudolength = strlen($pseudo);
            if($pseudolength <= 255) {
               if($mail == $mail2) {
                  if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                     $reqpseudo = $bdd->prepare("SELECT * FROM utilisateur WHERE Pseudo = ?");
                     $reqpseudo->execute(array($pseudo));
                     $pseudoexist = $reqpseudo->rowCount();
                     if($pseudoexist == 0) {
                        if($mdp == $mdp2) {
                           $insertmbr = $bdd->prepare("INSERT INTO utilisateur(Pseudo, Nom, Prenom, Email, Tel, Date_Naissance, Date_de_creation, Mdp, Roles) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                           $insertmbr->execute(array($pseudo, $nom, $prenom, $mail, $tel, $date_de_naissance, $date_de_creation, $mdp, $droit));
                           $erreur_create = "Le compte a bien été créé !";
                            echo "\nPDOStatement::errorInfo():\n";
                            $arr = $insertmbr->errorInfo();
                            print_r($arr);
                        //   sleep(2);
                          // header($lien);
                 
                        } else {
                           $erreur_create = "Vos mots de passes ne correspondent pas !";
                        }
                     } else {
                        $erreur_create = "Pseudo déjà utilisée !";
                     }
                  } else {
                     $erreur_create = "Votre adresse mail n'est pas valide !";
                  }
               } else {
                  $erreur_create = "Vos adresses mail ne correspondent pas !";
               }
            } else {
               $erreur_create = "Votre pseudo ne doit pas dépasser 255 caractères !";
            }
         } else {
            $erreur_create = "Tous les champs doivent être complétés !";
         }
      } else {
         $erreur_create = "Rentrer un droit !";
      }
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Créer un utilisateur</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/profil.css">
    <link rel="stylesheet" href="assets/css/animate.css">


</head>
<body>
<nav class="navbar navbar-light navbar-expand-md shadow-lg navigation-clean-button" style="background-color: #313437;">
    <div class="container"><a class="navbar-brand" href="index.php" style="color: #ffffff;">ShareBook</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                        Mon profil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profil.php">Afficher mon profil</a>
                        <a class="dropdown-item" href="editionprofil.php">Editer mon profil</a>
                        <a class="dropdown-item" href="supp_account.php">Supprimer mon compte</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                        Documents
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="document.php">Afficher les documents publiques</a>
                        <a class="dropdown-item" href="mydocument.php">Afficher mes documents</a>
                        <a class="dropdown-item" href="upload.php">Upload un document</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                        Statistiques
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="stat_extension.php">Par extension</a>
                        <a class="dropdown-item" href="stat_public.php">Publiques / Privés</a>
                    </div>
                </li>


                <?php
                     if (strcasecmp($_SESSION['Roles'], 'admin') == 0 OR strcasecmp($_SESSION['Roles'], 'gestionnaire') == 0) {
                     
                     
                        echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                            Administration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="utilisateurs_admin.php">Afficher tous les utilisateurs</a>
                            <a class="dropdown-item" href="modif_utlisateurs_admin.php">Modifier / Supprimer un utilisateur</a>
                            <a class="dropdown-item" href="create_utilisateurs.php">Créer un utilisateur</a>
                            <a class="dropdown-item" href="stat_admin.php">Statistiques des utilisateurs</a>
                        </div>
                     </li>';

                     }

                     if (strcasecmp($_SESSION['Roles'], 'admin') == 0 OR strcasecmp($_SESSION['Roles'], 'validateur') == 0) {

                        echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                            Validation
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="affich_docs.php">Afficher les ouvrages des utilisateurs</a>
                            <a class="dropdown-item" href="docs_non_valide.php">Documents non validés</a>
                            <a class="dropdown-item" href="docs_refuse.php">Documents refusés</a>
                        </div>
                     </li>';
                     
                     }
                ?>


            </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Déconnexion</a></span>

        </div>
    </div>
</nav>

            <div class="contact">
                <div class="container">
                <div align="center" class="animated bounceInDown delay-100ms">
                    <h1 style="margin-top: 10px">Création d'un compte client</h1>
                    <i class="fa fa-user fa-5x"></i></br>

    <form method="POST" style="border-radius: 20px 50px 20px 50px;">

        <div class="form-group"><input class="form-control" type="text" placeholder="Pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" /></div>
        
        <div class="form-group"><input class="form-control" type="text" placeholder="Nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" /></div>
        
        <div class="form-group"><input class="form-control" type="text" placeholder="Prenom" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" /></div>
        
        <div class="form-group"><input class="form-control"  type="email" placeholder="Mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" /></div>
        
        <div class="form-group"> <input class="form-control" type="email" placeholder="Confirmez le Mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" /></div>
        
        <div class="form-group"> <input class="form-control" type="tel" placeholder="Téléphone" id="tel" name="tel" value="<?php if(isset($tel)) { echo $tel; } ?>" /></div>

        <div class="form-group"> <input class="form-control" type="date" placeholder="Date de Naissance" id="datenaissance" name="datenaissance" value="<?php if(isset($datenaissance)) { echo $datenaissance; } ?>" /></div>

        <div class="form-group"><input class="form-control" type="password" placeholder="Votre Mot de Passe" id="mdp" name="mdp" /></div>
        
        <div class="form-group"><input class="form-control" type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2" /></div>


      <select name="droit">

          <option value="">Sélectionner le droit de la personne</option>
          <option value="admin">Administrateur</option>
          <option value="gestionnaire">Gestionnaire</option>
          <option value="validateur">Validateur</option>
          <option value="aucun">Aucun</option>

        </select>



        <div class="form-group">

            <button class="btn btn-primary btn" type="submit" name="forminscription">Créer la personne</button>

        </div>


           <?php
              if(isset($erreur_create)) {
              echo '<font color="red">'.$erreur_create."</font>";
              }
            ?>

    </form>

  </div>
</div>
    </div>



<div class="footer">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 item text">
                    <h3>ShareBook</h3>
                    <p>Start-up innovante, ShareBook a pour ambition de rendre la connaissance accessible et universel</p>
                </div>

            </div>
            <p class="copyright">ShareBook © 2021</p>
        </div>
    </footer>
</div>

</body>
</html>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-animation.js"></script>
<script src="assets/js/bs-charts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="assets/js/jquery-3.3.1.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>