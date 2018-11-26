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
              <!-- 渲染 -->
              <div class="shopping-car"> </div>
              <!-- end -->
              <button class="btn-info checkout col-sm-6">Checkout</button>
              <p class="col-sm-2">total:$<span class="total-product">13123</span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row container-fluid product-container">
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
                $prod_id = $row->pid;
                $prod_name = $row->name;
                $prod_price = $row->price;
                $prod_desc = $row->description;
                echo
                '<div class="col-lg-4 col-md-4 col-sm-6">
                  <a href="item">
                    <img class="img-thumbnail" src="public/imgs/ps4-thumb.jpg" alt="PS4" width="240" height="240">
                    <p>' . $prod_name . '</p>
                  </a>
                  <div class="item-info">
                    <div class="item-price">$' . $prod_price . '</div>
                    <div class="item-add">
                      <button class="btn-info add-product" data-id="' . $prod_id . '">Add to Cart </button>
                    </div>
                  </div>
                </div>';
              }
            }
          ?>

          <!-- <button class="btn-info checkout" id="product_id_1">Get product detail via ajax</button> -->

          </div>
        </div>
      </div>
    </div>

    <script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
    <script>

      var home = {
        init:function(){
          this.addProduct();//点击添加购物车
          this.getShoppingCarData();//获取购物车数据
          this.changeProductNum();//购物车输入框改变
        },
        data:{
          // productList:[]
        },
        addProduct:function(){
          var that = this;
          $('.product-container').on('click','.add-product',function(){
              $.ajax({
                  type:"post",
                  data:{productid:$(this).attr('data-id')},
                  url:"./ProductAPI/ProductDetail",
                  dataType:'json',
                  success: function(data){
                    that.setShoppingCar(data);
                  },
                  error: function() {
                    alert("ajax error");
                  }
              });
          })
        },

        setShoppingCar:function(data){ //在 addProduct 中调用
          var arr = JSON.parse(localStorage.getItem("shopCar")) || [];
          var obj = {
            name: data.name,
            num: 1,
            pid: data.pid,
            price: data.price,
          }
          // 有重复的，num+1;否则扔进arr最后
          function findProd(prod) { 
              return prod.pid == data.pid;
          }
          if(arr.find(findProd)){
            arr.find(findProd).num++;
          }else {
            arr.push(obj);
          }
          localStorage.setItem("shopCar",JSON.stringify(arr))
          this.showShoppingCar(arr);
        },

        getShoppingCarData:function(){// 刷新页面 调用
          var shopingList = JSON.parse(localStorage.getItem("shopCar")) || [];
          this.showShoppingCar(shopingList);
        },

        showShoppingCar:function(data){// getShoppingCarData调用 + setShoppingCar调用
          if(data.length){
            $('.shopping-car').html('');
          }else {
            $('.shopping-car').html('nothing...');
          }
          
          var total = 0;
          data.forEach(function(item){
            total += Number(item.price)*(item.num);
            var shopHtml = `<p data-id="${item.pid}">
                  <a href="item">${item.name}</a>
                  <input style="min-width:50px" class="product-num" value="${item.num}" type="number" min="1" max="100"></input>
                  <span class="price"> $${item.price}</span>
                </p>`
            $('.shopping-car').append($(shopHtml))
          })
          $('.total-product').html(total);
        },

        changeProductNum(){//改变写到locastorage中
          $('.shopping-car').on('input','.product-num',function(){
            // if($(this).val() > 100){

            //   return
            // }
            var id = $(this).parent().attr('data-id');
            var num = $(this).val() || 0;
            var arr = JSON.parse(localStorage.getItem("shopCar")) || [];
            function findProd(prod) { 
              return prod.pid == id;
            }
            if(arr.find(findProd)){
              arr.find(findProd).num = num;
            }
            localStorage.setItem("shopCar",JSON.stringify(arr))

            //动态改价格
            var total = 0;
            arr.forEach(function(item){
              total += Number(item.price)*(item.num);
            })
            $('.total-product').html(total);


          })

        }
      }
      

      home.init();

          </script>
  </body>
</html>

