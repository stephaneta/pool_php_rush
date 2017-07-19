<?php
include_once("user.php");

$pdo = tools::connect_db();

echo "enter user's detail.<br>";

if (isset($_POST["name"]))
    {
        user::add_product($pdo);
        header('Location: http://coding_academy.com/pool_php_rush/admin.php');
    }

else
    {
?>
  <form action="add_product.php" method="post">
        <p>nom : <input type="text" name="name"/></p>
        <p>prix : <input type="number" name="price" /></p>
        <p>description : <input type="text" name="description"/></p>
        <p><input type="submit" value="OK" ></p>
        </form>
        
<?php
    }
?>
<a href="http://coding_academy.com/pool_php_rush/admin.php"> Back  </a><br>
