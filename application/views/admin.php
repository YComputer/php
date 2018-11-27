<div class="content-wrapper">
	<div class="alert alert-success alert-dismissible" style="position:fixed;top:0;right:0;z-index:99" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Successful operation !</strong>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1>Create /
					<a href="home"> home </a>
				</h1>
			</div>
			<!-- The product CREATE section -->
			<div class="col-md-6">
				<h3> Create a product </h3>
				<form id="add-product">
					<div class="form-group">
						<label>Product Name</label>

						<input id="prod_name" type="text" class="form-control" name="name" pattern="^[\w\- ]+$" required="true" >
					</div>
					<div class="form-group">
						<label>Product Price</label>
						<input id="prod_price" type="number" class="form-control" name="price" pattern="\d+(\.\d{1,2})" required="true">
					</div>
					<div class="form-group">
						<label>Product Catgory</label>
						<select class="form-control" id="prod_catid" name="catid">
							<!-- <option value="1">test</option>
							<option value="2" selected="true">placeholder</option> -->
							<?php
                                if($data['catgory']){
                                    foreach($data['catgory'] as $row) {
                                        $cat_id = $row->catid;
                                        $cat_name = $row->name;
                                        echo 
                                        '
                                        <option value="'. $cat_id .'">'. $cat_name .'</option>
                                        ';
                                    }
                                }
                            ?>
						</select>
					</div>
					<div class="form-group">
						<label>Product Details</label>
						<textarea id="prod_desc" class="form-control" name="description" required="true"></textarea>
					</div>
					<div class="form-group">
						<label for="prod_name">Image *</label>
						<input type="file" name="file" class="form-control-file" id="prod_img" accept="image/jpeg" required="true">
					</div>
					<button type="button" class="btn btn-primary btn-product" name="reg_prod" value="Submit">Submit</button>
				</form>
			</div>
			<!-- /.col-md-4 -->
			<!-- The Category CREATE section -->
			<div class="col-md-6">
				<h3> Create a category </h3>
				<form id="add-category">
					<div class="form-group">
						<label>Category Name</label>
						<input id="cat_name" type="text" class="form-control" name="cat_name" pattern="^[\w\- ]+$" required>
					</div>
					<button type="button" class="btn btn-primary btn-category" name="reg_prod" value="Submit">Submit</button>
				</form>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid-->
</div>

<div id="show-table">
	<div class="product-table col-md-6">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>pid</th>
					<th>name</th>
					<th>price</th>
					<th>catid</th>
					<th>details</th>
					<th>operate</th>
				</tr>
			</thead>
			<tbody class="product-tbody">
				<?php
                    if($data['products']){
                        foreach($data['products'] as $row) {
                            $prod_id = $row->pid;
                            $prod_name = $row->name;
                            $prod_price = $row->price;
                            $prod_catgory = $row->catid;
                            $prod_desc = $row->description;
                            echo 
                            '
                            <tr>
                                <td>' . $prod_id . '</td>
                                <td>' . $prod_name . '</td>
                                <td>' . $prod_price . '</td>
                                <td>' . $prod_catgory . '</td>
                                <td>' . $prod_desc .'</td>
                                <td><a data-id="'. $prod_id .'" href="javascript:;">修改</a> | <a data-id="'. $prod_id .'" class="delete-products" href="javascript:;">删除</a></td>
                            </tr>
                            ';
                        }
                    }
                ?>
			</tbody>
		</table>
	</div>
	<div class="category-table col-md-6">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>catid</th>
					<th>name</th>
					<th>operate</th>
				</tr>
			</thead>
			<tbody class="category-tbody">
				<?php
                if($data['catgory']){
                    foreach($data['catgory'] as $row) {
                        $cat_id = $row->catid;
                        $cat_name = $row->name;
                        echo 
                        '
                        <tr>
                            <td>' . $cat_id . '</td>
                            <td>' . $cat_name . '</td>
                            <td><a class="update-category" data-id="'. $cat_id .'" href="javascript:;">修改</a> | <a data-id="'. $cat_id .'" class="delete-category" href="javascript:;">删除</a></td>
                        </tr>
                        ';
                    }
                }
            ?>
			</tbody>

		</table>
		
	</div>
</div>

