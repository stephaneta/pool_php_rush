<?php
include_once("user.php");

$pdo = tools::connect_db();

user::delete_product($pdo);
header('Location: http://coding_academy.com/pool_php_rush/admin.php');

?>