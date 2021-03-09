<?php
//Permet de supprimer le contenu de la variable session et supprimer la session
session_start();
$_SESSION = array();
session_destroy();
header("Location: connexion.php");
?>