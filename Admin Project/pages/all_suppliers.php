<?php
require_once("../includes/db_connection.php");
//pagination
$limit = 13;
$currentPage = $_GET['page'] ?? 1;

$countSql = "SELECT COUNT(*) AS TOTAL FROM suppliers";
$result = $con->query($countSql);
$totalRows = $result->fetch_assoc()['TOTAL'];
$totalPage = ceil($totalRows / $limit);
$offset = ($currentPage - 1) * $limit;

$sql = "SELECT * FROM suppliers WHERE supplier_status = 1 ORDER BY supplier_id DESC LIMIT $offset , $limit";
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = $query->fetch_assoc()) {
                ?>
                <tr>
                    <td><input type="checkbox" class="select"></td>
                    <td>
                        <?= $data["supplier_id"] ?>
                    </td>
                    <td>
                        <?= $data["supplier_name"] ?>
                    </td>
                    <td>
                        <?= $data["supplier_phone"] ?>
                    </td>
                    <td>
                        <?= $data["supplier_email"] ?>
                    </td>
                    <td>
                        <?= $data["supplier_address"] ?>
                    </td>
                    <td>
                        <a href="pages/edit_supplier.php?supplier_id=<?= $data["supplier_id"] ?>" data-form="updatesupplier"
                            class=" btn edit-btn "><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="formServer.php?supplier_id=<?= $data["supplier_id"] ?>" class=" btn delete-btn "><i
                                class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>

            <!-- Add more rows for each user -->
        </tbody>
    </table>
</div>
<div class="pagination">
    <a href="pages/all_suppliers.php?page=1">&laquo;</a>
    <a href="pages/all_suppliers.php?page=<?= $currentPage - 1 ?>">&lt;</a>
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
        <a href="pages/all_suppliers.php?page=<?= $page ?>" class="<?= $currentPage == $page ? 'active' : '' ?>"><?= $page ?></a>
    <?php } ?>
    <a href="pages/all_suppliers.php?page=<?= $currentPage + 1 ?>">&gt;</a>
    <a href="pages/all_suppliers.php?page=<?= $totalPage ?>">&raquo;</a>
</div>