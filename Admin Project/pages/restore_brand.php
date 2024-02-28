<?php 
require_once("../includes/db_connection.php");

//pagination
$limit = 5;
$currentPage = $_GET['page'] ?? 1;

$countSql = "SELECT COUNT(*) AS TOTAL FROM brands";
$result = $con->query($countSql);
$totalRows = $result->fetch_assoc()['TOTAL'];
$totalPage = ceil($totalRows / $limit);
$offset = ($currentPage - 1) * $limit;


$sql = "SELECT * FROM brands WHERE brand_status = 0 ORDER by brand_id DESC LIMIT $offset, $limit";
$result = $con->query($sql);

?>
<div class="table-responsive">
  <table>
    <thead>
      <tr>
        <th><input type="checkbox" class="select-all"></th>
        <th>Brand ID</th>
        <th>Brand Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        while($data = $result->fetch_assoc()){
        ?>
      <tr>
        <td><input type="checkbox" class="select"></td>
        <td><?=$data['brand_id']?></td>
        <td><?=$data['brand_name']?></td>
        <td>
          <a href="formServer.php?restore_brand=<?=$data['brand_id']?>" class="edit-btn btn"><i
              class="fa-solid fa-pen-to-square"></i>Restore</a>
          <a href="formServer.php?par_brandDelete=<?=$data['brand_id']?>" class="delete-btn btn"><i
              class="fa-solid fa-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
      <!-- Add more rows for each user -->
    </tbody>
  </table>
</div>

<div class="pagination">
  <a href="pages/restore_brand.php?page=1">&laquo;</a>
  <a href="pages/restore_brand.php?page=<?=$currentPage-1?>">&lt;</a>
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
  <a href="pages/restore_brand.php?page=<?=$page?>" class="<?=$currentPage == $page ? 'active' : '' ?>"><?=$page?></a>
  <?php } ?>
  <a href="pages/restore_brand.php?page=<?=$currentPage + 1?>">&gt;</a>
  <a href="pages/restore_brand.php?page=<?=$totalPage?>">&raquo;</a>
</div>
</div>