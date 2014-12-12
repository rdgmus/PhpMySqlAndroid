<?php


/**
* LogEventsRegisterInterface raggruppa tutte le funzioni rivolte
* alla registrazione di eventi di LOG nel database
*
* @author rdgmus
* @filesource
*/
//http://192.168.0.215/PhpMySqlAndroid/LogEventsRegisterInterface.php?action=LOGIN_SUCCESS&user_email=&password=
//http://192.168.0.215/PhpMySqlAndroid/LogEventsRegisterInterface.php?action=LOGIN_FAILURE&user_email=&password=

include "functions/MySqlFunctionsClass.php";

$mySqlFunctions = new MySqlFunctionsClass();

if (NULL != filter_input(INPUT_GET, 'action')) {
  $action = filter_input(INPUT_GET, 'action');

  if($action == "LOGOUT"){
    if (NULL != filter_input(INPUT_GET, 'user_email')) {
      $user_email = filter_input(INPUT_GET, 'user_email');
    }else{
      echo (int) 0;
      exit();
    }
    if (NULL != filter_input(INPUT_GET, 'password')) {
      $password = filter_input(INPUT_GET, 'password');
    }else{
      echo (int) 0;
      exit();
    }


    $esito =  $mySqlFunctions->registerLogEvent('LOGOUT',
    'LOGOUT DA REGISTRO SCOLASTICO', $mySqlFunctions->getUserId($user_email, $password), $_SERVER['REMOTE_ADDR']);

    if($esito){
      echo (int) 1;
      exit();
    }else{
      echo (int) 0;
      exit();
    }
  }
  if($action == "LOGIN_SUCCESS"){
    if (NULL != filter_input(INPUT_GET, 'user_email')) {
      $user_email = filter_input(INPUT_GET, 'user_email');
    }else{
      echo (int) 0;
      exit();
    }
    if (NULL != filter_input(INPUT_GET, 'password')) {
      $password = filter_input(INPUT_GET, 'password');
    }else{
      echo (int) 0;
      exit();
    }


    $esito =  $mySqlFunctions->registerLogEvent('LOGIN_SUCCESS',
    'LOGIN IN REGISTRO SCOLASTICO:SUCCESS', $mySqlFunctions->getUserId($user_email, $password), $_SERVER['REMOTE_ADDR']);

    if($esito){
      echo (int) 1;
      exit();
    }else{
      echo (int) 0;
      exit();
    }
  }
  if($action == "LOGIN_FAILURE"){
    if (NULL != filter_input(INPUT_GET, 'user_email')) {
      $user_email = filter_input(INPUT_GET, 'user_email');
    }else{
      echo (int) 0;
      exit();
    }
    if (NULL != filter_input(INPUT_GET, 'password')) {
      $password = filter_input(INPUT_GET, 'password');
    }else{
      echo (int) 0;
      exit();
    }

            //registerLogEventFailure($msgType, $msgBody, $id_utente, $user_email, $password, $ip)
    $esito =  $mySqlFunctions->registerLogEventFailure("LOGIN_FAILURE", "TENTATIVO DI ACCESSO CON CREDENZIALI ERRATE email=\"" .
    $user_email . "\" password=\"" . $password . "\" DA ip: \"" . $_SERVER['REMOTE_ADDR'] . "\"", NULL, $user_email, $password, $_SERVER['REMOTE_ADDR']);

    if($esito){
      echo (int) 1;
      exit();
    }else{
      echo (int) 0;
      exit();
    }
  }


}



















?>
