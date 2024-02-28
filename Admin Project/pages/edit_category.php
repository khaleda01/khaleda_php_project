<?php 
require_once("../includes/db_connection.php");


if(isset($_GET['category_id'])){
  $id = $_GET['category_id'];

  $sql = "SELECT * FROM categories WHERE category_id = $id";
  $result =$con->query($sql);
  $data = $result->fetch_assoc();
}



?>

<div class="form-body container" style="width: 80%; margin:0 auto">
  <h4>Edit Category</h4>
  <form id="addCategory" method="post">
    <div class="form-group">
      <label for="">Category Name:</label>
      <input class="form-control" type="text" placeholder="Enter Customer Name" name="categoryName"
        value="<?=$data['category_name']?>">
    </div>
    <br>
    <input type="hidden" name="updateCategory" value="<?=$id?>">
    <input type="submit" class="mybtn-hightlight btn" value="Update Category">
  </form>
  <div id="response"></div>

</div>
</div>