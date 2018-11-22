<?php
  // $prod_name = $_POST["name"];
  // $prod_price = $_POST["price"];
  // $prod_desc = $_POST["description"];
  // $prod_file = $_POST["file"];
  // $file_path = "img/";

  $prod_name = "xiaobing";
  $prod_price = 9.9;
  $prod_desc = "desc";
  $catid = 1;
  // $prod_file = $_POST["file"];
  // $file_path = "img/";

  require_once "connection.php";

  # TODO：把信息写入到sqlite3里，得到返回的pid
  try{
    $qry = $dbh->prepare(
      'INSERT INTO products (name, price, description, catid) VALUES (?, ?, ?, ?)');
    $qry->execute(array($prod_name, $prod_price, $prod_desc, $catid));
 }catch(PDOEXCEPTION $e) {
    echo $e->getMessage();
  }

  # TODO: 给图片文件改名：id.jpg，存到服务器里



  

  $q = "select * from products;";
  echo "<br>";
  foreach($dbh->query($q) as $row) {
    print $row["pid"] . "\t";
    print $row["name"] . "\t";
    print $row["catid"] . "\t";
    print $row["price"] . "\t";
    print $row["description"] . "</br>";
  }
?>
