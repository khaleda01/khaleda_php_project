<?php
require_once("./../includes/db_connection.php");
require_once("./../includes/functions.php");

if (isset($_POST['supplier_search'])) {
    $supplier_search = $_POST['supplier_search'];
    $limit = 10;
    $sql = "SELECT * FROM suppliers WHERE supplier_phone LIKE '%$supplier_search%'  LIMIT $limit";

    $result = $con->query($sql);
    $productsData = [];

    while ($data = $result->fetch_assoc()) {
        $productsData[] = $data;
    }

    $jsonData = json_encode($productsData);
    echo $jsonData;
}
?>