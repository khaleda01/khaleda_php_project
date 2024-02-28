<?php
require_once("../includes/db_connection.php");
$id = $_GET['supplier_id'];
$sql = "SELECT * From suppliers WHERE supplier_id='$id'";
$query = $con->query($sql);
$data = $query->fetch_assoc();
?>

<div class="form-body container" style="width: 80%; margin:0 auto">
    <h4>Update Supplier</h4>
    <form id="updateSupplier" method="post">
        <div class="form-group">
            <label for="">Supplier Name:</label>
            <input class="form-control" name="supplier_name" type="text" placeholder="Enter Supplier Name"
                value="<?= $data['supplier_name'] ?>">
        </div>
        <div class="form-group">
            <label for="">Supplier address:</label>
            <input class="form-control" name="supplier_address" type="text" placeholder="Enter Supplier Address"
                value="<?= $data['supplier_address'] ?>">
        </div>
        <div class="form-group">
            <label for="">Supplier Phone:</label>
            <input class="form-control" name="supplier_phone" type="text" placeholder="Enter Supplier Phone"
                value="<?= $data['supplier_phone'] ?>">
        </div>
        <div class="form-group">
            <label for="">Supplier Email:</label>
            <input class="form-control" name="supplier_email" type="text" placeholder="Enter Supplier Phone"
                value="<?= $data['supplier_email'] ?>">
        </div>
        <br>
        <input type="hidden" name="updateSupplier" value="<?= $id ?>">
        <input type="submit" class="mybtn-hightlight btn" value="Update Supplier">
    </form>
    <div id="response"></div>
</div>