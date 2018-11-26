<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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

        }



    }
    header.init();
</script>