<?php
require_once('./../includes/db_connection.php');
// Retrieve the selected category ID from the AJAX request
$categoryID = $_GET['category_id'];

$sql = "SELECT * FROM sub_categories WHERE category_id = $categoryID ORDER BY sub_category_name";
$result = $con->query($sql);



$options = <<<HTML
<select>
    <option selected disabled>Select Sub Category</option>
HTML;

while ($subcategories = $result->fetch_assoc()) {
    $options .= '<option value="' . $subcategories['sub_category_id'] . '">' . $subcategories['sub_category_name'] . '</option>';
}
$options .= "</select>";
echo $options;
?>