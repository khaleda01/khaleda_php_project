<div class="form-body container" style="width: 80%; margin:0 auto">
  <h4>Add Brand</h4>
  <form id="addbrand">
    <div class="form-group">
      <label for="">Brand Name:</label>
      <input class="form-control" type="text" placeholder="Enter Brand Name" name="brandName">
    </div>
    <br>
    <input type="hidden" name="addbrand">
    <input type="submit" class="mybtn-hightlight btn" value="Add Brand">
  </form>
  <div id="response"></div>

</div>
<?php
    // if(isset($_POST['addbrand'])){
    //     $brandName=$_POST['brandName'];
    //     $sql="INSERT INTO brands(brand_name,brand_status) VALUES('brandName',1)";
    //     $query=$con->query($sql);
    //     if($query){
    //         echo "Brand Add Successfull";
    //     }else{
    //         echo "Data Upload Failed";
    //     }
    // }
?>