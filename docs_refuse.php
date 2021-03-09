<?php

//Permet de garder les variables de la session
session_start();
//Connexion à notre base de donnée
  $bdd = new PDO('mysql:host=ls-0f927a463e6d389cf0f567dc4d5a58f8ca59fcd7.cq7na6hxonpd.eu-central-1.rds.amazonaws.com;dbname=ShareBook', 'sharebookuser', 'uA?BL6P8;t=P-JKl)]Su>L3Gj$[mz0q]');
//Permet de récupere les informations des utilisateurs
$documents = $bdd->prepare('SELECT * FROM documents WHERE Refuser LIKE 1 ORDER BY ID_Document');
$documents->execute(array());
/*echo "\nPDOStatement::errorInfo():\n";
$arr = $documents->errorInfo();*/
//print_r($arr);

//Restrindre l'accés à cette page au personne non connecté
 if(!isset($_SESSION['id'])) {

         header('Location: errorConnexion.html');
         exit;

   }
//Restrindre l'accés à cette page au personne qui ne sont pas administrateur
if (strcasecmp($_SESSION['Roles'], 'admin') ==! 0 AND strcasecmp($_SESSION['Roles'], 'validateur') ==! 0){

         header('Location: errorAdmin.html');
         exit;    
}
    

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profil des utilisateurs du site</title>
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

<div align="center">
<div class="container">

  <h1 style="margin-top: 50px">Liste des documents refusés</h1>
    <i class="fa fa-users fa-5x"></i></br>

    </br>
    </br>
    <table id="example" class="table table-striped table-bordered" style="width:110%">
        <thead>
        <tr>
       <th>Titre</th>
       <th>Nombres de page</th>
       <th>Date de parution</th>
       <th>Date de soumissions</th>
       <th>Auteur</th>
       <th>Types</th>
       <th>Editeur</th>
       <th>Collection</th>
       <th>Utilisateur</th>
       <th>Langues</th>
       <th>Validation</th>
   </tr>
        </thead>

        <tbody>
   
      <?php while($m = $documents->fetch()) { ?>
          <tr>
            
            <th><?= $m['Titre'] ?></th>
            <th><?= $m['Nombre_Pages'] ?></th>
            <th><?= $m['Date_Parution'] ?></th>
            <th><?= $m['Date_soumission'] ?></th>
          <?php


              $req_auteur = $bdd->prepare('SELECT Nom FROM auteur WHERE ID_Auteur = ?');
              $req_auteur->execute(array($m['ID_Auteur']));
              $auteur = $req_auteur->fetch();

              echo '<th>'.$auteur[0].'</th>';

              $req_types = $bdd->prepare('SELECT Nom FROM types WHERE ID_Types = ?');
              $req_types->execute(array($m['ID_types']));
              $types = $req_types->fetch();

              echo '<th>'.$types[0].'</th>';
       
              $req_editeurs = $bdd->prepare('SELECT Nom FROM editeur WHERE ID_Editeur = ?');
              $req_editeurs->execute(array($m['ID_Editeur']));
              $editeurs = $req_editeurs->fetch();

              echo '<th>'.$editeurs[0].'</th>';

              $req_collection = $bdd->prepare('SELECT Nom FROM collection WHERE ID_Collection = ?');
              $req_collection->execute(array($m['ID_Collection']));
              $collection = $req_collection->fetch();

              echo '<th>'.$collection[0].'</th>';
            
              $req_utilisateur = $bdd->prepare('SELECT Pseudo FROM utilisateur WHERE ID_Utilisateur = ?');
              $req_utilisateur->execute(array($m['ID_Utilisateur']));
              $utilisateur = $req_utilisateur->fetch();

              echo '<th>'.$utilisateur[0].'</th>';

              $req_langue = $bdd->prepare('SELECT Nom_long FROM langues WHERE ID_Langue = ?');
              $req_langue->execute(array($m['ID_Langue']));
              $langue = $req_langue->fetch();

              echo '<th>'.$langue[0].'</th>';

          
            echo '<th><form action="ouvrage_validation.php?id='.$m['ID_Document'].'" method="POST" target="_blank"> 
            <button type="submit">Validation</button> </form></th>'
            ?>
           </tr>

      <?php
      }
      ?>
        </tbody>
    </table>
    </br>
    </br>


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