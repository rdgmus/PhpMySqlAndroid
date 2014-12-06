<?php

/**
* GraphViewInterface raggruppa tutte le funzioni rivolte
* all'interrogazione del database per la realizzazione di
* grafici tramite il pacchetto GraphView
*
* @author rdgmus
* @filesource
*/
//http://192.168.0.215/PhpMySqlAndroid/GraphViewInterface.php?graph_type=DAILY

include "functions/MySqlFunctionsClass.php";

$mySqlFunctions = new MySqlFunctionsClass();

if (NULL != filter_input(INPUT_GET, 'graph_type')) {
  $graph_type = filter_input(INPUT_GET, 'graph_type');
  if ($graph_type == "DAILY") {//GRAFICO CONNESSIONI PER GIORNO
    $array =   $mySqlFunctions->getDailyConnectionAsJSON();
    //    echo "CONNESSIONI GIORNALIERE";

    print($array);
  }
  if ($graph_type == "MONTLY") {//GRAFICO CONNESSIONI PER MESE
    $array =  $mySqlFunctions->getConnectionPerMonth();
    //    echo "CONNESSIONI MENSILI";
    print(json_encode($array));
  }
}

//**********************************************************


  ?>
