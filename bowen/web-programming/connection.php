<?php
  try {
    $dbh = new PDO("sqlite:./data.sq3");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOEXCEPTION $e) {
    echo $e->getMessage();
  }
  echo "connected to sqlite DB\r\n";
?>
