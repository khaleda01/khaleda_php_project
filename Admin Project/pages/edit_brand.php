<!-- Button trigger modal -->
<?php 
require_once("../includes/db_connection.php");
    
      $id=$_GET['brand_id'];
      $sql="SELECT * FROM brands WHERE brand_id=$id";
      $query=$con->query($sql);
      $data= $query->fetch_assoc();
    
    // if(isset($_POST['editBrand'])){
    //   $brandName=$_POST['brandName'];
    //   $sql="UPDATE brands SET brand_name='$brandName' WHERE brand_id='$id'";
    //   $query=$con->query($sql);
    //   if($query){
    //     echo "Data Upload Successful";
    //   }else{
    //     echo "Data Upload Failed";
    //   }
    // }
?>
<div class="form-body container" style="width: 80%; margin:0 auto">
  <form id="editbrand">
    <div class="form-group">
      <label for="">Brand Name:</label>
      <input class="form-control" type="text" name="brandName" value="<?= $data['brand_name']?>">
    </div>
    <br>
    <input type="hidden" name="editBrand" value="<?=$id?>">
    <input type="submit" class="mybtn-hightlight btn" value="Add Brand">
  </form>
  <div id="response"></div>

</div>