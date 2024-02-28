<!-- Product Information Modal -->
<div class="modal fade" id="product_view_modal" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img src="uploads/images/product_1686830292_60952360.jpg" class="img-fluid" alt="Product Image">
          </div>
          <div class="col-md-6">
            <h3>Product Information</h3>
            <table class="table">
              <tr>
                <th>Product ID:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product Name:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product Brand:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product Category:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product Sub Category:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product Unit:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product SKU:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product Price:</th>
                <td>--</td>
              </tr>
              <tr>
                <th>Product Description:</th>
                <td>--</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn mybtn-hightlight" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<div class="table-responsive">
  <table id="product_information_table">
    <thead>
      <tr>
        <th><input type="checkbox" class="select-all"></th>
        <th>ID</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Sub Category</th>
        <th>Unit</th>
        <th>SKU</th>
        <th>Price</th>
        <th>Image</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once("./../includes/authentication.php");
      require_once("../includes/db_connection.php");

      //pagination
      $limit = 13;
      $currentPage = $_GET['page'] ?? 1;

      $countSql = "SELECT COUNT(*) AS TOTAL FROM products";
      $result = $con->query($countSql);
      $totalRows = $result->fetch_assoc()['TOTAL'];
      $totalPage = ceil($totalRows / $limit);
      $offset = ($currentPage - 1) * $limit;

      $sql = "SELECT * FROM product_information WHERE product_status = 1 ORDER BY product_id DESC LIMIT $offset, $limit";
      $query = $con->query($sql);
      while ($data = $query->fetch_assoc()) {

        ?>
        <tr>
          <td><input type="checkbox" class="select"></td>
          <td>
            <?= $data["product_id"] ?>
          </td>
          <td>
            <?= $data["product_name"] ?>
          </td>
          <td>
            <?= $data["brand_name"] ?>
          </td>
          <td>
            <?= $data["category_name"] ?>
          </td>
          <td>
            <?= $data["sub_category_name"] ?>
          </td>
          <td>
            <?= $data["unit_name"] ?>
          </td>
          <td>
            <?= $data["sku"] ?>
          </td>
          <td>
            <?= $data["selling_price"] ?>
          </td>
          <td>
            <?php if (($data['product_image']) != '') { ?>
              <img height="50" src="uploads/images/<?= $data['product_image'] ?>" alt="Photo" />
            <?php } else { ?>
              <img height="50" src="uploads/images/sample-product.jpg" alt="product_image" />
            <?php } ?>
          </td>
          <td>
            <?= $data["description"] ?>
          </td>
          <td>
            <button class=" btn edit-btn view" data-bs-toggle="modal" data-bs-target="#product_view_modal"><i
                class="fa-solid fa-eye"></i></button>
            <?php if ($_SESSION['role_id'] < 2) { ?>
              <a href="pages/update_product.php?product_id=<?= $data["product_id"] ?>" class=" btn edit-btn "><i
                  class="fa-solid fa-pen-to-square"></i></a>
              <a href="formServer.php?product_id=<?= $data["product_id"] ?>" class=" btn delete-btn "><i
                  class="fa-solid fa-trash"></i></a>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>

      <!-- Add more rows for each user -->
    </tbody>
  </table>
</div>

<div class="pagination">
  <a href="pages/all_products.php?page=1">&laquo;</a>
  <a href="pages/all_products.php?page=<?= $currentPage - 1 ?>">&lt;</a>
  <?php
  if ($currentPage > 2) {
    $page = $currentPage - 2;
    $lastPage = $currentPage + 2;
  } else {
    $page = 1;
    $lastPage = 5;
  }
  if ($lastPage >= $totalPage) {
    $lastPage = $totalPage;
  }
  for ($page; $page <= $lastPage; $page++) {
    ?>
    <a href="pages/all_products.php?page=<?= $page ?>" class="<?= $currentPage == $page ? 'active' : '' ?>"><?= $page ?></a>
  <?php } ?>
  <a href="pages/all_products.php?page=<?= $currentPage + 1 ?>">&gt;</a>
  <a href="pages/all_products.php?page=<?= $totalPage ?>">&raquo;</a>
</div>