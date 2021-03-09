<?php
//Permet de garder les variables de la session
session_start();

//Permet de récupérer les variables et envoyer le mail
if(isset($_POST['message'])) {     

    if(isset($_POST['mailform']))
    {
    $header="MIME-Version: 1.0\r\n";
    $header.='From:"ShareBook.com"<sharebook.gestion@gmail.com>'."\n";
    $header.='Content-Type:text/html; charset="uft-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';
    $message = $_POST['message'];
    $email =  $_POST['email'];
    $nom = $_POST['nom'];
    $titre = "Message de $nom ($email) de la page Contactez-nous";
    mail("sharebook.gestion@gmail.com", $titre, $message, $header);
    $erreur = "Mail envoyé !";
    }
} 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ShareBook - Aides</title>
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

               

 
            
              <?php
                //Rajout du bouton de connexion ou déconnexion en fonction de la connexion ou non de l'utilisateur 
                          if(isset($_SESSION['id'])) {

                               echo '</ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="profil.php">Vous êtes connectez : Retour Profil</a>';
                               
                      
                            } else {


                               echo '</ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="connexion.php">Connectez-vous</a>';
                            }
             ?>

        </div>
    </div>
</nav>
    <div class="contact">
        <form class="shadow" method="post" style="border-radius: 20px 50px 20px 50px;">
            <h2 class="text-center">Contactez nous !</h2>
            <div class="form-group"><input class="form-control" type="text" name="nom" placeholder="Nom"></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><textarea class="form-control" name="message" placeholder="Message"></textarea></div>
            <form method="POST" action="">
                     <button class="btn btn-primary btn-block" type="submit" name="mailform"/>Envoyer !</button>
                      <?php
              if(isset($erreur)) {
              echo '<font color="red">'.$erreur."</font>";
              }
            ?>
            </form>

        </form>
    </div>

    <div class="footer">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3 item text">
                        <h3>ShareBook</h3>
                        <p>Start-up innovante, ShareBook a pour ambition de rendre la connaissance accessible et universel.</p>
                    </div>
                </div>
                <p class="signature">Copyright ShareBook © 2021</p>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>