<!-- /.content-wrapper-->
<footer class="sticky-footer">
	<div class="container">
		<div class="text-center">
			<small>Copyright © Bowen's Website 2018</small>
		</div>
	</div>
</footer>

<script>
	var admin = {
		init: function() {
			// $('.alert-success').hide();
			this.addProduct();
            this.deleteProduct();

			this.addCategory();//添加类别
			this.deleteCategory();
			this.selectCategory(); //获取详情
		},
		addProduct: function() {
			$('#add-product').on('click', '.btn-primary', function() {
				var formValue = $('#add-product').serializeArray();
				var values = {};
				for (x in formValue) {
					if (formValue[x].value) {
						values[formValue[x].name] = formValue[x].value;
					} else {
						alert(formValue[x].name + ' is required')
						return false;
					}

				}
				if (!$('#add-product').find('input[name="file"]').val()) {
					alert('Image is required')
					return false;
				} else {
					values.file = 'demo.jpg';
				}
				// 以上是验证
				$.ajax({
					type: "post",
					data: values,
					url: "./ProductAPI/AddProduct",
					dataType: 'json',
					beforeSend: function() {
						console.log('正在请求')
					},
					success: function(data) {
						window.location.reload();
					},
					error: function() {
						alert("ajax error");
					}
				});
			})
		},
        deleteProduct: function(){
			$('#show-table').on('click', '.delete-products', function() {
				if(!confirm('确定删除？')){
					return;
				}
				$.ajax({
					type: "post",
					data: {
						productid: $(this).attr('data-id')
					},
					url: "./ProductAPI/DeleteProduct",
					dataType: 'json',
					beforeSend: function() {
						console.log('正在请求')
					},
					success: function(data) {
						window.location.reload();
					},
					error: function() {
						alert("ajax error");
					}
				});
			})
        },

		addCategory: function(){
			$('#add-category').on('click', '.btn-primary', function() {
				var formValue = $('#add-category').serializeArray();
				var values = {};
				for (x in formValue) {
					if (formValue[x].value) {
						values[formValue[x].name] = formValue[x].value;
					} else {
						alert(formValue[x].name + ' is required')
						return false;
					}
				}
				if($(this).attr('data-id')){
					// alert('修改',$(this).attr('data-id'))
					values.catid = $(this).attr('data-id');
					$.ajax({
						type: "post",
						data: values,
						url: "./Category/UpdateCategory",
						dataType: 'json',
						beforeSend: function() {
							console.log('正在请求')
						},
						success: function(data) {
							// console.log('请求成功')
							window.location.reload();
						},
						error: function() {
							alert("ajax error");
						}
					});
				}else {
					$.ajax({
						type: "post",
						data: values,
						url: "./Category/AddCategory",
						dataType: 'json',
						beforeSend: function() {
							console.log('正在请求')
						},
						success: function(data) {
							// console.log('请求成功')
							window.location.reload();
						},
						error: function() {
							alert("ajax error");
						}
					});
				}
			})
		},

		deleteCategory: function(){
			$('#show-table').on('click', '.delete-category', function() {
				if(!confirm('确定删除？')){
					return;
				}
				$.ajax({
					type: "post",
					data: {
						catid: $(this).attr('data-id')
					},
					url: "./Category/DeleteCategory",
					dataType: 'json',
					beforeSend: function() {
						console.log('正在请求')
					},
					success: function(data) {
						window.location.reload();
					},
					error: function() {
						alert("ajax error");
					}
				});
			})
		},

		selectCategory: function(){// 查详情
			$('#show-table').on('click', '.update-category', function() {
				
				// 
				$.ajax({
					type: "post",
					data: {
						catid: $(this).attr('data-id')
					},
					url: "./Category/SelectCategory",
					dataType: 'json',
					beforeSend: function() {
						console.log('正在请求')
					},
					success: function(data) {
						$('input[name="cat_name"]').val(data.name);
						$('.btn-category').attr('data-id',data.catid);
						$('.btn-category').html('reSubmit');
					},
					error: function() {
						alert("ajax error");
					}
				});
			})
		}
	}

	admin.init()
</script>

<!-- Scroll to Top Button-->
<!-- <a class="scroll-to-top rounded" href="#page-top">
	<i class="fa fa-angle-up"></i>
</a> -->
<!-- </fieldset> -->