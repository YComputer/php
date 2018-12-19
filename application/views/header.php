<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="pay-loading">
  <div class="loading-spinner"></div>
</div>

<div class="row page-header" >
    <h1 class="col-xs-12 col-sm-4 col-md-3 header-title">SALE</h1>
    <div class="col-xs-12 col-sm-4 col-md-4 header-item-box" >
      <a href="home">HOME</a>
      <a href="admin">ADMIN</a>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2 header-user-info">
      
        <?php
					if($data){
            echo 
            '
              <p>
                <a href="myOrder" class="user-info" data-id=' . $data['userid'] . '>' . $data['email'] . '</a>
              </p>
              <button type="button" class="logOut btn-info">signOut</button>
            ';
          } else {
            echo 
            '
              <p>guest</p>
              <button type="button" class="logIn btn-primary">logIn</button>
              <button type="button" class="logIn btn-success">signUp</button>
            ';
          }
        ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 header-shopping">
        <div class="dropdown">
          <!--  col-sm-offset-7 col-md-12 col-md-offset-4 -->
          <button class="btn-default btn-shopping">Shopping Cart</button>
          <div class="dropdown-content">
              <!-- 渲染 -->
              <div class="shopping-car"></div>
              <!-- end -->
              <?php
                // if($data){
                  echo 
                  '
                    <button class="btn-info checkout col-sm-6">Checkout</button>
                  ';
                // } else {
                //   echo 
                //   '
                //     <button class="btn-info signIn-checkout col-sm-6">Checkout</button>
                //   ';
                // }
              ?>
              <p class="col-sm-2">total:$<span class="total-product">0</span></p>
          </div>
        </div>
    </div>

    <div class="paypal-form" style="display:none">
    </div>
</div>
<script>
    var header = {
        init:function(){
            this.getShoppingCarData();
            this.changeProductNum();
            this.logOut();
            this.logIn();
            this.checkout();
        },
        getShoppingCarData:function(){
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
                  <a href="item?id=${item.pid}">${item.name}</a>
                  <input style="min-width:50px" class="product-num" value="${item.num}" type="number" min="1" max="100"></input>
                  <span class="price"> $${item.price}</span>
                </p>`
            $('.shopping-car').append($(shopHtml))
          })
          $('.total-product').html(total);
        },
        
        changeProductNum(){//改变写到locastorage中
          var that = this;
          $('.shopping-car').on('input','.product-num',function(){
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

        },

        logOut(){
          $('.page-header').on('click', '.logOut', function(){
            $.ajax({
              type: "post",
              data: {},
              url: "./Login/LogOut",
              dataType: 'json',
              success: function(data) {
                // that.setShoppingCar(data);
                if(data.status == 2){
                  alert('logOut');
                  window.location.reload();
                }
              },
              error: function() {
                alert("ajax error");
              }
            });
          })
        },

        logIn(){
          $('.page-header').on('click', '.logIn', function(){
            var url = window.location.href;
            if(url.indexOf('home')>0){
              window.location.href = url.split('home')[0]+'login'
            }else {
              window.location.href = url.split('item')[0]+'login'
            }
          })

        },

        checkout(){
          var that = this;
          // $('.header-shopping').on('click', '.signIn-checkout', function(){
          //   alert('暂未登录')
          // })

          $('.header-shopping').on('click', '.checkout', function(){
            var shopingList = JSON.parse(localStorage.getItem("shopCar")) || [];
            // var userId = $('.header-user-info').find('.user-info').attr('data-id');
            var pidArr = [];
            var qtyArr = [];
            var total = 0;
            shopingList.forEach(function(e,i){
              pidArr.push(e.pid);
              qtyArr.push(e.num);
              total += Number(e.price)*(e.num);
            })
            $.ajax({
              type: "post",
              data: {
                pid: pidArr.join('-'),
                qty: qtyArr.join('-')
              },
              url: "./Orders/CreateOrder",
              dataType: 'json',
              beforeSend: function() {
                $('.pay-loading').show();
                // console.log(123123)
              },

              success: function(response) {
                console.log('-===', response);
                var qty = response.data.qty.split('-');
                var price = response.data.price.split('-');
                console.log(qty, price);
                var total = 0.0;
                if(qty.length == price.length){
                    qty.forEach(function(e, i){
                    total = total + e * price[i];
                  });
                }
                console.log('total',parseFloat(total.toPrecision(12)));
                if(response.status == 2){
                  $('.paypal-form').html(
                  `
                  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="upload" value="1">
                    <input type="hidden" name="business" value="thea-facilitator@163.com">

                    <input type="hidden" name="item_name_1" value=${response.data.pid}>
                    <input type="hidden" name="amount_1" value="${total}">
                    
                    <input class="submit" type="submit" value="PayPal">
                    <input type="hidden" name="return" value="http://47.98.195.42/php/myOrder">
                  </form>
                  `)

                  setTimeout(function(){
                    $('.paypal-form').find('.submit').click();
                  }, 50);

                }
                
              },
              error: function() {
                alert("ajax error!!!!!!!!!!!!!!");
              }
            });
          })
        }
        
    }
    header.init();
</script>