<?php
include_once("user.php");
session_start();

user::get_user();
?>
<a href="http://coding_academy.com/pool_php_rush/add_user.php"> Add User </a><br>
<?php
    user::get_product();
?>
<a href="http://coding_academy.com/pool_php_rush/add_product.php"> Add Product </a><br>
<a href="http://coding_academy.com/pool_php_rush/index.php"> Back  </a><br>
    

