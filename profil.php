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

//Permet d'obtenir les informations de l'utilisateur actuel
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
   $getid = intval($_SESSION['id']);
   $requser = $bdd->prepare('SELECT * FROM utilisateur WHERE ID_Utilisateur = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
}
?>

<html>
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
       <title>SmartDoc - Profil</title>
       <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
       <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
       <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
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
                           <a class="dropdown-item" href="document.php">Afficher la Bibliothèque Publique</a>
                           <a class="dropdown-item" href="mydocument.php">Afficher ma Bibliothèque Privée</a>
                           <a class="dropdown-item" href="upload.php">Ajouter un ouvrage</a>
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
   <div class="profile">
      <div align="center" class="animated bounceInDown delay-100ms">
         <h2 style="margin:50px;">Profil de <?php echo $userinfo['Pseudo']; ?></h2>

          <i class="fa fa-user fa-5x"></i>
          <br /><br />
         Pseudo : <?php echo $userinfo['Pseudo']; ?>
         <br />
         Nom : <?php echo $userinfo['Nom']; ?>
         <br />
         Prenom : <?php echo $userinfo['Prenom']; ?>
         <br />
         Mail : <?php echo $userinfo['Email']; ?>
         <br />
         Numéro de Téléphone : <?php echo $userinfo['Tel']; ?>
         <br />
         Droit : <?php echo $userinfo['Roles']; ?>
         <br />
         <br />         
         <?php
         if(isset($_SESSION['id']) AND $userinfo['ID_Utilisateur'] == $_SESSION['id']) {
         ?>
         <br />
             <span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="editionprofil.php">Editer mon profil</a></span>
         <br />
             <span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="supp_account.php">Supprimer mon compte</a></span>
             <br />

 
      </div>
   </div>

   </body>



</html>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<?php   
}
?>


