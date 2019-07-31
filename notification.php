$contact_notif = 
    <h1 style="color: red;">Fin de contrat le 
        <?= date_format(date_create($volunteer['datefin']), 'd-m-Y') ?></h1>
    <h3>
        Le contrat de <?= $volunteer['nomagt']." ".$volunteer['prenoms'] ?> fini dans un mois.
        <br>Agent: <?= $volunteer['nomagt']." ".$volunteer['prenoms'] ?>
        <br>Date debut: <?= $volunteer['datedeb']?>
        <br>Agence: <?= findAgenceById($volunteer['agence'])?>
    </h3>
</body>
</html>