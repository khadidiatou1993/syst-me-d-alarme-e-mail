<?php 
	// Fisrt year of usage
	define("SYEAR", "2019");
	$annee_deb = SYEAR;
	// Année du système
	$annee_sys = date('Y');

	//DB Credentials
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "unv_alert");
	define("DBHOST", "localhost");

	// tentative de connexion à la base de donnée
	try {
		$db=new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		die('Erreur: '.$e->getMessage());
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="main.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
		<title>UNV ALERT</title>
	</head>
	<body>
		<center>
			<?php if($annee_sys < $annee_deb): ?>
				<h1 class="center" style="color: red; padding: 3% 0 2% 0">Veuillez mettre à jour la date de votre ordinateur !!!</h1>
				<img src="https://proxy.duckduckgo.com/iu/?u=https%3A%2F%2Fs-media-cache-ak0.pinimg.com%2F736x%2Fa2%2Fd7%2F03%2Fa2d703bd269cd6fe4f0003e9d5b46270--african-masks-the-mask.jpg&f=1" height="400px" class="img-responsive"><br>
				<h3 style="padding: 10px">UNV ALERT <?= date('Y') ?></h3>
			<?php exit(); endif; ?>
		</center>
	</body>
</html>