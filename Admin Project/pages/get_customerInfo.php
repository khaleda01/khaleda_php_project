<?php
require_once("./../includes/db_connection.php");
require_once("./../includes/functions.php");

if (isset($_POST['customer_search'])) {
    $customer_search = $_POST['customer_search'];
    $limit = 10;
    $sql = "SELECT * FROM customers WHERE customer_phone LIKE '%$customer_search%'  LIMIT $limit";

    $result = $con->query($sql);
    $productsData = [];

    while ($data = $result->fetch_assoc()) {
        $productsData[] = $data;
    }

    $jsonData = json_encode($productsData);
    echo $jsonData;
}
?>