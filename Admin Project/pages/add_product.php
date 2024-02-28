<?php
require_once("../includes/db_connection.php")
  ?>

<div class="main_content">
  <div class="form-body container" style="width: 80%; margin:0 auto">
    <h4>Add Product</h4>
    <form id="addProduct" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Product Name:</label>
        <input class="form-control" name="product_name" type="text" placeholder="Enter Customer Name">
      </div>
      <div class="form-group">
        <label for="">Brand:</label>
        <select class="form-control" name="product_brand" id="">
          <option value="">Select</option>
          <?php
          $sql = "SELECT * from brands ORDER BY brand_id ASC";
          $query = $con->query($sql);
          while ($data = $query->fetch_assoc()) {
            ?>
            <option value="<?= $data['brand_id'] ?>"><?= $data['brand_name'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Select Category:</label>
        <select class="form-control" name="product_category">
          <option selected> Select Category</option>
          <?php
          $sql = "SELECT * FROM categories ORDER BY category_id ASC";
          $query = $con->query($sql);
          while ($data = $query->fetch_assoc()) {
            ?>
            <option value="<?= $data['category_id'] ?>"><?= $data['category_name'] ?></option>
          <?php } ?>

        </select>
      </div>
      <div class="form-group">
        <label for="">Select Sub Category:</label>
        <select class="form-control" name="product_sub_category" id="">
          <option selected disabled>Select Sub Category</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Unit:</label>
        <select class="form-control" name="product_unit" id="">
          <option value="">Select Unit</option>
          <?php
          $sql = "SELECT * FROM units";
          $query = $con->query($sql);
          while ($data = $query->fetch_assoc()) {
            ?>
            <option value="<?= $data["unit_id"] ?>"><?= $data["unit_name"] ?></option>

          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">SKU:</label>
        <input class="form-control" name="product_sku" type="number" placeholder="Enter Product SKU">
      </div>
      <div class="form-group">
        <label for="">Product Price:</label>
        <input class="form-control" name="product_price" type="number" placeholder="Enter Product Selling Price">
      </div>
      <div class="form-group">
        <label for="">Product Buying Price:</label>
        <input class="form-control" name="buying_price" type="number" placeholder="Enter Product Buying Price">
      </div>
      <div class="form-group">
        <label for="">Product Image:</label>
        <input class="form-control" name="product_image" type="file">
      </div>
      <div class="form-group">
        <label for="">Description:</label>
        <textarea class="form-control" placeholder="Enter Product Description" name="product_desc" cols=""
          rows="4"></textarea>
      </div>
      <br>
      <input type="hidden" name="addProduct">
      <input type="submit" class="mybtn-hightlight btn">
    </form>
    <div id="response"></div>
  </div>
</div>