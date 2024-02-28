<?php
    require_once("../includes/db_connection.php");
    $id=$_GET['customer_id'];
    $sql="SELECT * From customers WHERE customer_id='$id'";
    $query=$con->query($sql);
    $data=$query->fetch_assoc();
?>

<div class="form-body container" style="width: 80%; margin:0 auto">
    <h4>Update Customer</h4>
    <form id="updateCustomer" method="post">
        <div class="form-group">
            <label for="">Customer Name:</label>
            <input class="form-control" name="customer_name" type="text" placeholder="Enter Customer Name"
                value="<?= $data['customer_name']?>">
        </div>
        <div class="form-group">
            <label for="">Customer address:</label>
            <input class="form-control" name="customer_address" type="text" placeholder="Enter Customer Address"
                value="<?= $data['customer_address']?>">
        </div>
        <div class="form-group">
            <label for="">Customer Phone:</label>
            <input class="form-control" name="customer_phone" type="text" placeholder="Enter Customer Phone"
                value="<?= $data['customer_phone']?>">
        </div>
        <div class="form-group">
            <label for="">Customer Email:</label>
            <input class="form-control" name="customer_email" type="text" placeholder="Enter Customer Phone"
                value="<?= $data['customer_email']?>">
        </div>
        <br>
        <input type="hidden" name="updateCustomer" value="<?=$id?>">
        <input type="submit" class="mybtn-hightlight btn" value="Update Customer">
    </form>
    <div id="response"></div>
</div>