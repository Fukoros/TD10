<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Traitement 2</title>
  </head>
  <body>

    <?php

      $l_id = $_POST['id'];
      $la_ville = $_POST['ville'];
      $le_jour = $_POST['day'];

      $c = ocilogon('c##tsoular_a', 'tsoular_a', 'dbinfo');

      if (!$c){
        echo "Echec connection , j'arrete !";
        return;
      }

      $texteReqNB = "SELECT idv, prix, activite
                     FROM village
                     WHERE ville = '".$la_ville."'
                     ORDER BY prix desc";

      echo $texteReqNB."<br>";

      $ordreNB = ociparse($c, $texteReqNB);

      ociexecute($ordreNB);

      if (ocifetchinto($ordreNB, $ligne)){
        echo "idv : ".$ligne[0]." prix : ".$ligne[1]." activite : ".$ligne[2];

        $textReqNEXTVAL  = ":ids := seq_sejour.nextval";
        $ordreIDS = ociparse($c, $textReqNEXTVAL);
        ocibindbyname($ordreIDS, ":ids", $ids);
        ociexecute($ordreIDS);
        echo '<br>'.$ids;

      } else {
        echo "Pas trouve !";
      }

      ocilogoff($c);
     ?>

  </body>
</html>
