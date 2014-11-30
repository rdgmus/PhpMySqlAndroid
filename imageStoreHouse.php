<?php
//http://192.168.0.215/PhpMySqlAndroid/imageStoreHouse.php?table=ruoli_utenti&field=img64&img=admin64.png&id_ruolo=1
if (NULL != filter_input(INPUT_GET, 'table')) {
  $table = filter_input(INPUT_GET, 'table');

  if (NULL != filter_input(INPUT_GET, 'field')) {
    $field = filter_input(INPUT_GET, 'field');

    if (NULL != filter_input(INPUT_GET, 'img')) {
      $img = filter_input(INPUT_GET, 'img');

      if (NULL != filter_input(INPUT_GET, 'id_ruolo')) {
        $id_ruolo = filter_input(INPUT_GET, 'id_ruolo');


        # connect to the MySQL database
        $link = mysql_connect("localhost","root","myzconun");
        mysql_select_db("scuola");

        # add the image to the MySQL database
        $image_to_import = '/Users/Shared/images/'.$img;
        $handle = fopen($image_to_import, 'r');
        $file_content = fread($handle, filesize($image_to_import));
        fclose($handle);
        $encoded = chunk_split(base64_encode($file_content));

        $query = "UPDATE ".$table." SET ".$field." = '$encoded' WHERE id_ruolo = ".$id_ruolo;

        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        echo "Image has been inserted successfully\n";


        if(NULL != filter_input(INPUT_GET, 'new_img')){
          # now read the image out of the database and save it to a new file
          $query = "SELECT ".$field." FROM ".$table." WHERE id_ruolo = ".$id_ruolo;

          $result = mysql_query($query) or die('Query failed: ' . mysql_error());

          # fetch the first row, (there is only one row since we selected on a single image_id)
          $result_data_array = mysql_fetch_array($result,MYSQL_BOTH);
          $file_data = $result_data_array[ 0 ];
          $decoded_file_data = base64_decode($file_data);

          # create a new (identical) image file
          $new_img = filter_input(INPUT_GET, 'new_img');
          $new_exported_image = '/Users/Shared/images/'.$new_img;

          $new_handle = fopen($new_exported_image, 'w') or die("Can't create file");
          fwrite($new_handle, $decoded_file_data);
          echo "Image data has been read from the database and a new file created\n";
          fclose($new_handle);
        }

        # close the database connection
        mysql_close($link);

      }else{
        echo "Nessun ruolo fornito!";
      }


    }else{
      echo "Nessuna immagine fornita!";
    }
  }else{
    echo "Nome campo non specificato!";
  }
}else{
  echo "Nome tabella non specificato!";
}
  ?>
