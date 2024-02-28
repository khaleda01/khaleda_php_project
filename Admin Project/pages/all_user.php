<?php
require_once("../includes/db_connection.php");
?>

<div class="container-fluid">
  <table>
    <thead>
      <tr>
        <th><input type="checkbox" class="select"></th>
        <th>ID</th>
        <th>Name</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Number</th>
        <th>Password</th>
        <th>Role</th>
        <th>Photo</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sel = "SELECT * FROM users NATURAL JOIN roles";
      $query = $con->query($sel);
      while ($data = $query->fetch_assoc()) {
        ?>
        <tr>
          <td><input type="checkbox" class="select"></td>
          <td>
            <?= $data['user_id']; ?>
          </td>
          <td>
            <?= $data['user_name']; ?>
          </td>
          <td>
            <?= $data['user_username']; ?>
          </td>
          <td>
            <?= $data['user_email']; ?>
          </td>
          <td>
            <?= $data['user_phone']; ?>
          </td>
          <td>
            <?= $data['user_password']; ?>
          </td>
          <td>
            <?= $data['role_name']; ?>
          </td>
          <td>
            <img class="user_img" src="uploads/images/<?= $data['user_image']; ?>" alt="">
          </td>
          <td>
            <a href="pages/view_user.php" class=" btn edit-btn "><i class="fa-solid fa-eye"></i></a>
            <a href="pages/edit_user.php?e=<?= $data['user_id']; ?>" class=" btn edit-btn "><i
                class="fa-solid fa-pen-to-square"></i></a>
            <a href="pages/delet_user.php" class=" btn delete-btn "><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class=" pagination">
    <a href="#">&laquo;</a>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">&raquo;</a>
  </div>
</div>