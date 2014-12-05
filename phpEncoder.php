<?php
/**
* FUNZIONI PER LA COMUNICAZIONE MYSQL <=> ANDROID
*
*/
include "functions/MySqlFunctionsClass.php";

$mySqlFunctions = new MySqlFunctionsClass();



if (NULL != filter_input(INPUT_GET, 'actionEncode')) {
  if (filter_input(INPUT_GET, 'actionEncode') == 'encodePassword') {
    //URI:
    //http://192.168.0.215/PhpMySqlAndroid/phpEncoder.php?actionEncode=encodePassword&password=iw3072ylB
    $str = filter_input(INPUT_GET, 'password');
    print base64_encode(base64_encode($str));
  }else
  if (filter_input(INPUT_GET, 'actionEncode') == 'generatePassword') {
    //URI:
    //http://192.168.0.215/PhpMySqlAndroid/phpEncoder.php?actionEncode=generatePassword&length=8
    if (NULL != filter_input(INPUT_GET, 'length')){
      $length = filter_input(INPUT_GET, 'length');
    }else $length = 20;
    $str = $mySqlFunctions->generate_password($length);
    print $str;
  }else
  if (filter_input(INPUT_GET, 'actionEncode') == 'generateHash') {
    //http://192.168.0.215/PhpMySqlAndroid/phpEncoder.php?actionEncode=generateHash
    if (NULL != filter_input(INPUT_GET, 'algo')){
      $algo = filter_input(INPUT_GET, 'algo');
    }else $algo = "md5";
    if (NULL != filter_input(INPUT_GET, 'data')){
      $data = filter_input(INPUT_GET, 'data');
    }else $data = print_r(gettimeofday(true));
    //echo hash(  $algo ,  $data , FALSE  );//TRUE, outputs raw binary data. FALSE outputs lowercase hexits.
    print $mySqlFunctions->generate_hash($data);
  }else
  if (filter_input(INPUT_GET, 'actionEncode') == 'requestConfirmEmail') {
    //http://192.168.0.215/PhpMySqlAndroid/phpEncoder.php?actionLoadHtmlPage=requestConfirmEmail

    //CARICA I PARAMETRI NECESSARI ALLA COMPILAZIONE DEL MODULO
    //E COMUNI A TUTTE LE ACTION:sendEmail, confirmEmail
    if (NULL != filter_input(INPUT_GET, 'ip')) {
      $ip = filter_input(INPUT_GET, 'ip');
    }else $ip='192.168.0.215';

    if (NULL != filter_input(INPUT_GET, 'cognome')) {
      $cognome = filter_input(INPUT_GET, 'cognome');
    }else $cognome='cognome';

    if (NULL != filter_input(INPUT_GET, 'nome')) {
      $nome = filter_input(INPUT_GET, 'nome');
    }else $nome='nome';

    if (NULL != filter_input(INPUT_GET, 'email')) {
      $email = filter_input(INPUT_GET, 'email');
    }else $email='me@work.it';

    if (NULL != filter_input(INPUT_GET, 'hash')) {
      $hash = filter_input(INPUT_GET, 'hash');
    }else $hash='U3kwaGFVZGdObHBJU3lGMFdTWmhiWEE3ZFE9PQ==';

    //BUILD LINK
    $link = $mySqlFunctions->buildLink($ip, $cognome, $nome, $email, $hash);
    //http://192.168.0.215/PhpMySqlAndroid/userConfirmEmail.php?nome=Roberto&cognome=Della%20Grotta&data=11/02/2014
    print include 'requestConfirmEmail.php';

  }
}


?>
