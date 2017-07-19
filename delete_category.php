<?php
include_once("category.php");
session_start();
if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 0)
    {
        header("Location: http://coding_academy.com/pool_php_rush/index.php");
        exit();
    }

$pdo = tools::connect_db();

category::delete_category($pdo);
header('Location: http://coding_academy.com/pool_php_rush/admin.php');

?>
