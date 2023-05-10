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
    Connettersi al database e restituire un array di oggetti con:
    - il numero di biglietti dei bambini con età inferiore 11
    - il numero di biglietti delle persone con età superiore ad 80 anni
    - il numero di biglietti delle persone con abbonamento
    - il numero di biglietti degli studenti
*/