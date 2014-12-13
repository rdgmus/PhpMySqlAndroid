<?php
/**
* retrievTableData.php raggruppa tutte le funzioni rivolte
* all'interrogazione del database per caricare i dati di una tabella.
*
*
* @author rdgmus
* @filesource
*/

//URI:
//http://192.168.0.215/PhpMySqlAndroid/retrieveTableData.php?table_name=utenti_scuola&sql=SELECT * FROM utenti_scuola AS a, ruoli_granted_to_utenti AS b WHERE a.id_utente = b.id_utente

if (NULL != filter_input(INPUT_GET, 'table_name')) {//CARICA TUTTI I RECORD TABELLA
  $table_name = filter_input(INPUT_GET, 'table_name');
}
if(NULL != filter_input(INPUT_GET, 'sql')){//ESEGUE QUERY INDICATA
  $sql = filter_input(INPUT_GET, 'sql');
}
if(NULL != filter_input(INPUT_GET, 'where_clause')){//ESEGUE QUERY con WHERE CLAUSE
  $where_clause = filter_input(INPUT_GET, 'where_clause');
}

if(
mysql_connect("localhost","root","myzconun")){
  mysql_select_db("scuola");

  if(isset($sql) && ($sql != "")){
    $results = mysql_query($sql);
  }else if(isset($table_name)){
    if(isset($where_clause)){
      $results = mysql_query("SELECT * FROM ".$table_name." WHERE ".$where_clause);
    }else{
      $results = mysql_query("SELECT * FROM ".$table_name." WHERE 1");
    }
  }

  $num_rows = mysql_num_rows($results);

  if($num_rows > 0){
    while($row=mysql_fetch_assoc($results)){
      $output[]=$row;
    }
    print(json_encode($output));// this will print the output in json
    mysql_close();
  }else{
    print("[{}]");
      mysql_close();
    }
  }else{
    print("[{}]");
    }




    ?>
