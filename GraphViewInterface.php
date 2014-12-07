<?php

/**
* GraphViewInterface raggruppa tutte le funzioni rivolte
* all'interrogazione del database per la realizzazione di
* grafici tramite il pacchetto GraphView
*
* @author rdgmus
* @filesource
*/
//http://192.168.0.215/PhpMySqlAndroid/GraphViewInterface.php?graph_type=DAILY&mese=1&anno=2014
//http://192.168.0.215/PhpMySqlAndroid/GraphViewInterface.php?graph_type=MONTLY&anno=2014

include "functions/MySqlFunctionsClass.php";

$mySqlFunctions = new MySqlFunctionsClass();

if (NULL != filter_input(INPUT_GET, 'graph_type')) {
  $graph_type = filter_input(INPUT_GET, 'graph_type');


  if (NULL != filter_input(INPUT_GET, 'anno')) {
    $anno = filter_input(INPUT_GET, 'anno');
  }else
  $anno = 2014;
  if (NULL != filter_input(INPUT_GET, 'mese')) {
    $mese = filter_input(INPUT_GET, 'mese');
  }else
  $mese = 11;

  if ($graph_type == "DAILY") {//GRAFICO CONNESSIONI PER GIORNO

    $array =   $mySqlFunctions->getDailyConnectionAsJSON($mese,$anno);
    //    echo "CONNESSIONI GIORNALIERE";
    print($array);
  }
  if ($graph_type == "MONTLY") {//GRAFICO CONNESSIONI PER MESE
    $array =  $mySqlFunctions->getMontlyConnectionAsJSON($anno);
    //    echo "CONNESSIONI MENSILI";
    print($array);
  }
}

if (NULL != filter_input(INPUT_GET, 'periodi_conn')) {
  $periodi_conn = filter_input(INPUT_GET, 'periodi_conn');
  if($periodi_conn == "anni"){
    //    echo "CONNESSIONI PER ANNO";
    $array =  $mySqlFunctions->getConnectionYearsArrayAsJSON();
  }else if($periodi_conn == "mesi"){
      //echo "CONNESSIONI PER MESE";
    if (NULL != filter_input(INPUT_GET, 'anno')) {
      $anno = filter_input(INPUT_GET, 'anno');
    }else
    $anno = 2014;

    $array =  $mySqlFunctions->getConnectionMonthsArrayAsJSON($anno);
  }
  print($array);
}


?>
