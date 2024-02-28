<?php
require_once('./../includes/db_connection.php');
require_once('./../includes/functions.php');

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    $sql = "SELECT * FROM product_information WHERE product_id=$productId";

    $query = $con->query($sql);
    $data = $query->fetch_assoc();

    $productDataJson = json_encode($data);
    echo $productDataJson;
}

?>