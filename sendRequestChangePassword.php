<?php

include "functions/mySqlFunctions.php";

$mySqlFunctions = new MySqlFunctionsClass();


//INOLTRA RICHIESTA INSERENDO UN RECORD NELLA TABELLA change_password_request
if (NULL != filter_input(INPUT_GET, 'cognome')) {
  $cognome = filter_input(INPUT_GET, 'cognome');
}else $cognome='cognome';

if (NULL != filter_input(INPUT_GET, 'nome')) {
  $nome = filter_input(INPUT_GET, 'nome');
}else $nome='nome';

if (NULL != filter_input(INPUT_GET, 'email')) {
  $email = filter_input(INPUT_GET, 'email');
}else $email='me@work.it';

if ($mySqlFunctions->alreadyExistsPasswordRequestFor($cognome, $nome, $email)) {
  //                $msg = "<h3>Esiste gi&agrave; una richiesta di cambiamento password per"
  //                        . "</h3><h2> ".$cognome." ".$nome." [".$email."]";
  echo (int) 2;
  exit();
}

//GENERO UNA CHIAVE UNICA PER L'UTENTE
$hash = $mySqlFunctions->generate_hash($cognome + $nome + $email);
$esito = $mySqlFunctions->postChangePasswordRequest($cognome, $nome, $email, $hash);
if ($esito) {
  //echo "esito dentro";
  $id_request = $mySqlFunctions->retrieveIdRequest($hash);
  $toLink = "http://" . $_SERVER['SERVER_NAME'] .
  "/PhpRegistroScuolaNetBeans/confirmRequestByUserPage.php?hash=" . urlencode($hash) .
  "&id_request=" . $id_request .
  "&cognome=" . $cognome .
  "&nome=" . $nome .
  "&email=" . $email;
  inviaRichiestaConfermaTo($cognome, $nome, $email, $toLink);
  echo (int) 1;
} else {
  echo (int) 0;
}



/**
*
* @param type $cognome
* @param type $nome
* @param type $email
* @param type $toLink
* @return boolean
*/
function inviaRichiestaConfermaTo($cognome, $nome, $email, $toLink) {
  //INVIA EMAIL PER RICHIESTA CONFERMA
  $from = 'rdgmus@live.com';
  $to = $email;
  $subject = 'Ha inoltrato una richiesta di cambio password';
  $message_content = '<h2>Conferma la richiesta di cambio password? </h2><br>' .
  "In tal caso effettui una connessione al link sottostante " .
  " cliccando su di esso o copiandolo nel suo browser, " .
  " e segua le istruzioni." .
  "Cordiali Saluti <br> Admin - PhpRegistroScuolaNetBeans <br>" .
  "<a href='" . $toLink . "'>" . $toLink . "</a>";
  //Assigning a picture for {logo} replacement
  $logo = "images/cbasso1.png";
  //INVIA IL MESSAGGIO CON LE NUOVE CREDENZIALI ALL'UTENTE
  include_once 'phpmailer-with-templates/phpmailer-config.php';
  $status = send_message($from, $to, $subject, $message_content, $logo);
  if ($status) {//EMAIL INVIATA
    return TRUE;
  }
  return FALSE;
}
?>
