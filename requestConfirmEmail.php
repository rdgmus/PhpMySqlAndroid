

<html>
<head>
  <title>Richiesta di Conferma Iscrizione</title>
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
    <tr>
      <td>
        <h2  align="center">Lei ha effettuato la registrazione al Registro Scolastico Android!</h2>      </td>
      </tr>
      <tr>
        <td align="center">
          <h2>
            E' stato registrato un nuovo account per:</h2>
            <h1><?php echo strtoupper($cognome).' '.strtoupper($nome)?></h1>
            <h1><?php echo '['.$email.']' ?></h1>
            <h2>
              E' necessario confermare l'email fornita
              per poterle accreditare un ruolo!</br>
              
            </h2>
            <?php echo $hash?>
          </td>
        </tr>
        <tr>
          <td  align="center">
            <h3>Qui trova un link per rispondere e confermare la sua email.</h3>
            <h3>Se non avr&agrave; risposto a questo messaggio entro 24 ore</h3>
            <h3>L'iscrizione verr&agrave; cancellata!</h3>
            <h1><a href="<?php echo $link ?>">
              Conferma Iscrizione a RegistroAndroid</a></h1>
          </td>
        </tr>
      </table>
    </body>
    </html>
