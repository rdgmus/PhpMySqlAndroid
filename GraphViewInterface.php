<?php

/**
* GraphViewInterface raggruppa tutte le funzioni rivolte
* all'interrogazione del database per la realizzazione di
* grafici tramite il pacchetto GraphView
*
* @author rdgmus
* @filesource
*/
//http://192.168.0.215/PhpMySqlAndroid/GraphViewInterface.php

include "functions/MySqlFunctionsClass.php";

$mySqlFunctions = new MySqlFunctionsClass();

$array =  $mySqlFunctions->getDailyConnection();

echo "CONNESSIONI GIORNALIERE";
print_r($array);

$array =  $mySqlFunctions->getConnectionPerMonth();

echo "CONNESSIONI MENSILI";
print_r($array);


  ?>
