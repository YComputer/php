<div class="container-fluid">
	<?php $this->load->view('header',['data' => $data['user']]); ?>
	<div class="row container-fluid product-container">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar cat-nav-sidebar">
				<li class="active">
					<a data-id="-1" href="javascript:;" class="catgory-select">All</a>
				</li>
			<?php
					if($data['catgories']){
						foreach($data['catgories'] as $row) {
							$cat_id = $row->catid;
							$cat_name = $row->name;
							echo
							'
							<li>
								<a data-id="' . $cat_id . '" href="javascript:;" class="catgory-select">' . $cat_name . '</a>
							</li>
							';
						}
					}
				?>
			</ul>
		</div>
		<div class="col-sm-9 col-md-10 main">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item active" aria-current="page">Home</li>
				</ol>
			</nav>
			<div class="row product-box">

				<?php
            if($data['products']){
              foreach($data['products'] as $row) {
                $prod_id = $row->pid;
                $prod_name = $row->name;
                $prod_price = $row->price;
                $prod_desc = $row->description;
                echo
                '<div class="col-lg-4 col-md-4 col-sm-6">
                  <a href="item?id='. $prod_id .'">
                    <img class="img-thumbnail" src="public/imgs/' . $prod_id . '-thumb.jpg" alt="PS4" width="120" height="120">
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
			</div>
		</div>
	</div>
</div>


<script>
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
				// name: data.name,
				num: 1,
				pid: data.pid,
				// price: data.price,
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
			localStorage.setItem("shopCar", JSON.stringify(arr));
			$.ajax({
					type: "post",
					data: {
					list: arr
					},
					url: "./ProductAPI/GetProducts",
					dataType: 'json',
					success: function(data) {
					header.showShoppingCar(data,arr);
					},
					error: function() {
					alert("ajax error");
					}
				});
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
</script>