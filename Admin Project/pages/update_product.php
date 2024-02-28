<?php
require_once("../includes/db_connection.php");
//Retriving for Update from Product_view Table
$id = $_GET['product_id'];
$sql = "SELECT * from product_information WHERE product_id=$id ";
$product_query = $con->query($sql);
$product_data = $product_query->fetch_assoc();

//Retriving Brand List
$sql = "SELECT * FROM brands";
$brand_query = $con->query($sql);


//Retriving Category List
$sql = "SELECT * FROM categories";
$category_query = $con->query($sql);


//Retriving Unit List
$sql = "SELECT * FROM units";
$unit_query = $con->query($sql);

?>

<div class="main_content">
  <div class="form-body container" style="width: 80%; margin:0 auto">
    <h4>Edit Product</h4>
    <form id="addProduct" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Product Name:</label>
        <input class="form-control" name="product_name" type="text" placeholder="Enter Customer Name"
          value="<?= $product_data['product_name'] ?>">
      </div>
      <div class="form-group">
        <label for="">Brand:</label>
        <select class="form-control" name="product_brand" id="">
          <?php
          while ($brand_data = $brand_query->fetch_assoc()) {
            ?>
            <option value="<?= $brand_data['brand_id'] ?>" <?= $brand_data['brand_id'] == $product_data['brand_id'] ? "selected" : "" ?>><?= $brand_data['brand_name'] ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Category:</label>
        <select class="form-control" name="product_category" id="">
          <?php
          while ($category_data = $category_query->fetch_assoc()) {
            ?>
            <option value="<?= $category_data['category_id'] ?>"
              <?= $category_data['category_id'] == $product_data['category_id'] ? "selected" : "" ?>>
              <?= $category_data['category_name'] ?></option>
          <?php } ?>

        </select>
      </div>
      <div class="form-group">
        <label for="">Unit:</label>
        <select class="form-control" name="product_unit" id="">
          <?php
          while ($unit_data = $unit_query->fetch_assoc()) {
            ?>
            <option value="<?= $unit_data["unit_id"] ?>" <?= $unit_data["unit_id"] == $product_data['unit_id'] ? "selected" : "" ?>><?= $unit_data["unit_name"] ?></option>

          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">SKU:</label>
        <input class="form-control" name="product_sku" type="text" placeholder="Enter Product SKU"
          value="<?= $product_data['sku'] ?>">
      </div>
      <div class="form-group">
        <label for="">Price:</label>
        <input class="form-control" name="product_price" type="text" placeholder="Enter Customer Name"
          value="<?= $product_data['selling_price'] ?>">
      </div>
      <div class="form-group">
        <label for="">Product Buying Price:</label>
        <input class="form-control" name="buying_price" type="number" placeholder="Enter Product Buying Price"
          value="<?= $product_data['buying_price'] ?>">
      </div>
      <div class="form-group">
        <label for="">Product Image:</label>
        <?php
        if (!empty($product_data['product_image'])) {
          printf(<<<HTML
          <div><img style="width:150px" src='uploads/images/%s'></div> 
          HTML, $product_data['product_image']);
        }
        ?>

        <input class="form-control" name="product_image" type="file" name="image_name">
      </div>
      <div class="form-group">
        <label for="">Description:</label>
        <textarea class="form-control" placeholder="Enter Customer Name" name="product_desc" id="" cols=""
          rows=""><?= $product_data['description'] ?></textarea>
      </div>
      <br>
      <input type="hidden" name="updateProduct" value="<?= $id ?>">
      <input type="submit" class="mybtn-hightlight btn">
    </form>
    <div id="response"></div>
  </div>
</div>