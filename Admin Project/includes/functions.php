<?php
require_once("db_connection.php");
require_once("authentication.php");


// authentication and Login
if (!isset($_SESSION['user_username'])) {
    header("Location: login.php");
}



function getHeader()
{
    require_once("includes/header.php");
}
function getSidebar()
{
    require_once("includes/sidebar.php");
}
function getFooter()
{
    require_once("includes/footer.php");
}

?>