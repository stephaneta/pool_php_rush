<?php
include_once("category.php");
session_start();

if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 0)
    {
        header("Location: http://coding_academy.com/pool_php_rush/index.php");
        exit();
    }

$pdo = tools::connect_db();

echo "update category detail's.<br>";

if (isset($_POST["name"]))
    {
        category::update_category($pdo);
        header('Location: http://coding_academy.com/pool_php_rush/admin.php');
    }

?>
 <form method="post">
        <p>category : <input type="text" name="name"/></p>
        <p><input type="hidden" name="id" value=<?php echo $_GET["id"];?>/></p>
        <p><input type="submit" value="OK" ></p>
        </form>
     <a href="http://coding_academy.com/pool_php_rush/admin.php"> Back  </a><br>
