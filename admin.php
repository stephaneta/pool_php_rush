<?php
include_once("user.php");
include_once("product.php");
include_once("category.php");
session_start();

if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 0)
    {
        header("Location: http://coding_academy.com/pool_php_rush/index.php");
        exit();
    }

$pdo = tools::connect_db();
user::get_user_admin($pdo);
?>
<a href="http://coding_academy.com/pool_php_rush/add_user.php"> Add User </a><br>
<?php
    product::get_product_admin($pdo);
?>
<a href="http://coding_academy.com/pool_php_rush/add_product.php"> Add Product </a><br>
    <?php
    category::get_category($pdo);
?>
<a href="http://coding_academy.com/pool_php_rush/add_category.php"> Add Category </a><br>
    
    
<html>
    <form method="POST">
    <p>Rechercher un mot : <input type="text" name="recherche"/></p>
    <p>trier par : <select name="order"/></p>
    <option value=0>None</option>
    <option value=1>Order by name</option>
    <option value=2>Order by name desc </option>
    <option value=3>Order by price</option>
    <option value=4>Order by price desc</option>
<?php
    $recherche = isset($_POST['recherche']) && $_POST["recherche"]!="" ? $_POST['recherche']: 'bob';
$sql = tools::connect_db();
if ($_POST["order"] == 0 || $_POST["order"] == 1)
    $query = "SELECT * FROM products WHERE name LIKE '%$recherche%'";
if ($_POST["order"] == 2)
    $query = "SELECT * FROM products WHERE name LIKE '%$recherche%' ORDER BY name DESC";
if ($_POST["order"] == 3)
    $query = "SELECT * FROM products WHERE name LIKE '%$recherche%' ORDER BY price";
if ($_POST["order"] == 4)
    $query = "SELECT * FROM products WHERE name LIKE '%$recherche%' ORDER BY price DESC";
?>
    <input type="SUBMIT" value="Search!">
    </form>
    </html>
<?php

$res = $sql->prepare($query);
$res->execute();
$result = $res->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $val)
    {
        echo "Name: ".$val["name"]. "</br>";
    }
?>

<a href="http://coding_academy.com/pool_php_rush/index.php"> Back  </a><br>