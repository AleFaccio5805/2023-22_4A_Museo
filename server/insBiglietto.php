<?php

    $indirizzoServerDBMS = "localhost";
    $nomeDb = "4a_museo";
    $conn = mysqli_connect($indirizzoServerDBMS, "root", "", $nomeDb);
    if($conn->connect_errno>0){
        $jObj->cod = -1;
        $jObj->risp = "Connessione Rifiutata";
    }
    else{
        $jObj->cod = 0;
        $jObj->risp = "Connessione OK";
}

?>

/**
    Prendendo in carico i dati arrivati dal client, verificare che il PERCORSO
    sia corretto ed effettuare l'inserimento del biglietto nel database.
*/