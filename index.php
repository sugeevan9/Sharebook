<?php

//Permet de garder les variables de la session
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ShareBook</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/animate.css">


</head>

<body class="text-secondary">

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
   </nav>


    <section style="background: url('assets/img/carousel2.jpg') no-repeat fixed; background-size:cover !important;">
        <div style="background-color: rgba(0, 0, 0, 0.5); opacity: 1">
        <div class="container" style="padding-top: 100px; color: white;height: 600px ">
            <div align="center" class="animated bounceInDown delay-100ms">


            <h1 style="font-size: 100px">ShareBook</h1>
                <p style="font-size: 20px">Fini la paperasse, passez au format digital !</p>

                <a href="#sommaire"><i class="fa fa-arrow-circle-down" style="font-size: 50px" data-bs-hover-animate="flash"></i></a>

            </div>

        </div>
        </div>
    </section>


    <section id="sommaire">
    <div class="team-boxed">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Nos services ShareBook :</h2>
                <p class="text-center">Sur ce site, nous vous proposons de :</p>
            </div>
            <div class="row people">
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><i class="fa fa-database" style="background-color: #f9dd16;width: 99px;height: 92px;margin: -5px;font-size: 61px;border-radius: 50px;padding: 10px;"></i>
                        <h3 class="name"><strong>Déposer son oeuvre</strong><br></h3>
                        <p class="description">Auteur débutant ou confirmé ? Déposer votre oeuvre selon vos règles</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><i class="fa fa-money" style="background-color: #f9dd16;width: 99px;height: 92px;margin: -5px;font-size: 61px;border-radius: 50px;padding: 15px;"></i>
                        <h3 class="name"><strong>Acheter une oeuvre</strong><br></h3>
                        <p class="description">Recherchez toutes les oeuvres que vous voulez en un seul et unique site</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><i class="fa fa-search" style="background-color: #f9dd16;width: 99px;height: 92px;margin: -5px;font-size: 61px;border-radius: 50px;padding: 15px;"></i>
                        <h3 class="name"><strong>Abonnement sur tout </strong><br></h3>
                        <p class="description">Abonnez-vous pour avoir un accès illimité sur toutes les oeuvres</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12 item">
                    <div class="box"><i class="fa fa-binoculars" style="background-color: #f9dd16;width: 99px;height: 92px;margin: -5px;font-size: 61px;border-radius: 50px;padding: 15px;"></i>
                        <h3 class="name"><strong>Location court terme</strong><br></h3>
                        <p class="description">Si vous êtes un lecteur occasionnel, louer juste une oeuvre et une certaine durée</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>


        <section>
            <div align="center">
                <h1>Tendance actuelle</h1>

            </div>


            <div class="carousel slide" data-ride="carousel" id="carousel-1">
                <div class="carousel-inner" role="listbox" style="height: 700px !important;">
                    <div class="carousel-item"><img class="w-100 d-block" src="assets/img/carousel1.jpg" alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="assets/img/carousel2.jpg" alt="Slide Image"></div>
                    <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/carousel3.jpg" alt="Slide Image"></div>
                </div>
                <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                <ol class="carousel-indicators">
                    <li data-target="#carousel-1" data-slide-to="0"></li>
                    <li data-target="#carousel-1" data-slide-to="1"></li>
                    <li data-target="#carousel-1" data-slide-to="2" class="active"></li>
                </ol>
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
                    <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">ShareBook © 2021</p>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
