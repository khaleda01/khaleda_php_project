<?php 
require_once("../includes/db_connection.php");

//pagination
$limit = 5;
$currentPage = $_GET['page'] ?? 1;

$countSql = "SELECT COUNT(*) AS TOTAL FROM categories";
$result = $con->query($countSql);
$totalRows = $result->fetch_assoc()['TOTAL'];
$totalPage = ceil($totalRows / $limit);
$offset = ($currentPage - 1) * $limit;


$sql = "SELECT * FROM categories WHERE category_status = 0 ORDER by category_id DESC LIMIT $offset, $limit";
$result = $con->query($sql);

?>
<div class="table-responsive">
  <table>
    <thead>
      <tr>
        <th><input type="checkbox" class="select-all"></th>
        <th>Category ID</th>
        <th>Category Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php 
                    while($data = $result->fetch_assoc()){
                    ?>
      <tr>
        <td><input type="checkbox" class="select"></td>
        <td><?=$data['category_id']?></td>
        <td><?=$data['category_name']?></td>
        <td>
          <a href="pages/edit_category.php?category_id=<?=$data['category_id']?>" class="edit-btn btn">Restore</a>
          <a href="formServer.php?categoryDelete=<?=$data['category_id']?>" class="delete-btn btn">Permanat Delete</a>
        </td>
      </tr>
      <?php } ?>
      <!-- Add more rows for each user -->
    </tbody>
  </table>
</div>

<div class="pagination">
  <a href="pages/all_categories.php?page=1">&laquo;</a>
  <a href="pages/all_categories.php?page=<?=$currentPage-1?>">&lt;</a>
  <?php 
                if($currentPage>2){
                  $page = $currentPage - 2;
                  $lastPage = $currentPage + 2;
                }else{
                  $page = 1;
                  $lastPage = 5;
                }
                if($lastPage>=$totalPage){
                  $lastPage = $totalPage;
                }
                for($page; $page<=$lastPage; $page++){ 
                  ?>
  <a href="pages/all_categories.php?page=<?=$page?>" class="<?=$currentPage == $page ? 'active' : '' ?>"><?=$page?></a>
  <?php } ?>
  <a href="pages/all_categories.php?page=<?=$currentPage + 1?>">&gt;</a>
  <a href="pages/all_categories.php?page=<?=$totalPage?>">&raquo;</a>
</div>
</div>