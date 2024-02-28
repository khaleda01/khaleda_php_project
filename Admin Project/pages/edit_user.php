<?php
require_once("../includes/db_connection.php");
$id = $_GET['e'];
$sel = "SELECT * FROM users WHERE user_id='$id'";
$query = mysqli_query($con, $sel);
$data = mysqli_fetch_assoc($query);

?>

<div class="container" style="width: 80%; margin: 0 auto;">
  <h4>Update Users</h4>
  <form method="post">
    <div class="form-group">
      <label for="">Name:</label>
      <input class="form-control" type="text" name='i_user_name' value="<?= $data['user_name'] ?>">
    </div>
    <div class="form-group">
      <label for="">User Name:</label>
      <input class="form-control" type="text" name='i_user_username' value="<?= $data['user_username'] ?>">
    </div>
    <div class="form-group">
      <label for="">Email:</label>
      <input class="form-control" type="text" name='i_user_email' value="<?= $data['user_email'] ?>">
    </div>
    <div class="form-group">
      <label for="">Phone:</label>
      <input class="form-control" type="text" name='i_user_phone' value="<?= $data['user_phone'] ?>">
    </div>
    <div class="form-group">
      <label for="category">User Role:</label>
      <select class="form-control" id="category" name='i_user_role'>
        <option value="">---Select Role---</option>
        <?php
        $sel = "SELECT * FROM roles ORDER BY role_id='ASC'";
        $Qr = mysqli_query($con, $sel);
        while ($role = mysqli_fetch_assoc($Qr)) {
          ?>
          <option value="<?= $role['role_id']; ?>" <?php if ($data['role_id'] == $role['role_id']) {
              echo 'selected';
            } ?>>
            <?= $role['role_name']; ?>
          </option>
        <?php } ?>
      </select>
      </select>
    </div>
    <div class="form-group">
      <label for="">Photo:</label>
      <?php if ($data['user_image'] != '') { ?>
        <img class="user_img" src="uploads/images/<?= $data['user_image']; ?>" alt="Image" />
      <?php } ?>
      <input class="form-control" type="file" name='i_user_photo' value="<?= $data['user_name'] ?>">
    </div>
    <br>
    <input type="hidden" name="update_user" value="<?= $id ?>">
    <input type="submit" class="btn mybtn-hightlight" value="Update">
  </form>
  <div id="response"></div>
</div>
</div>