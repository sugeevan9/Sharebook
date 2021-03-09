
<?php


    if( isset($_POST['commentaire']) && isset($_POST['note']) ){
    	$date = date('Y-m-d H:i:s');
        $bdd = new PDO('mysql:host=ls-0f927a463e6d389cf0f567dc4d5a58f8ca59fcd7.cq7na6hxonpd.eu-central-1.rds.amazonaws.com;dbname=ShareBook', 'sharebookuser', 'uA?BL6P8;t=P-JKl)]Su>L3Gj$[mz0q]');
 

        $insert_commentaire = $bdd->prepare('INSERT INTO avis(ID_Document, ID_Utilisateur, Note, Commentaire, Date) VALUES(?,?,?,?,?)');
        $insert_commentaire->execute(array($_POST['id_document'], $_POST['id_user'], $_POST['note'], $_POST['commentaire'], $date));

/*        $arr = $insert_commentaire->errorCode();
        print_r($arr);*/

        $arr = $insert_commentaire->errorInfo();
        print_r($arr[1]);



  }
?>