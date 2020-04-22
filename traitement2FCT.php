<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Traitement 2</title>
  </head>
  <body>

    <?php

      $le_jour = $_POST['day'];

      $c = ocilogon('c##tsoular_a', 'tsoular_a', 'dbinfo');

      if (!$c){
        echo "Echec connection , j'arrete !";
        return;
      }

      $texteReqNB = "select count(*)
        from sejour
        where jour < ".$le_jour;

      $ordreNB = ociparse($c, $texteReqNB);

      ociexecute($ordreNB);

      if (ocifetchinto($ordreNB, $ligne)){
        echo $ligne[0];
      }

    $texteReqDelet = "delete sejour
        where jour < ".$le_jour;

      $ordreDelet = ociparse($c, $texteReqDelet);

      ociexecute($ordreDelet);

      ocilogoff($c);
     ?>

  </body>
</html>
