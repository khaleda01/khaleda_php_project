<?php 
require_once("includes/db_connection.php");

if(isset($_POST["addCategory"])){
    $categoryName = $_POST["categoryName"];

    $sql = "INSERT INTO categories(category_name) VALUES('$categoryName')";
    $query = $con->query($sql);
    if($query){
        echo "Data Inserted Successfully";
    }
    
}

?>