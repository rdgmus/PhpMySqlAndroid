PhpMySqlAndroid
===============

>##Interfaccia Php per comunicazione Android &lt;=> MySQL server tramite XAMPP
Si occupa dell'interfaccia tra RegistroAndroid e MySQL: alcune operazioni vengono svolte richiamando da Android funzioni nei presenti file php, i quali ritornano le informazioni richieste accedendo a MySQL.
Questa interfaccia è necessaria per la consistenza dei dati negli accessi al database da ```RegistroAndroid``` oppure da ```PhpRegistroWeb-1.0```

##[mySqlAndroidTest.php](mySqlAndroidTest.php)
>#Test della connessione tra:
###```RegistroAndroid``` e ```PhpRegistroWeb-1.0```

##[phpEncoder.php](phpEncoder.php)
>#Operazioni di encode/decode:
###```encodePassword```
###```generatePassword```
###```generateHash```
###```requestConfirmEmail```

##[requestConfirmEmail.php](requestConfirmEmail.php)
>#``` <body/> ``` email di richiesta conferma iscrizione:
Costruisce il body dell'email che il sistema invia all'utente che si &egrave; appena iscritto al Registro Scolastico utilizzando le informazioni inviategli da RegistroAndroid.
Ritorna il ``` <body/> ```a RegistroAndroid che lo invia nell'email, all'utente, per richiedere la conferma dell'indirizzo email che ha fornito al momento dell'iscrizione.
In questa email c'&egrave; un link che una volta richiamato (cliccato), re-indirizza l'utente che ha ricevuto l'email alla pagina ```userConfirmEmail.php```
In questa stessa pagina, oltre i dati dell'utente (cognome, nome, email) viene inserito un hash che &egrave; lo stesso registrato nel database e che serve come elemento di confronto e conferma delle sue generalit&agrave;.

##[userConfirmEmail.php](userConfirmEmail.php)
>#Pagina per la conferma dell'Email d'Iscrizione:

Questa pagina, richiamata dal link inviato all'utente con la email di richiesta conferma, riceve i dati necessari a fare un check con il database, per riconoscere l'utente e poi:
1. Controllare se la richiesta &egrave; arrivata oltre le 24 ore:

```php
$datetime1 = new DateTime();
$datetime2 = new DateTime($row['register_date']);
$interval =  date_diff($datetime2, $datetime1);
```

se la differenza di data tra la data di iscrizione e quella del momento della richiesta supera le 24 ore, il record di iscrizione viene cancellato fisicamente e comunicato nella risposta, nella pagina stessa, all'utente, il quale dovrà provvedere ad una nuova iscrizione.

```php
$result = mysql_query("DELETE FROM `utenti_scuola` WHERE `id_utente`=".$id_utente);
```
2. Se la richiesta &egrave; nel tempo consentito, (le 24 ore), allora viene abilitato l'account del'utente togliendo il blocco e confermando la email; ci&ograve; consiste nel porre `email_confirmed`= 1 e `is_locked` = 0

```php
$result = mysql_query("UPDATE `utenti_scuola` SET `email_confirmed`=1,
`is_locked` = 0 WHERE `id_utente` =".
$id_utente);
```
