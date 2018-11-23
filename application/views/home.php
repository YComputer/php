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
            <div class="col-lg-4 col-md-4 col-sm-6">
              <a href="item">
                <img class="img-thumbnail" src="./public/imgs/xone-thumb.jpg" alt="Xbox-one" width="240" height="240">
                <p>Xbox-one</p>
              </a>
              <div class="item-info">
                <div class="item-price">$269.99</div>
                <div class="item-add">
                  <button class="btn-info">Add to Cart </button>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
              <a href="item">
                <img class="img-thumbnail" src="./public/imgs/wii-thumb.jpg" alt="Wii" width="240" height="240">
                <p>Wii</p>
              </a>
              <div class="item-info">
                <div class="item-price">$199.99</div>
                <div class="item-add">
                  <button class="btn-info">Add to Cart </button>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
              <a href="item">
                <img class="img-thumbnail" src="./public/imgs/switch-thumb.jpg" alt="Switch" width="240" height="240">
                <p>Switch</p>
              </a>
              <div class="item-info">
                <div class="item-price">$239.99</div>
                <div class="item-add">
                  <button class="btn-info">Add to Cart </button>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
              <a href="item">
                <img class="img-thumbnail" src="./public/imgs/boseqc30-thumb.jpg" alt="Switch" width="240" height="240">
                <p>Bose QC30</p>
              </a>
              <div class="item-info">
                <div class="item-price">$299.99</div>
                <div class="item-add">
                  <button class="btn-info">Add to Cart </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
  </body>
</html>

