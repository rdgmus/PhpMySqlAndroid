<?php
//URI:
//http://192.168.0.215/PhpMySqlAndroid/phpEncoder.php?actionEncode=encodePassword&password=iw3072ylB

if (NULL != filter_input(INPUT_GET, 'table_name')) {
  $table_name = filter_input(INPUT_GET, 'table_name');

  if(
  mysql_connect("localhost","root","myzconun")){
    mysql_select_db("scuola");

    if(NULL != filter_input(INPUT_GET, 'sql')){
      $sql = filter_input(INPUT_GET, 'sql');
      if($sql == ""){
        $results = mysql_query("SELECT * FROM ".$table_name." WHERE 1");
      }
      else{
        $results = mysql_query($sql);
      }

    }else{
      $results = mysql_query("SELECT * FROM ".$table_name." WHERE 1");
    }

    while($row=mysql_fetch_assoc($results))
    $output[]=$row;
    print(json_encode($output));// this will print the output in json
    mysql_close();
  }else{
    print("[{}]");
    }
  }



  ?>
