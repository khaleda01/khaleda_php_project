<?php
require_once("../includes/db_connection.php");

//pagination
$limit = 13;
$currentPage = $_GET['page'] ?? 1;

$countSql = "SELECT COUNT(*) AS TOTAL FROM purchase_order";
$result = $con->query($countSql);
$totalRows = $result->fetch_assoc()['TOTAL'];
$totalPage = ceil($totalRows / $limit);
$offset = ($currentPage - 1) * $limit;


$sql = "SELECT * FROM purchase_order_information WHERE purchase_order_status = 1 ORDER by purchase_order_id DESC LIMIT $offset, $limit";
$result = $con->query($sql);

?>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th><input type="checkbox" class="select-all"></th>
                <th>Purchase Order ID</th>
                <th>Supplier Name</th>
                <th>User</th>
                <th>Date and Time</th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><input type="checkbox" class="select"></td>
                    <td>
                        <?= $data['purchase_order_id'] ?>
                    </td>
                    <td>
                        <?= $data['supplier_name'] ?>
                    </td>
                    <td>
                        <?= $data['user_name'] ?>
                    </td>
                    <td>
                        <?= $data['time_stamp'] ?>
                    </td>
                    <td>
                        <a class="btn mybtn-hightlight d-block p-0"
                            href="pages/purchase_orderInvoice.php?purchase_order_id=<?= $data['purchase_order_id'] ?>">View
                            Invoice
                            <i class="fa-solid fa-file-invoice"></i></a>
                    </td>
                </tr>
            <?php } ?>
            <!-- Add more rows for each user -->
        </tbody>
    </table>
</div>

<div class="pagination">
    <a href="pages/all_purchase_order.php?page=1">&laquo;</a>
    <a href="pages/all_purchase_order.php?page=<?= $currentPage - 1 ?>">&lt;</a>
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
        <a href="pages/all_purchase_order.php?page=<?= $page ?>" class="<?= $currentPage == $page ? 'active' : '' ?>"><?= $page ?></a>
    <?php } ?>
    <a href="pages/all_purchase_order.php?page=<?= $currentPage + 1 ?>">&gt;</a>
    <a href="pages/all_purchase_order.php?page=<?= $totalPage ?>">&raquo;</a>
</div>
</div>