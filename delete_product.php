<?php
include_once("user.php");

$pdo = tools::connect_db();

echo "deletefile";

user::delete_user($pdo);
header('Location: http://coding_academy.com/pool_php_rush/admin.php');

?>