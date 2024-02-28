<?php
    require_once("../includes/db_connection.php");
    $sql="SELECT * FROM customers WHERE customer_status = 0 ORDER BY customer_id DESC";
    $query=$con->query($sql);
?>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th><input type="checkbox" class="select-all"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($data=$query->fetch_assoc()){
            ?>
            <tr>
                <td><input type="checkbox" class="select"></td>
                <td><?= $data["customer_id"]?></td>
                <td><?= $data["customer_name"]?></td>
                <td><?= $data["customer_phone"]?></td>
                <td><?= $data["customer_email"]?></td>
                <td><?= $data["customer_address"]?></td>
                <td>

                    <a style="background-color:green; color: white; margin-right:10px"
                        href="formServer.php?restore_customer_id=<?= $data["customer_id"]?>" class=" btn delete-btn "><i
                            class="fa-solid fa-trash-can-arrow-up"></i></a>
                    <a href="formServer.php?par_delete_customer_id=<?= $data["customer_id"]?>"
                        class=" btn delete-btn "><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php }?>

            <!-- Add more rows for each user -->
        </tbody>
    </table>
</div>