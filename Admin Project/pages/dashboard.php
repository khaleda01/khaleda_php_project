<?php
require_once('includes/db_connection.php');
require_once('includes/functions.php');
$formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
$sql = "SELECT COUNT(*) AS total_orders from sales_order";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_orders = $data['total_orders'];

$sql = "SELECT COUNT(*) AS total_products from products";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_products = $data['total_products'];

$sql = "SELECT COUNT(*) AS total_brands from brands";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_brands = $data['total_brands'];

$sql = "SELECT SUM(total_stock) AS total_stocks FROM product_stock_information";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_stocks = $data['total_stocks'];
$total_stocks = intVal($total_stocks);

$sql = "SELECT SUM(total_sold_quantity) AS total_sold FROM product_stock_information";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_sold = $data['total_sold'];
$total_sold = intVal($total_sold);

$sql = "SELECT COUNT(*) AS total_categories from categories";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_categories = $data['total_categories'];

$sql = "SELECT SUM(selling_price * quantity) AS total_sales FROM s_order_product_information";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_sales = $data['total_sales'];
$total_sales = $formatter->formatCurrency($total_sales, 'BDT');

$sql = "SELECT COUNT(*) AS total_sub_categories from sub_categories";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_sub_categories = $data['total_sub_categories'];

$sql = "SELECT COUNT(*) AS total_customers from customers";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_customers = $data['total_customers'];

$sql = "SELECT SUM((selling_price - buying_price) * quantity) AS total_profit FROM s_order_product_information";
$result = $con->query($sql);
$data = $result->fetch_assoc();
$total_profit = $data['total_profit'];


$total_profit = $formatter->formatCurrency($total_profit, 'BDT');


?>


<div class="container">
  <div class="row">
    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-blue order-card">
        <div class="card-block">
          <h6 class="m-b-20">Total Orders</h6>
          <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>
              <?= $total_orders ?>
            </span></h2>
          <p class="m-b-0">Total Profit<span class="f-right">
              <?= $total_profit ?>
            </span></p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-green order-card">
        <div class="card-block">
          <h6 class="m-b-20">Total Products</h6>
          <h2 class="text-right"><i class="fa-solid fa-cart-flatbed-suitcase"></i><span>
              <?= $total_products ?>
            </span></h2>
          <p class="m-b-0">Total Sales<span class="f-right">
              <?= $total_sales ?>
            </span></p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-yellow order-card">
        <div class="card-block">
          <h6 class="m-b-20">Brands</h6>
          <h2 class="text-right"><i class="fa-solid fa-tags"></i><span>
              <?= $total_brands ?>
            </span></h2>
          <p class="m-b-0">All Categories<span class="f-right">
              <?= $total_categories ?>
            </span></p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-pink order-card">
        <div class="card-block">
          <h6 class="m-b-20">Total Stock</h6>
          <h2 class="text-right"><i class="fa-solid fa-cart-flatbed-suitcase"></i><span>
              <?= $total_stocks ?>
            </span></h2>
          <p class="m-b-0">Sold Item<span class="f-right">
              <?= $total_sold ?>
            </span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div>
        <canvas id="reportChart"></canvas>
      </div>
    </div>
    <div class="col-md-4">
      <div>
        <canvas id="reportChart-2"></canvas>
      </div>
    </div>
  </div>
</div>