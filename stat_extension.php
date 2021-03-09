<?php
   //Permet de garder les variables de la session
   session_start();
   
   //Permet de récuprer le contenu du fichier connect_db.php 
   require 'includes/connect_db.php';
   //Connexion à notre base de donnée
      $bdd = new PDO('mysql:host=ls-0f927a463e6d389cf0f567dc4d5a58f8ca59fcd7.cq7na6hxonpd.eu-central-1.rds.amazonaws.com;dbname=ShareBook', 'sharebookuser', 'uA?BL6P8;t=P-JKl)]Su>L3Gj$[mz0q]');
   
   //Restrindre l'accés à cette page au personne non connecté
    if(!isset($_SESSION['id'])) {
   
            header('Location: errorConnexion.html');
            exit;
         
      }
   
   
   $user = $_SESSION['pseudo'];
   
   //En fonction de l'extension permet de compter le nombre de document 
   $reqdocuments = $bdd->prepare("SELECT Chemin FROM documents"); 
   $reqdocuments->execute(array($user));
   $req_documents = $reqdocuments->fetchAll();
   
   
   $docs = array();
   foreach($req_documents as $result) { 
     //echo $result[0], '<br>'; 
     array_push($docs, strtoupper(pathinfo($result[0], PATHINFO_EXTENSION)));
   }

   
   $PDF = 0;
   $BOOK = 0;
   $EPUB = 0;
   foreach ($docs as $value)
   {
      if($value == "PDF")
           $PDF++;
      elseif($value == "BOOK")
           $BOOK++;
      elseif($value == "EPUB")
           $EPUB++;

   }

   ?>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Statistiques extension</title>
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
         <div class="container">
            <a class="navbar-brand" href="index.php" style="color: #ffffff;">ShareBook</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
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
               </ul>
               <span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Déconnexion</a></span>
            </div>
         </div>
      </nav>
      <section style="background-image: url(&quot;assets/img/3image.jpg&quot;);">
         <div class="animated bounceInDown delay-100ms">
            <h1 class="text-capitalize text-center" data-aos="fade" data-aos-duration="3000" style="color: #ffffff;font-size: 100px;"><strong>Statistiques</strong></h1>
            <hr style="color: #ffffff;font-size: 27px;background-color: #ffffff;width: 700px;height: 3px;">
            <p class="text-center" style="color: #f1f7fc;"><strong>Découvrez vos statistiques sur les fichiers que vous avez téléchargé sur votre espace</strong></p>
            <p class="text-center" style="color: #f1f7fc;"><i class="fa fa-file-o bounce animated" style="font-size: 50px;margin-bottom: 35px;color: rgb(225,197,48);"></i></p>
         </div>
      </section>
      <section>
         </br>
         <h3 class="text-center"><strong><em>Statistiques en fonction de l'extension de vos documents</em></strong></h3>
         <div data-aos="fade" data-aos-duration="3000" style="margin: 40px;padding: 115px;">
            <canvas data-bs-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;PDF&quot;,&quot;BOOK&quot;,&quot;EPUB&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Fréquence&quot;,&quot;backgroundColor&quot;:&quot;#df4e4e&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;<?php echo($PDF); ?>&quot;,&quot;<?php echo($BOOK); ?>&quot;,&quot;<?php echo($EPUB); ?>&quot;,&quot;0&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas>
         </div>
      </section>
      </br>
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/js/chart.min.js"></script>
      <script src="assets/js/bs-animation.js"></script>
      <script src="assets/js/bs-charts.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
   </body>
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
</html>