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
if (NULL != filter_input(INPUT_GET, 'email')) {//String
  $email = filter_input(INPUT_GET, 'email');
}else{
  echo (int) 0;
}

if (NULL != filter_input(INPUT_GET, 'password')) {//String
  $password = filter_input(INPUT_GET, 'password');
}else{
  echo (int) 0;
}

if (NULL != filter_input(INPUT_GET, 'forHimSelf')) {// Int :Se la password è per te stesso il messaggio è diverso
  $forHimSelf = filter_input(INPUT_GET, 'forHimSelf');
}else{
  $forHimSelf = 0;
}

echo sendNewPasswordToUserWithEmail($email, $password, $forHimSelf);

function sendNewPasswordToUserWithEmail($email, $password, $forHimSelf) {
  //INVIA EMAIL PER RICHIESTA CONFERMA
  $from = 'rdgmus@live.com';
  $to = $email;
  $subject = 'Le inviamo la nuova password!';
  $message_content = '<h2>Le inviamo la nuova password!</h2><br>' .
  "Le sue nuove credenziali sono:\n" .
  "<h1>Email: </h1><h2>".$email."</h2>\n" .
  "<h1>Password: </h1><h2>".$password."</h2>\n\n";
  if($forHimSelf == 0){
    $message_content .=  "<h2>Le ricordiamo che al prossimo LOGIN,\n" .
    "per una maggiore sicurezza del suo account,\n".
    "deve cambiare nuovamente la sua password\n" .
    "accedendo dal suo menu all'opzione 'Password'\n\n";
  }
  $message_content .=  "Cordiali Saluti <br> <h1>Admin - RegistroAndroid</h1> <br>";


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
