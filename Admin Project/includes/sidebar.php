<section class="innder_body row">
  <section class="sidebar col-md-4 col-xl-3 col-xxl-2">
    <div class="sidebar_container">
      <div class="user_part">
        <div>
          <img class="img-fluid" src="uploads/images/<?= $_SESSION['user_image'] ?>" alt="avatar" />
        </div>
        <h5>
          <?= $_SESSION['user_name'] ?>
        </h5>
        <h6 style="text-align: center; color: grey; font-size:14px;">
          <?= $_SESSION['role_name'] ?>
        </h6>
        <p><i class="fas fa-circle"></i> Online</p>
      </div>
      <!-- Sidebar Menu Start -->
      <div class="accordion" id="accordionExample">
        <div class="side-body">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <i class="fa-solid fa-user"></i> &nbsp; Customers
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/all_customers.php"><i class="fa-sharp fa-solid fa-users"></i>&nbsp;
                  All Customers</a>
              </div>
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/add_customer.php"><i class="fa-solid fa-user-plus"></i>&nbsp; Add
                  Customers</a>
              </div>
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/restore_customer.php"><i class="fa-solid fa-trash"></i>&nbsp;
                  Restore Customer</a>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-box"></i>&nbsp; Products
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/all_products.php"><i class="fa-solid fa-boxes-stacked"></i>&nbsp;
                  All Products</a>
              </div>
              <?php if ($_SESSION['role_id'] < 2) { ?>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_product.php"><i class="fa-solid fa-box-open"></i>&nbsp; Add
                    Products</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/restore_product.php"><i class="fa-solid fa-trash"></i>&nbsp;
                    Restore Product</a>
                </div>
              <?php } ?>

            </div>
          </div>
          <?php if ($_SESSION['role_id'] < 2) { ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                  <i class="fa-solid fa-sitemap"></i>&nbsp; Categories
                </button>
              </h2>
              <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_categories.php"><i class="fa-solid fa-sitemap"></i>&nbsp; All
                    Categories</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_subCategories.php"><i class="fa-solid fa-sitemap"></i>&nbsp;
                    All SubCategories</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_category.php"><i class="fa-solid fa-circle-plus"></i>&nbsp; Add
                    Category</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_subCategory.php"><i class="fa-solid fa-circle-plus"></i>&nbsp;
                    Add SubCategory</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href=""><i class="fa-solid fa-screwdriver-wrench"></i>&nbsp; Reassign Sub
                    Category</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/restore_categories.php"><i class="fa-solid fa-trash"></i>&nbsp;
                    Restore Categories</a>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseBrands" aria-expanded="true" aria-controls="collapseBrands">
                  <i class="fa-solid fa-tags"></i>&nbsp; Brands
                </button>
              </h2>
              <div id="collapseBrands" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_brands.php"><i class="fa-solid fa-sitemap"></i>&nbsp; All
                    Brands</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_brand.php"><i class="fa-solid fa-circle-plus"></i>&nbsp; Add
                    Brand</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/restore_brand.php"><i class="fa-solid fa-trash"></i>&nbsp; Restore
                    Brands</a>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseUnit" aria-expanded="true" aria-controls="collapseUnit">
                  <i class="fa-solid fa-weight-hanging"></i>&nbsp; Units
                </button>
              </h2>
              <div id="collapseUnit" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_units.php"><i class="fa-solid fa-sitemap"></i>&nbsp; All
                    Units</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_units.php"><i class="fa-solid fa-circle-plus"></i>&nbsp; Add
                    Unit</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/restore_unit.php"><i class="fa-solid fa-trash"></i>&nbsp; Restore
                    Units</a>
                </div>
              </div>
            </div>
          <?php } ?>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <i class="fa-solid fa-cart-shopping"></i>&nbsp; Sales Order
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/all_salesOrder.php"><i class="fa-solid fa-cart-flatbed"></i>&nbsp;
                  All Sales Orders</a>
              </div>
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/create_order.php"><i class="fa-solid fa-cart-plus"></i>&nbsp;
                  Create Order</a>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <i class="fa-solid fa-bag-shopping"></i>&nbsp; Purchase Order
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/all_purchase_order.php"><i
                    class="fa-solid fa-layer-group"></i>&nbsp; All Purchase Orders</a>
              </div>
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/create_purchaseOrder.php"><i
                    class="fa-solid fa-cart-plus"></i>&nbsp; Create Purchase Order</a>
              </div>
            </div>
          </div>
          <?php if ($_SESSION['role_id'] < 2) { ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseSuppliers" aria-expanded="false" aria-controls="collapseSuppliers">
                  <i class="fa-solid fa-truck-moving"></i>&nbsp; Suppliers
                </button>
              </h2>
              <div id="collapseSuppliers" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_suppliers.php"><i class="fa-solid fa-truck-moving"></i>&nbsp;
                    All Suppliers</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_supplier.php"><i class="fa-solid fa-truck-front"></i>&nbsp; Add
                    Supplier</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/restore_suppliers.php"><i class="fa-solid fa-trash"></i>&nbsp;
                    Restore Supplier</a>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <i class="fa-solid fa-warehouse"></i>&nbsp; Inventory
              </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <a class="btn btn-block" href="pages/all_inventory_stock.php"><i class="fa-solid fa-cubes"></i>&nbsp;
                  Current Stock</a>
              </div>
            </div>
          </div>
          <?php if ($_SESSION['role_id'] < 2) { ?>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                  <i class="fa-solid fa-user"></i>&nbsp; Users
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_user.php"><i class="fa-solid fa-users"></i>&nbsp; All
                    Users</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_user.php"><i class="fa-solid fa-user-plus"></i>&nbsp; Add
                    Users</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_user.php"><i class="fa-solid fa-trash"></i>&nbsp; Restore
                    Users</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/all_role.php"><i class="fa-solid fa-users"></i>&nbsp; All
                    Roles</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href="pages/add_role.php"><i class="fa-solid fa-user-plus"></i>&nbsp; Add
                    Roles</a>
                </div>

              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                  <i class="fa-solid fa-chart-simple"></i>&nbsp; Reports/Analytics
                </button>
              </h2>
              <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <a class="btn btn-block" href=""><i class="fa-solid fa-chart-line"></i>&nbsp; Sales Reports</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href=""><i class="fa-solid fa-people-line"></i>&nbsp; Customer Reports</a>
                </div>
                <div class="accordion-body">
                  <a class="btn btn-block" href=""><i class="fa-solid fa-truck-ramp-box"></i>&nbsp; Inventory Reports</a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="bottom_sidebar">
        <a href=""><i class="fa-solid fa-user"></i> Profile</a><br>
        <a href=""><i class="fa-solid fa-gear"></i> Setting</a>

      </div>
    </div>
  </section>