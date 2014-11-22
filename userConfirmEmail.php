<?php
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



/**
* ConfirmEmail
*
*/
function ConfirmEmail($cognome, $nome, $email, $hash){
  if(
  mysql_connect("localhost","root","myzconun")){
    mysql_select_db("scuola");

    $sql = mysql_query("SELECT `id_utente`, `cognome`, `nome`, `email`, `password`, `hash`,
    `register_date`, `user_is_admin`, `has_to_change_password`, `is_locked`, `email_confirmed`
    FROM `utenti_scuola`
    WHERE `cognome` = '".$cognome."'
    AND `nome` = '".$nome."'
    AND `email` = '".$email."'
    AND `hash` = '".$hash."'
    AND `is_locked` = 1
    AND `email_confirmed` = 0
    ");


      $row=mysql_fetch_assoc($sql);//ONLY ONE ROW
      //echo "ROW:".print_r($row);
      $id_utente = $row['id_utente'];
      //CONTROLLA SE E? PASSATO PIU' DI UN GIORNO
      //DATEDIFF(register_date, NOW())
      if($id_utente > 0){
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($row['register_date']);
        $interval =  date_diff($datetime2, $datetime1);


        if($interval->format('%R%a') >= 1){//SE TRASCORSO PIU' DI UN GIORNO
          //echo $interval->format('%R%a days');
          $result = mysql_query("DELETE FROM `utenti_scuola` WHERE `id_utente`=".
          $id_utente);
          mysql_close();
          return FALSE;

        }

        $result = mysql_query("UPDATE `utenti_scuola` SET `email_confirmed`=1, 
        `is_locked` = 0 WHERE `id_utente` =".
        $id_utente);
        if($result){
          mysql_close();
          return TRUE;
        }

      }
  }

  return FALSE;
}
?>
<html>
<head>
  <title>Ricezione della Conferma Iscrizione</title>
  <link href="css/PhpRegistroWeb.css" rel="stylesheet">
</head>

<body>
  <table border="1" id="mailToUserTable" align="center">
    <tr>
      <th colspan="4"  align="center">
        <h1>Key Orchestra - RegistroAndroid </h1>
      </th>
    </tr>
    <tr>
      <td align="center">
        <h1>Conferma email per iscrizione al Registro Scolastico</h1>
      </td>
    </tr>
    <?php
    if(ConfirmEmail($cognome, $nome, $email, $hash)==TRUE){
      ?>
      <tr>
        <td align="center">
          <h2>
            E' stata confermata l'iscrizione a RegistroAndroid per:</h2>
            <h1><?php echo strtoupper($cognome).' '.strtoupper($nome)?></h1>
            <h1><?php echo '['.$email.']' ?></h1>
            <h2>
              Non ha ancora alcun ruolo accreditato.</br>
              Il ruolo le verr&agrave; notificato</br>
              e solo allora potr&agrave; accedere
              al suo account.</br>
              Grazie della sua iscrizione!
            </h2>
            <?php echo $hash?>
          </td>
        </tr>

        <?php
      }else{
        ?>
        <tr>
          <td align="center">
            <h2>
              Non &egrave; stato possibile confermare l'iscrizione al RegistroAndroid!</h2>
              <h1><?php echo strtoupper($cognome).' '.strtoupper($nome)?></h1>
              <h1><?php echo '['.$email.']' ?></h1>
              <h2>
                La sua iscrizione &egrave; stata cancellata!
              </h2>
              <h2>
                Oppure gi&agrave; confermata e in attesa del Ruolo.
               </h2>
              <?php echo $hash?>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>
    </body>
    </html>
