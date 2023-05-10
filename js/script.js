
var urlBase = window.location.href;

/*
    Completare le due funzioni indicate e collegare in modo opportuno 
    i metodi alla pagina html. 

    NOTA. E' possibile servirsi di altre funzioni per completare quanto indicato.
*/

/**
 *  Inizializza l'interfaccia richiedendo i dati necessari 
 * e caricando dinamicamente la select e creando il grafico
 */

window.onload = init();

async function init(/** EVENTUALI PARAMETRI */){

    // PERCORSI
    let perc = await fetch(urlBase + "server/getPercorsi.php", {method:"get"});

    let datiDB = await perc.json();
    
    console.log(datiDB)

    var combo = document.getElementById("selPercorsi");

    for(let i = 0; i < datiDB.percorsi.length; i++){
        combo.innerHTML += "<option value=" + datiDB.percorsi[i].descr + ">" + datiDB.percorsi[i].descr +"</option>"
    }


    //GRAFICO STATISTICHE
    let stats = await fetch(urlBase + "server/getStatistiche.php", {method:"get"});
    let datiStats = await stats.json();

    disegnaGrafico(datiStats);


}

function disegnaGrafico(stats){
    let dati = {
        labels: [],
        datasets: [{
          label: 'My First Dataset',
          data: new Array()
        }]
      };

    let prova = [];
    
    dati.labels.push("Bambini");
    dati.labels.push("Anziani");
    dati.labels.push("Abbonati");
    dati.labels.push("Studenti");

    prova.push(parseInt(stats.num11));
    prova.push(parseInt(stats.num80));
    prova.push(parseInt(stats.abbo));
    prova.push(parseInt(stats.stud));

    dati.datasets[0].data = prova;
    

    let canvas = document.createElement("canvas");
    canvas.style.height="300px";
    canvas.style.width = "300px";
    document.getElementById("mainGrafico").appendChild(canvas);
    let grafico = new Chart(canvas, {
        type: 'polarArea',
        data: dati
    });
}

/**
 * Gestisce la prenotazione del percorso mandando i dati al server 
 * e visualizzando la sua risposta. 
 * 
 * E' necessario controllare che sia compilato ALMENO il percorso,
 * gli altri campi vengono valorizzati a NO o alla data di oggi.
 * 
 * 
 * PER IL 10. Fare il donwload di un file html creato dinamicamente che contenga 
 * le info relative alla prenotazione.
 */
function acquista(/** EVENTUALI PARAMETRI */){

}




let html = `
<html>
    <head>
        <title>Biglietto</title>
        <style>
            body, main{
                ....
            }

            main{
                ....
            }

            section{
                ....
            }

            footer{
                ....
            }
        </style>
    </head>
    <body>
        <main>
            <section>
                <article>
                    <h3>.....</h3>
                </article>
                <article>
                    .....
                </article>
            </section>
            <section>
                <h2>......</h2>
            </section>
            <footer>
                Biglietto generate alle .... del giorno .....
            </footer>
        </main>
    </body>
</html>
`;
