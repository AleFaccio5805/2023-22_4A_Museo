<?php
    $jObj = new stdClass();


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

    $querySql = "SELECT descr, nSale
                 FROM percorsi";

    $ris = $conn->query($querySql);
    if($ris){
        $cont =0;
        $percorsi = array(); 
        if($ris->num_rows > 0){
        while($vet = $ris->fetch_assoc()){
            $percorsi[$cont] = new stdClass();
            $percorsi[$cont]->descr =  $vet["descr"];
            $percorsi[$cont]->nSale =  $vet["nSale"];
            $cont++;
        }

        $jObj->percorsi = $percorsi;
        }else{
            $jObj->cod = 1;
            $jObj->risp = "Non ho trovato nulla";
        }

    }else{
        $jObj->cod = -1;
        $jObj->risp = "Errore nella query" . $conn->error;
    }

    echo json_encode($jObj);

/*
    Connettersi al database e restituire un array di oggetti 
    con i dati dei percorsi e il numero di posti disponibili nel giorno attuale.

    NOTA. Il numero di posti disponibili giornalieri PER PERCORSO è di 20 unità.
*/  
?>
 