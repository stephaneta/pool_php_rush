<html>
<head>
</head>
<body>

<?php
include_once("user.php");
include_once("product.php");
include_once("category.php");
session_start();

if ($_SESSION["name"] == null)
    header('Location: http://coding_academy.com/pool_php_rush/login.php');
echo "hello ". $_SESSION["name"] ;

$pdo = tools::connect_db();
$query_right = 'SELECT is_admin FROM users WHERE username="'.$_SESSION["name"].'"';
$res = tools::_query($pdo, $query_right);
if ($res["is_admin"] == 1)
    {
?>
<form action="admin.php" method="post">
     <p><input type="submit" name="admin" value="Admin" ></p>
     </form>
<?php
    }
else
    {
        //user::get_user_user($pdo);
        product::get_product_user();
        category::get_category_user($pdo);
    }
?>
<form action="index.php" method="post">
     <p><input type="submit" name="logout" value="Log out" ></p>
     </form>
                
<?php
     if (isset($_POST["logout"]))
         {
             session_unset();
             session_destroy();
             session_reset();
             header('Location: http://coding_academy.com/pool_php_rush/login.php');
         }    
?>
</body>
</html>