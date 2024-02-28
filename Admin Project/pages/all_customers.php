<?php
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
//pagination
$limit = 13;
$currentPage = $_GET['page'] ?? 1;

$countSql = "SELECT COUNT(*) AS TOTAL FROM customers";
$result = $con->query($countSql);
$totalRows = $result->fetch_assoc()['TOTAL'];
$totalPage = ceil($totalRows / $limit);
$offset = ($currentPage - 1) * $limit;

$sql = "SELECT * FROM customers WHERE customer_status = 1 ORDER BY customer_id DESC LIMIT $offset , $limit";
$query = $con->query($sql);
?>
<div class="table-responsive">
    <table>
        <thead>

            <tr>
                <th><input type="checkbox" class="select-all"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <?php if ($_SESSION['role_id'] < 2) { ?>
                    <th>Actions</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = $query->fetch_assoc()) {
                ?>
                <tr>
                    <td><input type="checkbox" class="select"></td>
                    <td>
                        <?= $data["customer_id"] ?>
                    </td>
                    <td>
                        <?= $data["customer_name"] ?>
                    </td>
                    <td>
                        <?= $data["customer_phone"] ?>
                    </td>
                    <td>
                        <?= $data["customer_email"] ?>
                    </td>
                    <td>
                        <?= $data["customer_address"] ?>
                    </td>
                    <?php if ($_SESSION['role_id'] < 2) { ?>
                        <td>
                            <a href="pages/update_customer.php?customer_id=<?= $data["customer_id"] ?>"
                                data-form="updateCustomer" class=" btn edit-btn "><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="formServer.php?customer_id=<?= $data["customer_id"] ?>" class=" btn delete-btn "><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>

            <!-- Add more rows for each user -->
        </tbody>
    </table>
</div>
<div class="pagination">
    <a href="pages/all_customers.php?page=1">&laquo;</a>
    <a href="pages/all_customers.php?page=<?= $currentPage - 1 ?>">&lt;</a>
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
        <a href="pages/all_customers.php?page=<?= $page ?>" class="<?= $currentPage == $page ? 'active' : '' ?>"><?= $page ?></a>
    <?php } ?>
    <a href="pages/all_customers.php?page=<?= $currentPage + 1 ?>">&gt;</a>
    <a href="pages/all_customers.php?page=<?= $totalPage ?>">&raquo;</a>
</div>