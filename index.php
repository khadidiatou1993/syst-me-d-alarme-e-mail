<!--connexion a la DB-->
<?php 
require_once('config.php'); 
require_once("functions.php");
$page_title = "";
?>  

<!DOCTYPE html>
<html>
<head>
	<title>UNV alert</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <header>
    <?php require_once("menu.php"); ?>
  </header>
	<center>
	<!--<h3>Enregistrer un Volontaire</h3>-->
	<!--<img src="logo1.jpg">-->

  <br><br>
  <br><br>
  <br><br>

	<div class="container col-md-8 col-md-offset-2" style="margin-top: 20px"> 
	<form method="POST" action="" autocomplete="off">
		<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nom</label>
      <input type="text" name="nom" class="form-control" id="inputEmail4" placeholder="first name" required="">
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Prenoms</label>
      <input type="text" name="prenoms" class="form-control" id="inputEmail4" placeholder="second name" required="" >
    </div>
     </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Date de debut</label>
        <input type="date" name="datedeb" class="form-control" id="inputPassword4" placeholder="date start" required="">
      </div>

      <div class="form-group col-md-6">
        <label for="inputAddress">Date de fin</label>
        <input type="date" name="datefin" class="form-control" id="inputAddress" placeholder="date end" required="">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputAddress2">Date anniverssaire</label>
        <input type="date" name="aniv" class="form-control" id="inputAddress2" placeholder="birthday" required="">
      </div>

      <div class="form-group col-md-6">
          <label for="inputState">Agence</label>
          <select id="inputState" class="form-control" name="agence">
            <option value="">Choisir</option>
          	<?php 
              $agences = findAllAgence();
              while($agence = $agences->fetch(PDO::FETCH_ASSOC)){ 
            ?>
            <option value=<?= "".$agence['id']."" ?>> <?= $agence['nomagc'] ?></option>
            <?php
              }
            ?>
         <!--<option value="autres">Autres</option>-->
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="valider">Valider</button>
    </div>
</form>
</div>

<br><br>
<br><br>
<br><br>
<br><br>

  <h6 style="padding: 15px">UNV Alert <?= date('Y') ?></h6>
  </center>
</body>
</html>


<?php

  if(isset($_POST['valider'])){

      extract($_POST);
      $nom = addslashes($nom);
      $prenoms = addslashes($prenoms);
      $datedeb = addslashes($datedeb);
      $datefin = addslashes($datefin);
      $aniv = addslashes($aniv);
      $agence = addslashes($agence);

      //insertion dans la table passagers
      $sql= "INSERT INTO alert (nomagt, prenoms, datedeb, datefin, aniv, agence) 
            VALUES ('$nom', '$prenoms', '$datedeb', '$datefin', '$aniv', '$agence')";
      $sth = $db->exec($sql);

      if(!$sth) {
        echo $cnx->errorInfo();
      }else{
        return true;
      }
  }

?>