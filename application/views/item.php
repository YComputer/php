<div class="container-fluid">
	<?php $this->load->view('header'); ?>

	<div class="row container-fluid">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="active">
					<a href="home">All
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li>
					<a href="home">Headphones</a>
				</li>
				<li>
					<a href="home">Game Consoles</a>
				</li>
				<li>
					<a href="home">Speakers</a>
				</li>
			</ul>
		</div>
		<div class="col-sm-9 col-md-10 main">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="home">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="home">Game Console</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">PS4</li>
				</ol>
			</nav>
			<div class="item-product"></div>
		</div>
	</div>
</div>

<script>
	var item = {
		init: function() {
			this.getDetail()
			this.addProduct();
			// this.setShoppingCar()//点击添加购物车
		},
		data: {
			detail: {}
		},
		getDetail: function() {
			var that = this;
			$.ajax({
				type: "post",
				data: {
					productid: that.getQueryVariable('id')
				},
				url: "./ProductAPI/ProductDetail",
				dataType: 'json',
				success: function(data) {
					// that.setShoppingCar(data);
					that.data.detail = data;
					$('.item-product').html(
						`
                <div class="detail-pic col-sm-6 col-md-6">
                  <img src="./public/imgs/ps4-detail.png" class="img-responsive rounded float-left" alt="PS4" max-width=400></img>
                </div>
                <div class="detail-info col-sm-3 col-md-3">
                  <h3>${data.name}</h3>
                  <div class="item-info">
                    <div class="item-price">$${data.price}</div>
                    <div class="item-add">
                      <button class="btn-info add-product" data-id="${data.pid}">Add to Cart </button>
                    </div>
                  </div>
                  <h4 class="item-desc">Description</h4>
                  <p>${data.description}</p>
                </div>
              `
					)
				},
				error: function() {
					alert("ajax error");
				}
			});
		},
		addProduct: function() {
			var that = this;
			$('.item-product').on('click', '.add-product', function() {
				that.setShoppingCar(that.data.detail)
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
		getQueryVariable(variable) {
			var query = window.location.search.substring(1);
			var vars = query.split("&");
			for (var i = 0; i < vars.length; i++) {
				var pair = vars[i].split("=");
				if (pair[0] == variable) {
					return pair[1];
				}
			}
			return (false);
		},


	}

	item.init();
</script>