<!-- Button trigger modal -->
<?php
require_once("../includes/db_connection.php");

$id = $_GET['unit_id'];
$sql = "SELECT * FROM units WHERE unit_id=$id";
$query = $con->query($sql);
$data = $query->fetch_assoc();

?>
<div class="form-body container" style="width: 80%; margin:0 auto">
    <form id="editUnit">
        <div class="form-group">
            <label for="">Unit Name:</label>
            <input class="form-control" type="text" name="UnitName" value="<?= $data['unit_name'] ?>">
        </div>
        <br>
        <input type="hidden" name="editUnit" value="<?= $id ?>">
        <input type="submit" class="mybtn-hightlight btn" value="Update Unit">
    </form>
    <div id="response"></div>

</div>