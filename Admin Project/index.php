<?php
require_once("includes/functions.php");
getheader();
getSidebar();
?>
<section class="content col-md-8 col-xl-9 col-xxl-10">
  <!-- Breadcrump Start -->
  <nav class="breadcrumb" style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i> Project</a></li>
      <li class="breadcrumb-item active" aria-current="page" id="lastBreadCrumb">DashBoard</li>
    </ol>
  </nav>
  <!-- Breadcrump End -->
  <div id="loading"></div>
  <!-- Content Start -->
  <div class="main_content">
    <?php
    require_once('pages/dashboard.php');
    ?>
  </div>
  <!-- Content End -->
</section>
</section>
<?php
getFooter();
?>