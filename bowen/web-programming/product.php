<?php

  require_once "connection.php";

  $prod_name = $_POST["name"];
  $prod_price = $_POST["price"];
  $prod_desc = $_POST["description"];
  $prod_catid = $_POST["catid"];
  $prod_file = $_POST["file"];
  $file_path = "img/";

  # TODO：把信息写入到sqlite3里，得到返回的pid

  // try{
  //   $name = "testname";
  //   $qry = $dbh->prepare('INSERT INTO PRODUCTS (name, price, description, catid) VALUES (?, ?, ?, ?)');
  //   echo '====';
  //   $qry->execute(array($prod_name, $prod_price, $prod_desc, $prod_catid));
  // }catch(PDOEXCEPTION $e) {
  //   echo $e->getMessage();
  // }
  // echo '------';
  // $row = [
  //   'name' => 'testname1',
  //   'price' => 9.9,
  //   'description' => 'desc',
  //   'catid' => 1
  // ];
  // $sql = "INSERT INTO products SET name=:name, price=:price, description=:description, catid=:catid;";
  // try{
  //   $status = $pdo->prepare($sql)->execute($row);
  // }catch(PDOEXCEPTION $e) {
  //     echo $e->getMessage();
  // }
  // echo("<script>console.log(".json_encode($status).");</script>");
  // if ($status) {
  //     $lastId = $dbh->lastInsertId();
  //     echo $lastId;
  // }
  // echo '====';
  // $sql = "INSERT INTO categories SET name=:name;";
  // echo '-=-=-=';
  // echo("<script>console.log(".json_encode($sql).");</script>");
  // $status = $dbh->prepare($sql)->execute($row);
  // echo("<script>console.log(".json_encode($status).");</script>");

  // if ($status) {
  //   $lastId = $dbh->lastInsertId();
  //   echo $lastId;
  // }

  # TODO: 给图片文件改名：id.jpg，存到服务器里

  $q = "select * from products;";
  echo "<br>";
   try{
  foreach($dbh->query($q) as $row) {
    print $row["pid"] . "\t";
    print $row["name"] . "\t";
    print $row["catid"] . "\t";
    print $row["price"] . "\t";
    print $row["description"] . "</br>";
  }
 }catch(PDOEXCEPTION $e) {
    echo $e->getMessage();
  }
?>
