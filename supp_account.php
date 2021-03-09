<?php
    
   //Permet de garder les variables de la session
   session_start();
   require 'includes/connect_db.php';
   //Permet de récuprer le contenu du fichier connect_db.php 

   $lien = 'Location: deconnexion.php';

//Restrindre l'accés à cette page au personne non connecté
 if(!isset($_SESSION['id'])) {

         header('Location: errorConnexion.html');
         exit;
      
   }

   if(isset($_POST['formsupp'])) {

       if(!empty($_POST['question'])){
            if($_POST['question'] == "non") {

                     $message = '<a href="profil.php">Cliquer ici pour revenir sur votre profil</a>';
            }
            elseif ($_POST['question'] == "oui") {

                    //Supprimer la personne
                     $userid = $_SESSION['id'];
                     $usrpseudo= $_SESSION['pseudo'];
                     $req = $db->query('DELETE FROM utilisateur WHERE ID_Utilisateur ="'.$userid.'"');
                    //Supprimer les documents de l'utilisateur si l'option est cochée
                     if(!empty($_POST['scales'])){
                            
                            $req = $db->query('DELETE FROM documents WHERE ID_Auteur ="'.$usrpseudo.'"');
                            
                     }
                     //Supprimer les genres de l'utilisateur si l'option est cochée
/*                     if(!empty($_POST['scales2'])){
                        
                            $req = $db->query('DELETE FROM genre WHERE pseudo ="'.$usrpseudo.'"');
                            
                    }*/
                     $message = "Compte supprimer ! ";
                     header($lien);
            }
             
         } else {
            $message = "Choisiez entre oui ou non";
         }
   
   }


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Supprimer votre compte</title>
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


                 //Rajout de la barre d'administration si la personne est un administrateur


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
<div class="container">
      <div align="center" style="margin: 150px" class="animated bounceInDown delay-100ms">
         <h2>Êtes-vous sûrs de vouloir supprimer votre compte ?</h2>
          <i class="fa fa-user fa-5x"></i></br>


         <form method="POST" action="" enctype="multipart/form-data">

         </br>

         </br>
             <button type="button" class="btn btn-success"> Oui <input type="radio" class="btn btn-success" name="question" value="oui" id="oui" /></button>
             <button type="button" class="btn btn-warning"> Non <input type="radio" class="btn btn-success" name="question" value="non" id="non" /></button>
         </br>
         </br>
             <button type="submit" class="btn btn-danger" value="Supprimer le compte" name="formsupp"/>Supprimer le compte</button>
         </br>
         </br>

         <div>
                    <input type="checkbox" id="scales" name="scales">
                            <label for="scales">Supprimer les documents associés à votre compte ? </label>

                    </br>

<!--                     <input type="checkbox" id="scales2" name="scales2">
                            <label for="scales2">Supprimer les genres associés à votre compte ? </label>
                    </div> -->
           <?php
              if(isset($message)) {
              echo '<font color="red">'.$message."</font>";
              }
            ?>
            
             </form>
        </div>
      </div>
   </body>
</html>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-animation.js"></script>
<script src="assets/js/bs-charts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>