<?php
//Permet de garder les variables de la session
session_start();
//Permet de récuprer le contenu du fichier connect_db.php 
require 'includes/connect_db.php';
//Connexion à notre base de donnée
$bdd = new PDO('mysql:host=ls-0f927a463e6d389cf0f567dc4d5a58f8ca59fcd7.cq7na6hxonpd.eu-central-1.rds.amazonaws.com;dbname=ShareBook', 'sharebookuser', 'uA?BL6P8;t=P-JKl)]Su>L3Gj$[mz0q]');
//Restrindre l'accés à cette page au personne non connecté


?>


<!doctype html>
<html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <title>Bibliothèque</title>
            <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
            <link rel="stylesheet" href="assets/css/contact.css">
            <link rel="stylesheet" href="assets/css/footer.css">
            <link rel="stylesheet" href="assets/css/navigation.css">
            <link rel="stylesheet" href="assets/css/profil.css">
            <link rel="stylesheet" href="assets/css/animate.css">
            <link rel="stylesheet" type="text/css" href="assets/css/print.min.css">




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

                if(isset($_SESSION['id'])) {

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
                 }
                ?>

          

           <?php
                 //Rajout du bouton de connexion ou déconnexion en fonction de la connexion ou non de l'utilisateur
                          if(isset($_SESSION['id'])) {

                               echo '</ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Déconnexion</a></span>';
                               
                      
                            } else {


                               echo '</ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="connexion.php">Connectez-vous</a></span>';
                            }
                ?>

        </div>
    </div>
</nav>

<section style="background-image: url(&quot;assets/img/3image.jpg&quot;);">
    <div class="animated bounceInDown delay-100ms">
    <h1 class="text-capitalize text-center" data-aos="fade" data-aos-duration="3000" style="color: #ffffff;font-size: 100px;"><strong>Bibliothèque</strong></h1>
    <hr style="color: #ffffff;font-size: 27px;background-color: #ffffff;width: 700px;height: 3px;">
    <p class="text-center" style="color: #f1f7fc;"><strong>Découvrer notre catalogue d'oeuvre disponible</strong></p>
    <p class="text-center" style="color: #f1f7fc;"><i class="fa fa-file-o bounce animated" style="font-size: 50px;margin-bottom: 35px;color: rgb(225,197,48);"></i></p>
</div>
</section>




     

<section id="portfolio" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-uppercase section-heading">Oeuvres disponibles</h2>
                <h3 class="section-subheading text-muted">Découvrer la collection des nouvelles oeuvres disponibles !</h3>
            </div>
        </div>
        <div class="row">
                <?php

                //Permet d'afficher les documents 

                    $req = $db->query('SELECT * FROM documents WHERE Valider = 1');

                    while($data = $req->fetch()){
                         
                        $req_auteur = $bdd->prepare('SELECT Nom FROM auteur WHERE ID_Auteur = ?');
                        $req_auteur->execute(array($data['ID_Auteur']));
                        $auteur = $req_auteur->fetch();

                        $req_langue = $bdd->prepare('SELECT Nom_Court FROM langues WHERE ID_Langue = ?');
                        $req_langue->execute(array($data['ID_Langue']));
                        $langue = $req_langue->fetch();


                        echo '
                        <div class="col-sm-6 col-md-4 portfolio-item">
                            <a class="portfolio-link" href="ouvrage.php?id='.$data['ID_Document'].'" >
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                                </div><img class="img-fluid" src="'.$data['Image'].'" /></a>
                            <div class="portfolio-caption">
                                <h4>'.$data['Titre'].'</h4>
                                <p class="text-muted">Auteur : '.$auteur[0].'</p>
                                <p class="text-muted">Nombre de page : '.$data['Nombre_Pages'].'</p>
                                <p class="text-muted">Langue : <img src="./flag/'.$langue[0].'.png" height="15" width="20" /></p>

                            </div>
                        </div>
                        ';
                
                      }
            ?>          
         </div>
    </div>
</section>

<div class="footer">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 item text">
                    <h3>ShareBook</h3>
                    <p>Start-up innovante, ShareBook a pour ambition de rendre la connaissance accessible et universel.</p>
                </div>

            </div>
            <p class="copyright">ShareBook © 2021</p>
        </div>
    </footer>
</div>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-animation.js"></script>
<script src="assets/js/bs-charts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="assets/js/jquery-3.3.1.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<script>
    //Fonction pour afficher et imprimer les documents PDF
    function print(doc) {
        var objFra = document.createElement('iframe');   // Create an IFrame.
        objFra.style.visibility = "hidden";    // Hide the frame.
        objFra.src = doc;                      // Set source.
        document.body.appendChild(objFra);  // Add the frame to the web page.
        objFra.contentWindow.focus();       // Set focus.
        objFra.contentWindow.print();      // Print it.
    }
</script>


</html>
