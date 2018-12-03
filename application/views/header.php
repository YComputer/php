<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row page-header" >
    <h1 class="col-md-4">Phase 1</h1>
    <div class="col-md-2 col-sm-3" style="border:1px solid #ccc; padding:20px 0; border-radius:10px; text-align:center">
      <?php
					if($data){
            echo 
            '
              <p>' . $data['email'] . '</p>
              <button type="button" class="logOut">signOut</button>
            ';
          } else {
            echo 
            '
              <p>guest</p>
              <button type="button" class="logIn">logIn</button>
              <button type="button" class="logIn">signUp</button>
            ';
          }
				?>
    </div>
    <div class="col-md-6 col-sm-9">
        <div class="dropdown col-sm-offset-7 col-md-3 col-md-offset-4">
        <button class="btn-default">Shopping Cart</button>
        <div class="dropdown-content">
            <!-- 渲染 -->
            <div class="shopping-car"> </div>
            <!-- end -->
            <button class="btn-info checkout col-sm-6">Checkout</button>
            <p class="col-sm-2">total:$<span class="total-product">0</span></p>
        </div>
        </div>
    </div>
</div>
<script>
    var header = {
        init:function(){
            this.getShoppingCarData();
            this.changeProductNum();
            this.logOut();
            this.logIn();
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
        
    }
    header.init();
</script>