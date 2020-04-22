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

      $texteReqNB = "
      begin traitement2(".
        $l_id.",".
        $la_ville.",".
        $le_jour.",
        :l_idv,
        :l_ids,
        :l_activite); end;";

      echo $texteReqNB."<br>";

      $ordreNB = ociparse($c, $texteReqNB);

      ocibindbyname($ordreNB, ':l_idv', $idv);
      ocibindbyname($ordreNB, ':l_ids', $ids);
      ocibindbyname($ordreNB, ':l_activite', $acti);

      ociexecute($ordreNB);

      echo "<br> Valeurs renvoyé : IDV = ".$idv." | IDS = ".$ids." | Acti = ".$acti;
     ?>

  </body>
</html>
