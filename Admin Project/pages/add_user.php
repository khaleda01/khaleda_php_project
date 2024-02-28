<?php
require_once("../includes/db_connection.php");
?>

<div class="container" style="width: 80%; margin: 0 auto;">
  <h4>Add Users</h4>
  <form>
    <div class="form-group">
      <label for="">Name:</label>
      <input class="form-control" type="text" name='i_user_name'>
    </div>
    <div class="form-group">
      <label for="">User Name:</label>
      <input class="form-control" type="text" name='i_user_username'>
    </div>
    <div class="form-group">
      <label for="">Email:</label>
      <input class="form-control" type="text" name='i_user_email'>
    </div>
    <div class="form-group">
      <label for="">Phone:</label>
      <input class="form-control" type="text" name='i_user_phone'>
    </div>
    <div class="form-group">
      <label for="">Password:</label>
      <input class="form-control" type="text" name='i_user_pass'>
    </div>
    <div class="form-group">
      <label for="">Repassword:</label>
      <input class="form-control" type="text" name='i_user_repass'>
    </div>
    <div class="form-group">
      <label for="category">User Role:</label>
      <select class="form-control" id="category" name='i_user_role'>
        <option value="">---Select Role---</option>
        <?php
          $sel="SELECT * FROM roles ORDER BY role_id='ASC'";
          $query=mysqli_query($con,$sel);
          while($data=mysqli_fetch_assoc($query)){
          ?>
        <option value="<?= $data['role_id']; ?>"><?= $data['role_name']; ?></option>
        <?php } ?>
      </select>
      </select>
    </div>
    <div class="form-group">
      <label for="">Photo:</label>
      <input class="form-control" type="file" name='i_user_photo'>
    </div>
    <br>
    <input type="hidden" name="add_user">
    <input type="submit" class="btn mybtn-hightlight" value="Add User">
  </form>
  <div id="response"></div>
</div>
</div>