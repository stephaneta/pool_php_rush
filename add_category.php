<?php
include_once("category.php");

session_start();
if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 0)
    {
        header("Location: http://coding_academy.com/pool_php_rush/index.php");
        exit();
    }

$pdo = tools::connect_db();

echo "enter user's detail.<br>";

$cat = category::get_category2($pdo);
if (isset($_POST["name"]))
    {
        category::add_category($pdo);
        header('Location: http://coding_academy.com/pool_php_rush/admin.php');
    }
else
    {
?>
  <form action="add_category.php" method="post">
        <p>category : <input type="text" name="name"/></p>
        <p>parent_id : <select name="parent_id"/></p>
        <option value=0>None</option>
<?php
        foreach($cat as $val)
            {
                echo "<option value='".$val["id"]."'>".$val["name"]."</option>";
            }
        ?>
        </select>
        <p><input type="submit" value="OK" ></p>
        </form>

<?php
    }
?>
<a href="http://coding_academy.com/pool_php_rush/admin.php"> Back  </a><br>
