<?php

//Permet de garder les variables de la session
session_start();

//Connexion à notre base de donnée
$bdd = new PDO('mysql:host=ls-0f927a463e6d389cf0f567dc4d5a58f8ca59fcd7.cq7na6hxonpd.eu-central-1.rds.amazonaws.com;dbname=ShareBook', 'sharebookuser', 'uA?BL6P8;t=P-JKl)]Su>L3Gj$[mz0q]');
//Restrindre l'accés à cette page au personne non connecté

 if(!isset($_SESSION['id'])) {

         header('Location: errorConnexion.html');
         exit;
      
   }


//Restrindre l'accés à cette page au personne qui ne sont pas Admin

 if (strcasecmp($_SESSION['Roles'], 'admin') ==! 0){

         header('Location: errorAdmin.html');
         exit;
      
   }
      
if(isset($_GET['id'])) {
   $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE ID_Utilisateur = ?");
   $requser->execute(array($_GET['id']));
   $user = $requser->fetch();
   //Permet de changer le pseudo
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE utilisateur SET Pseudo = ? WHERE ID_Utilisateur = ?");
      $insertpseudo->execute(array($newpseudo, $_GET['id']));
      header('Location: editionprofiladmin.php?id='.$_GET['id']);
   }
   //Permet de changer le mail
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE utilisateur SET Email = ? WHERE ID_Utilisateur = ?");
      $insertmail->execute(array($newmail, $_GET['id']));
      header('Location: editionprofiladmin.php?id='.$_GET['id']);
   }
   //Permet de changer le droit
    if(isset($_POST['droit']) AND !empty($_POST['droit']) AND $_POST['droit'] != $user['droit']) {
      $newdroit = htmlspecialchars($_POST['droit']);
      $insertdroit = $bdd->prepare("UPDATE utilisateur SET Roles = ? WHERE ID_Utilisateur = ?");
      $insertdroit->execute(array($newdroit, $_GET['id']));
      header('Location: editionprofiladmin.php?id='.$_GET['id']);
   }
   //Permet de changer le mot de passe
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE utilisateur SET Mdp = ? WHERE ID_Utilisateur = ?");
         $insertmdp->execute(array($mdp1, $_GET['id']));
         header('Location: editionprofiladmin.php?id='.$_GET['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Édition du profil des utilisateurs</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/contact.css">
        <link rel="stylesheet" href="assets/css/footer.css">
        <link rel="stylesheet" href="assets/css/navigation.css">
        <link rel="stylesheet" href="assets/css/profil.css">

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


                //Rajout de la barre d'administration si la personne un administrateur

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



    <div align="center">

        <div class="contact">



            <form method="POST" action="" enctype="multipart/form-data" style="border-radius: 50px">
                <h2>Edition de mon profil</h2>

                <div class="form-group"><input class="form-control" type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['Pseudo']; ?>" /></div>
                <div class="form-group"><input class="form-control" type="text" name="newmail" placeholder="Mail" value="<?php echo $user['Email']; ?>" /></div>
                <div class="form-group"><input class="form-control" type="password" name="newmdp1" placeholder="Mot de passe"/></div>
                <div class="form-group"><input class="form-control" type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /></div>

               <?php
                      //Permet de récuperer de d'afficher le droit de la personne
                     $droit = $_GET['id'];
                     $reqid = $bdd->prepare("SELECT Roles FROM utilisateur WHERE ID_Utilisateur = ?");
                     $reqid->execute(array($droit));
                     $droit = $reqid->fetch();
             
                    
           
                 echo '<strong>Droit actuel de la personne : </strong>'.$droit[0]."</font>";

               ?>
               </br>
               </br>
               <select name="droit">

                   <option value="">Sélectionner le nouveau droit de la personne</option>
                   <option value="admin">Admin</option>
                   <option value="aucun">Aucun</option>

               </select>
                </br>

                <div class="form-group"><input class="btn btn-primary btn-block" type="submit" value="Mettre à jour le profil !"/></input></div>


            </form>
            </br>
            <?php if(isset($msg)) { echo $msg; } ?>
            <div ><button class="btn btn-primary btn" type="submit" value="Retour à page d'administration!"/><a href="modif_utlisateurs_admin.php" style="color: white">Retour à page d'administration</a></button></div>


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

<?php   
}
else {
   header("Location: admin.php");
}
?>