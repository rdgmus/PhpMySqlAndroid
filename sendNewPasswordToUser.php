<?php


/**
* sendNewPasswordToUser
* WTI5eVpHbEJNQT09
* U21JNWVsVXRRRkE9

* @author rdgmus
* @filesource
*/

include "functions/MySqlFunctionsClass.php";

$mySqlFunctions = new MySqlFunctionsClass();


//http://192.168.0.215/PhpMySqlAndroid/sendNewPasswordToUser.php?email=&password=


//INOLTRA RICHIESTA INSERENDO UN RECORD NELLA TABELLA change_password_request
if (NULL != filter_input(INPUT_GET, 'email')) {
  $email = filter_input(INPUT_GET, 'email');
}else{
  echo (int) 0;
}

if (NULL != filter_input(INPUT_GET, 'password')) {
  $password = filter_input(INPUT_GET, 'password');
}else{
  echo (int) 0;
}


echo sendNewPasswordToUserWithEmail($email, $password);

function sendNewPasswordToUserWithEmail($email, $password) {
  //INVIA EMAIL PER RICHIESTA CONFERMA
  $from = 'rdgmus@live.com';
  $to = $email;
  $subject = 'Le inviamo la nuova password!';
  $message_content = '<h2>Le inviamo la nuova password!</h2><br>' .
  "Le sue nuove credenziali sono:\n" .
  "<h1>Email: </h1><h2>".$email."</h2>\n" .
  "<h1>Password: </h1><h2>".$password."</h2>\n" .
  "Cordiali Saluti <br> Admin - RegistroAndroid <br>";
  //Assigning a picture for {logo} replacement
  $logo = "images/cbasso1.png";
  //INVIA IL MESSAGGIO CON LE NUOVE CREDENZIALI ALL'UTENTE
  include_once 'phpmailer-with-templates/phpmailer-config.php';
  $status = send_message($from, $to, $subject, $message_content, $logo);
  if ($status) {//EMAIL INVIATA
    return (int) 1;
  }
  return (int) 0;
}




?>
