<?php
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once './../vendor/autoload.php';


//pagination
$limit = 13;
$currentPage = $_GET['page'] ?? 1;

$countSql = "SELECT COUNT(*) AS TOTAL FROM customers";
$result = $con->query($countSql);
$totalRows = $result->fetch_assoc()['TOTAL'];
$totalPage = ceil($totalRows / $limit);
$offset = ($currentPage - 1) * $limit;

$sql = "SELECT * FROM product_stock_information ORDER BY product_id DESC LIMIT $offset , $limit";
$query = $con->query($sql);


?>
<div class="table-responsive">
    <table>
        <thead>

            <tr>
                <th><input type="checkbox" class="select-all"></th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Total Sold</th>
                <th>Total Purchased</th>
                <th>Available Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = $query->fetch_assoc()) {
                ?>
                <tr>
                    <td><input type="checkbox" class="select"></td>
                    <td>
                        <?= $data["product_id"] ?>
                    </td>
                    <td>
                        <?= $data["product_name"] ?>
                    </td>
                    <td>
                        <?= $data["total_sold_quantity"] ?>
                    </td>
                    <td>
                        <?= $data["total_buy_quantity"] ?>
                    </td>
                    <td>
                        <?= $data = intval($data["total_stock"]) ?>
                    </td>
                </tr>
            <?php } ?>

            <!-- Add more rows for each user -->
        </tbody>
    </table>
</div>
<div class="pagination">
    <a href="pages/all_inventory_stock.php?page=1">&laquo;</a>
    <a href="pages/all_inventory_stock.php?page=<?= $currentPage - 1 ?>">&lt;</a>
    <?php
    if ($currentPage > 2) {
        $page = $currentPage - 2;
        $lastPage = $currentPage + 2;
    } else {
        $page = 1;
        $lastPage = 5;
    }
    if ($lastPage >= $totalPage) {
        $lastPage = $totalPage;
    }
    for ($page; $page <= $lastPage; $page++) {
        ?>
        <a href="pages/all_inventory_stock.php?page=<?= $page ?>" class="<?= $currentPage == $page ? 'active' : '' ?>"><?= $page ?></a>
    <?php } ?>
    <a href="pages/all_inventory_stock.php?page=<?= $currentPage + 1 ?>">&gt;</a>
    <a href="pages/all_inventory_stock.php?page=<?= $totalPage ?>">&raquo;</a>
</div>

<div class="download-excel">
    <a href="pages/get_stockdata_excel.php" data-disabled="true" class="btn"
        style="width=100px; color: black; display: block; background: green; ">Download
        Excel</a>
</div>