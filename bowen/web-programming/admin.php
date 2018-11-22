<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is the admin page for CRUD products and categories">
  <meta name="author" content="Bowen Li">
  <title>admin-page</title>
  <!-- Bootstrap core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <body class="fixed-nav">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1>Create</h1>
          </div>
          <!-- The product CREATE section -->
          <div class="col-md-4">
            <h3> Create a product </h3>
            <form method="post" action="product.php">
              <div class="form-group">
                <label>Product Name</label>
                <input id="prod_name" type="text" class="form-control" name="name" pattern="^[\w\- ]+$" required="true">
              </div>
              <div class="form-group">
                <label>Product Price</label>
                <input id="prod_price" type="text" class="form-control" name="price" pattern="\d+(\.\d{1,2})" required="true">
              </div>
              <div class="form-group">
                <label>Product Catgory</label>
                <select class="form-control" id="prod_catid" name="catid">
                  <option name="1">test</option>
                  <option name="2" selected="true">placeholder</option>
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
              <button type="submit" class="btn btn-primary" name="reg_prod" value="Submit">Submit</button>
            </form>
          </div> <!-- /.col-md-4 -->
          <!-- The Category CREATE section -->
          <div class="col-md-4">
            <h3> Create a category </h3>
            <form method="post" action="category.php">
              <div class="form-group">
                <label>Category Name</label>
                <input id="cat_name" type="text" class="form-control" name="cat_name" pattern="^[\w\- ]+$" required>
              </div>
              <button type="submit" class="btn btn-primary" name="reg_prod" value="Submit">Submit</button>
            </form>
          </div>
        </div> <!-- /.row -->
      </div><!-- /.container-fluid-->
    </div><!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Bowen's Website 2018</small>
        </div>
      </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
  </fieldset>
</body>
</html>
