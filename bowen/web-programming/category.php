<?php
  $prod_name = $_POST["name"];

  # TODO：把信息写入到sqlite3里，得到返回的pid



  require_once "connection.php";

  $q = "select * from categories;";
  echo "<br>";
  foreach($dbh->query($q) as $row) {
    print $row["catid"] . "\t";
    print $row["name"] . "</br>";
  }
?>
