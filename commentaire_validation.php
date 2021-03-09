
<?php


    if( isset($_POST['commentaire']) && isset($_POST['choix']) ){
    	$date = date('Y-m-d H:i:s');
        $bdd = new PDO('mysql:host=ls-0f927a463e6d389cf0f567dc4d5a58f8ca59fcd7.cq7na6hxonpd.eu-central-1.rds.amazonaws.com;dbname=ShareBook', 'sharebookuser', 'uA?BL6P8;t=P-JKl)]Su>L3Gj$[mz0q]');

        $date_validation = "";
        $valider = 0;
       	$non_valide = 0;
       	$refuser = 0;

       if(strcasecmp($_POST['choix'], 'oui') == 0){
            $valider = 1;
            $date_validation = $date;
       } elseif (strcasecmp($_POST['choix'], 'non') == 0) {
       	    $non_valide = 1;
       } elseif (strcasecmp($_POST['choix'], 'refuse') == 0) {
       	    $refuse = 1;
       }
 

        $insert_commentaire_validation = $bdd->prepare('UPDATE documents SET Commentaire_Validation = ?, Valider = ?, Non_Valide = ?, Refuser = ?, Validateur = ?, Date_validation = ?, Date_dernier_check = ? WHERE ID_Document = ?');

        $insert_commentaire_validation->execute(array($_POST['commentaire'], $valider, $non_valide, $refuser, $_POST['id_user'], $date_validation, $date, $_POST['id_document']));

/*        $arr = $insert_commentaire->errorCode();
        print_r($arr);*/

        $arr = $insert_commentaire_validation->errorInfo();
        print_r($arr[1]);



  }
?>