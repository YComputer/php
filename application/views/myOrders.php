<?php $status = ['代支付','完成'] ?>
<div class="container-fluid">
    <h3>myOrders / <a href="home">home</a></h3>
	<div class="row container-fluid product-container">
		<div class="col-sm-12 col-md-12 main">
			<div class="row product-box">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>pid</th>
                            <th>qty</th>
							<th>userid</th>
                            <th>hash</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody class="orders-tbody">
                        <?php
                        if($data['orders']){
                            foreach($data['orders'] as $row) {
                                $orders_pid = $row->pid;
                                $orders_qty = $row->qty;
                                $orders_userid = $row->userid;
                                $orders_hash = $row->hash;
								$orders_status = $row->status;
								
                                echo 
                                '
                                <tr>
                                    <td>' . $orders_pid . '</td>
									<td>' . $orders_qty . '</td>
									<td>' . $orders_userid . '</td>
                                    <td>' . $orders_hash . '</td>
                                    <td>' . $status[$orders_status] . '</td>
                                </tr>
                                ';
                            }
                        }
                    ?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>


<!-- <script>
	var home = {
		init: function() {
			this.addProduct(); //点击添加购物车
			this.selectCat();
		},
		addProduct: function() {
			var that = this;
			$('.product-container').on('click', '.add-product', function() {
				$.ajax({
					type: "post",
					data: {
						productid: $(this).attr('data-id')
					},
					url: "./ProductAPI/ProductDetail",
					dataType: 'json',
					success: function(data) {
						that.setShoppingCar(data);
					},
					error: function() {
						alert("ajax error");
					}
				});
			})
		},

		setShoppingCar: function(data) { //在 addProduct 中调用
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
			if (arr.find(findProd)) {
				arr.find(findProd).num++;
			} else {
				arr.push(obj);
			}
			localStorage.setItem("shopCar", JSON.stringify(arr))
			header.showShoppingCar(arr);
		},

		selectCat:function(){
			$('.cat-nav-sidebar').on('click','.catgory-select',function(){
				$.ajax({
					type: 'post',
					data: {
						catid: $(this).attr('data-id')
					},
					url:'./ProductAPI/ChangeCatgory',
					dataType: "json",
					success: function(data) {
						// console.log(data.data,'筛选')
						if(data.data.length){
							var html = '';
							data.data.forEach(function(e,i){
								html += `
									<div class="col-lg-4 col-md-4 col-sm-6">
								    <a href="item?id=${e.pid}">
								      <img class="img-thumbnail" src="public/imgs/${e.pid}.jpeg" alt="PS4" width="240" height="240">
								      <p>${e.name}</p>
								    </a>
								    <div class="item-info">
								      <div class="item-price">$${e.price}</div>
								      <div class="item-add">
								        <button class="btn-info add-product" data-id="${e.pid}">Add to Cart </button>
								      </div>
								    </div>
								  </div>
								`
							})
							$('.product-box').html(html);
						}else {// 无数据
							$('.product-box').html(
								`
									<div>
										<p>暂无数据</p>
									</div>
								`)
						}
						// that.setShoppingCar(data);
					},
					error: function() {
						alert("ajax error");
					}
				})
			})
		}
	}


	home.init();
</script> -->