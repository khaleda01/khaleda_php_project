<?php 
require_once('./../includes/db_connection.php');
//Categories Data retriving
$sql = "SELECT * FROM categories";
$cat_result = $con->query($sql);

?>

<div class="container" style="width: 80%; margin: 0 auto;">
  <h4>Add Sub Category</h4>
  <form id="addSubCategory">
    <div class="form-group">
      <label for="category">Category:</label>
      <select class="form-control" id="category" name="categoryId">
        <option value="" selected disabled>Select Category</option>
        <?php while($data = $cat_result->fetch_assoc()){ ?>
        <option value="<?=$data['category_id']?>"><?=$data['category_name']?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="subCategoryName">Sub Category Name:</label>
      <input class="form-control" type="text" id="subCategoryName" name="subCategoryName"
        placeholder="Enter Sub Category Name">
    </div>
    <br>
    <input type="hidden" name="addSubCategory">
    <input type="submit" class="btn mybtn-hightlight" value="Add SubCategory">
  </form>
  <div id="response"></div>
</div>