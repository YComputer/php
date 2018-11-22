<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phase 1</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/index.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid">
      <div class="page-header">
        <h1>Phase 1</h1>
        <!--- Drop down shopping list --->
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
            <li class="active"><a href="index.html">All <span class="sr-only">(current)</span></a></li>
            <li><a href="index.html">Headphones</a></li>
            <li><a href="index.html">Game Consoles</a></li>
            <li><a href="index.html">Speakers</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="index.html">Game Console</a></li>
              <li class="breadcrumb-item active" aria-current="page">PS4</li>
            </ol>
          </nav>
          <div class="detail-pic col-sm-6 col-md-6">
            <img src="imgs/ps4-detail.png" class="img-responsive rounded float-left" alt="PS4" max-width=400></img>
          </div>
          <div class="detail-info col-sm-3 col-md-3">
            <h3>Play Station 4</h3>
            <div class="item-info">
              <div class="item-price">$199.99</div>
              <div class="item-add">
                <button class="btn-info">Add to Cart </button>
              </div>
            </div>
            <h4 class="item-desc">Description</h4>
            <p>
              The PlayStation 4 (PS4) is an eighth-generation
              home video game console developed by
              Sony Interactive Entertainment.
            </p>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
