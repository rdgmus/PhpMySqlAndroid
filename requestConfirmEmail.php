<html>
<head>
  <title>Richiesta di Conferma Iscrizione</title>
  <link href="css/PhpRegistroWeb.css" rel="stylesheet">
</head>
<?php

if (NULL != filter_input(INPUT_GET, 'cognome')) {
    $cognome = filter_input(INPUT_GET, 'cognome');
}

if (NULL != filter_input(INPUT_GET, 'nome')) {
  $nome = filter_input(INPUT_GET, 'nome');
}

if (NULL != filter_input(INPUT_GET, 'data')) {
  $data = filter_input(INPUT_GET, 'data');
}

if (NULL != filter_input(INPUT_GET, 'hash')) {
  $hash = filter_input(INPUT_GET, 'hash');
}
?>

<body>
  <table border="0" id="userMenuTable">
    <tr>
      <td colspan="4"  align="center">
        <img src="images/cbasso1.png" />
      </td>
    </tr>
    <tr>
      <th>
        <h1>Conferma email per iscrizione al Registro Scolastico</h1>
      </th>
    </tr>
    <tr>
      <td>
        <h2  align="center">Lei ha effettuato la registrazione al Registro Scolastico Android!</h2>      </td>
      </tr>
      <tr>
        <td>
          <h2 align="center">a nome di: <?php echo $cognome.' '.$nome ?></h2>
        </td>
      </tr>
      <tr>
        <td>
          <h2  align="center">in data: <?php echo $data ?></h2>
        </td>
      </tr>
      <tr>
        <td  align="center">
          <h3>Qui trova un link per rispondere e confermare la sua email.</h3>
          <h3>Se non avr&agrave; risposto a questo messaggio entro 24 ore</h3>
          <h3>L'iscrizione verr&agrave; cancellata!</h3>
          <h1><a href="<?php echo $link ?>"><?php echo $link ?></a></h1>
        </td>
      </tr>
    </table>
  </body>
  </html>
