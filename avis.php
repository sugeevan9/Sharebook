<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <meta name="keywords" content="<?php echo $keywords;?>" />
    <meta name="description" content="<?php echo $metadescription; ?>" />


    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/star-rating.css" />


</head>

<body id="page-top">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav" style="background-color: black !important">
        <div class="container"><a class="navbar-brand" href="index.php">
            <img src="assets/img/logo2.png" style="width: 150px;"></a>
            <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" data-toogle="collapse" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto text-uppercase">
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="index.php"><strong>Accueil</strong></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="vehicules.php"><strong>vehicules</strong></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="avis.php"><strong>avis</strong></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="devis.php"><strong>Devis</strong></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="contact.php"><strong>Contact</strong></a></li>
                </ul>
            </div>
        </div>
    </nav>


<?php
 

  $title="My Prestige Transport";
  $metadescription = "Description de la page";
  $keywords = "location de voiture, mariage, location, transport";

  $nav_active='avis' ;

?>

<section id="team" class="bg-light">
        <div class="container">
          <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading small_title animated revealOnScroll fadeInDown" data-animation="fadeInDown=" style=" animation-delay: 1s;">Avis Clients</h2>
                    <hr class="seperator-line animated revealOnScroll fadeInDown" data-animation="fadeInDown=" style=" animation-delay: 1s;"></hr>
                    <h4 class="text section-heading small_title_text animated revealOnScroll fadeInUp" data-animation="fadeInUp=" style="animation-delay: 2s;">Partager nous votre expérience !</h4>
                </div>
            </div>
            <div class="row" style="background-color: white; padding: 40px ">
              <div class="col-lg-12">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputName">Nom</label>
                      <input type="text" class="form-control" id="inputName" placeholder="Nom">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputAddress">Email</label>
                      <input type="email" class="form-control" id="inputAddress" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputDate">Date de la Location</label>
                      <input type="date" class="form-control" id="inputDate">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputNote">Note</label>
                      <select class="star-rating">
                        <option value="">Choisir une note</option>
                        <option value="5">Excellent</option>
                        <option value="4">Très bien</option>
                        <option value="3">Moyen</option>
                        <option value="2">Mauvais</option>
                        <option value="1">Terrible</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputMessage">Votre commentaire</label>
                    <textarea class="form-control" rows="3" id="inputMessage" placeholder="Votre commentaire"></textarea>
                  </div>
                  <div class="form-group col-md-3" style="float: right;">
                    <button id="ajouter_avis" class="btn btn-primary" style="width: 100%;">Envoyer mon avis</button>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container" style="background-color: white; padding: 40px; margin-top: 40px;">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="text-uppercase section-heading small_title" style="margin-bottom: 10px;">Avis de nos clients</h2>
                <hr style="border: 1px solid #E2E6E7;border-radius: 10px; width: 100px; margin-bottom: 20px;">
            </div>
          </div>
          <div class="row">
            <div class="box_avis col-md-6">
              <h6> Note siteweb <span id="avis_note_moyenne" style="float: right;">--</span></h6>
            </div>
          </div>
          <div class="row" style="background-color: white; padding: 80px 7px;">
            <div class="col-lg-12">
           
                <div class="review_item">
                  <div class="media">
                    <div class="d-flex">
                      <div class="numberCircle">TEST</div>
                    </div>
                    <div class="user_comment_info">
                      <h6 class="avis_name">Test</h6>
                        <i class='fa fa-star star_note'></i>
                      
                      <span style=" font-size : 14px; font-weight: 100">Date du 05/03</span>
                    </div>
                  </div>
                  <p>Je trouve que le libre est</p>                
                </div>
             
              <div id="load_more_items" data-average_note="5">
                <i class="fa fa-angle-double-down"></i>
                <a href="#" id="loadMore" >Charger plus</a>
              </div>
           </div> 
          </div>
  </div>
</section>
  


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/agency.js"></script>
    <script src="assets/js/star-rating.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src ="assets/js/modernizr.min.js"></script>
    <script src="assets/js/animation.js"></script>