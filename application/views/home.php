<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phase 1</title>
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/index.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid">
      <div class="page-header">
        <h1>Phase 1</h1>
        <div class="row">
          <div class="dropdown col-sm-3 col-sm-offset-9 col-md-3 col-md-offset-9">
            <button class="btn-default">Shopping Cart</button>
            <div class="dropdown-content">
              <p>
                <a href="item.html">PS4</a>
                <input></input>
                <span class="price"> $249.99</span>
              </p>
              <p>
                <a href="item.html">Bose QC30</a>
                <input></input>
                <span class="price"> $299.99</span>
              </p>
              <p>
                <a href="item.html">Switch</a>
                <input></input>
                <span class="price"> $199.99</span>
              </p>
              <button class="btn-info checkout">Checkout</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row container-fluid">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">All <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Headphones</a></li>
            <li><a href="#">Game Consoles</a></li>
            <li><a href="#">Speakers</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
          </nav>
          <div class="row">

          <?php
            if($products){
              foreach($products as $row) {
                $prod_name = $row->name;
                $prod_price = $row->price;
                $prod_desc = $row->description;
                echo
                '<div class="col-lg-4 col-md-4 col-sm-6">
                  <a href="item.php">
                    <img class="img-thumbnail" src="public/imgs/ps4-thumb.jpg" alt="PS4" width="240" height="240">
                    <p>' . $prod_name . '</p>
                  </a>
                  <div class="item-info">
                    <div class="item-price">$' . $prod_price . '</div>
                    <div class="item-add">
                      <button class="btn-info">Add to Cart </button>
                    </div>
                  </div>
                </div>';
              }
            }
          ?>

          <button class="btn-info checkout" id="product_id_1">Get product detail via ajax</button>

          </div>
        </div>
      </div>
    </div>

    <script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
    <script>
            $("#product_id_1").click(function(){
              //post the pictureID to controller and return the picture and embed it to the photoboard.
              $.ajax({
                  type:"post",
                  data:{productid:1}, // data: "id=" + $(this).attr("id"),
                  url:"./ProductAPI/ProductDetail",
                  success: function(data){
                    console.log('ajax data', data);
                  },
                  error: function() {
                    alert("ajax error");
                  }
                  });
            });
          </script>
  </body>
</html>

