<?php
/**
* FUNZIONI PER LA COMUNICAZIONE MYSQL <=> ANDROID
*
*/
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
    $str = generate_password($length);
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
    print hash (  $algo ,  $data , FALSE  );//TRUE, outputs raw binary data. FALSE outputs lowercase hexits.
  }
}else
if (NULL != filter_input(INPUT_GET, 'actionLoadHtmlPage')) {
  if (filter_input(INPUT_GET, 'actionLoadHtmlPage') == 'requestConfirmEmail') {
    //http://192.168.0.215/PhpMySqlAndroid/phpEncoder.php?actionLoadHtmlPage=requestConfirmEmail
    print include 'html/requestConfirmEmail.html';
    return;
  }
}
/**
*
* Generatore di password di lunghezza definita
* @param unknown_type $length  la lunghezza della password
*/
function generate_password($length = 20) {
  $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' .
  '0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|';
    $str = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++)
    $str .= $chars[mt_rand(0, $max)];
    return ltrim($str);
  }

  ?>
