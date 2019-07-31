      <?php

// Nettoyer les données 
 function sanitize($data) {
  // supprestion des balises
  $data = strip_tags($data);
  // supression des espaces
  $data = trim($data);
  // convertis les éléments en html
  $data = htmlentities($data);
  // Echapper les quotes
  $data = addslashes($data);

  return $data;
}

  function findAllAgent(){
    global $db;
    $sql = "SELECT *, 
                DATEDIFF(datefin,datedeb) as dureecontrat, 
                DATEDIFF(SYSDATE(),aniv) as anivdans,
                YEAR(aniv) as anneeaniv, YEAR(SYSDATE()) as anneepc 
              FROM alert ORDER BY dureecontrat ASC";
    // var_dump($sql);
    $sth = $db->query($sql);
    if (!$sth){
      exit("Erreur dans la Requête");
    }
    return $sth;
  }

  function findAgentById($id){
    global $db;
    $sql = "SELECT * FROM alert WHERE id = '".sanitize($id)."'";
    $sth = $db->query($sql);
    if (!$sth){
      exit("Erreur dans la Requête");
    }
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function findAllAgence(){
    global $db;
    $sql = "SELECT * FROM agence";
    $sth = $db->query($sql);
    if (!$sth){
      exit("Erreur dans la Requête");
    }
    return $sth;
  }

  function findAgenceById($agence){
    global $db;
    $sql = "SELECT * FROM agence WHERE id = '".sanitize($agence)."'";
    $sth = $db->query($sql);
    if (!$sth){
      exit("Erreur dans la Requête");
    }
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    // var_dump($result);
    return $result['nomagc'];
  }

  function updateBirthday($anneeaniv, $anneepc, $agent_id){
    if(sanitize($anneeaniv) < sanitize($anneepc)){
      $volontaire = findAgentById($agent_id);
      $current_anniv = $volontaire['aniv'];
      $new_anniv = SYEAR.''.substr($volontaire['aniv'], 4, 6);
      $updated =  updateAgent($new_anniv, sanitize($agent_id));

      if($updated === true) {
        return true;
      } else {
        exit("Zuuuut! ;(");
      }
    // }else{
      //die("Tout est OK! Avançons!");
    }
  }

  function updateAgent($new_anniv, $agent_id){
    global $db;
    $sql  = "UPDATE alert SET aniv = '".sanitize($new_anniv)."'
    WHERE id = '".sanitize($agent_id)."'";
    $sth = $db->exec($sql);

    if($sth) {
      return true;
    }else{
      print_r($db->errorInfo());
      exit;
    }
  }

  // réécrir la date anniversaire d'un agent
  function currentAnniv(){

  }

  // Prepare Message
  function PrepareEmail($Object){

    if(isset($_GET[''.sanitize($Object).''])){
      
      $id = $_GET[''.sanitize($Object).''];
      $volunteer = findAgentById($id);

      $nom = $volunteer['prenoms']." ".$volunteer['nomagt'];
      $agence = findAgenceById($volunteer['agence']);
      $datedeb = date_format(date_create($volunteer['datedeb']), 'd-m-Y');
      $datefin = date_format(date_create($volunteer['datefin']), 'd-m-Y');

      if(sanitize($Object) === 'volunteer'){
        $body = '<h1 style="color: red;">Fin de contrat le '.$datefin.'</h1>
          <h2>Nom: '.$nom.'<br>Agence: '.$agence.'<br>Date debut: '.$datedeb.'</h2>';
      }elseif(sanitize($Object) === 'anniv'){
        $body = '<h1 style="color: red;">Souhaitez un Joyeux Anniveraire à</h1>
          <h2>Nom: '.$nom.'<br>Agence: '.$agence.'<br>Date debut: '.$datedeb.'
          <br>Date Fin: '.$datefin.'</h2>';
      }

    }else{
      exit('Aucun Object renvoyez');
    }

    return $body;

  }

?>