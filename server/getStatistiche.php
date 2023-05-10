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
    $num11 = 0;
    $num80 = 0;
    $numAbb = 0;
    $numStud = 0;

    $querySql = "SELECT annoNascita, studente, abbonamento
                 FROM biglietti";
                 
    $ris = $conn->query($querySql);

    
    if($ris){
        $cont=0;
        $biglietti = array();
        if($ris->num_rows > 0){
        while($vet = $ris->fetch_assoc()){
            $biglietti[$cont] = new stdClass();
            $biglietti[$cont]->anno =  $vet["annoNascita"];
            $biglietti[$cont]->stud =  $vet["studente"];
            $biglietti[$cont]->abbo =  $vet["abbonamento"];
            $cont++;
        }
        
        for($i = 0; $i < count($biglietti); $i++){
            if($biglietti[$i]->stud == 1){
                $numStud++;
            }
            if($biglietti[$i]->abbo == 1){
                $numAbb++;
            }
            $anno = 2023 - $biglietti[$i]->anno;

            if($anno < 11)
                $num11++;
            else if($anno > 80)
                $num80++;
        }

        $jObj->num11 = $num11;
        $jObj->num80 = $num80;
        $jObj->abbo = $numAbb;
        $jObj->stud = $numStud;

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
    Connettersi al database e restituire un array di oggetti con:
    - il numero di biglietti dei bambini con età inferiore 11
    - il numero di biglietti delle persone con età superiore ad 80 anni
    - il numero di biglietti delle persone con abbonamento
    - il numero di biglietti degli studenti
*/

?>


