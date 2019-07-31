<?php
  header_remove();
  require_once("config.php");
  require_once("functions.php");
  // Rafraichisement auto de la page
  $page = $_SERVER['PHP_SELF'];
  // var_dump($page);
  //var_dump(rand(10, 10000));
  $sec = "84600";

  if(isset($_GET['sent'])){
    var_dump($_GET['sent']);
  }
  $page_title = "";
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  <title>UNV ALERT</title>
  <!--active la notification-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php require_once("menu.php"); ?>

<br><br>
<br><br>
  <center>
    <!-- <img src="logo.jpg" height="150" width="150">
    <h1>LISTE DES VOLONTAIRES</h1> -->
    <table class="table table-striped col-md-11">
      <thead class="thead-dark">
          <tr>
            <th scope="col">NOM</th>
            <th scope="col">PRENOMS</th>
            <th scope="col">AGENCE</th>
            <th scope="col">DATE DE DEBUT</th>
            <th scope="col">DATE DE FIN</th>
            <th scope="col">FIN CONTRAT</th>
            <th scope="col">DATE ANNIV</th>
            <th scope="col">CURRENT ANNIV</th>
            <th scope="col">ANNIV DANS</th>
          </tr>
        </thead>
        <tbody>
          <?php $volontaires = findAllAgent();
            foreach($volontaires as $volontaire):
            //while($volontaire = $volontaires->fetch(PDO::FETCH_ASSOC)) { 
            $agence = $volontaire['agence'];
            // $current_aniv = SYEAR.''.substr($volontaire['aniv'], 4, 6);
            $date = date_create($volontaire['datedeb']);
            //vérifivation et mise à jour auto de la date anniversaire
            updateBirthday($volontaire['anneeaniv'], 
            $volontaire['anneepc'], $volontaire['id']);
            // vérification et en voie de la notification 
            if(($volontaire['dureecontrat'] == 30) AND !isset($_GET['id'])){
              header("Location: mailnotif.php?volunteer=".$volontaire['id']);
            }

            if(($volontaire['anivdans'] == 1)){
              header("Location: mailnotif.php?anniv=".$volontaire['id']);
            }

          ?>
            <tr>
             <td><?= $volontaire['nomagt'] ?></td>
             <td><?= $volontaire['prenoms'] ?></td>
             <td><?= findAgenceById($volontaire['agence']) ?></td>
             <td><?= date_format(date_create($volontaire['datedeb']), "d-m-Y") ?></td>
             <td><?= $volontaire['datefin'] ?></td>
             <td><?= ($volontaire['dureecontrat'] < 0 ? "Terminé" : $volontaire['dureecontrat']." Jours") ?></td>
             <td><?= $volontaire['aniv'] ?></td>
             <td><?= $volontaire['aniv'] ?></td>
             <td><?= ($volontaire['anivdans'] < 0 ? "Passé" : $volontaire['anivdans']." Jours") ?></td>
            </tr>
          <?php 
            endforeach;
          ?>
        </tbody>
      </table>
      <br><br>
      <br><br>
      <br><br>

      <h6 style="padding: 15px">UNV ALERT <?= date('Y') ?></h6>
  </center>
  </body>
</html>
  