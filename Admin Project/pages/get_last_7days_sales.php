<?php
require_once('./../includes/db_connection.php');
require_once('./../includes/functions.php');
if (isset($_POST['sevenDaysData'])) {
    $sql = "SELECT * FROM last_7days_sales_information";
    $result = $con->query($sql);
    while ($data = $result->fetch_assoc()) {
        $last7DaysSales[] = $data;
    }
    $last7DaysSales = json_encode($last7DaysSales);
    echo $last7DaysSales;
}

if (isset($_POST['categoriesProduct'])) {
    $sql = "SELECT * FROM category_product_information";
    $result = $con->query($sql);
    while ($data = $result->fetch_assoc()) {
        $categoriesData[] = $data;
    }
    $categoriesData = json_encode($categoriesData);
    echo $categoriesData;
}
?>