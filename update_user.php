<?php
include_once("user.php");

$pdo = tools::connect_db();

echo "update user's detail.<br>";

if (user::verify_info() == 0)
    {
        user::update_user($pdo);
        header('Location: http://coding_academy.com/pool_php_rush/admin.php');
    }

?>
 <form action="update_user.php" method="post">
        <p>nom : <input type="text" name="name"/></p>
        <p>email : <input type="text" name="email" /></p>
        <p>password : <input type="password" name="password" /></p>
        <p>password_confirmation : <input type="password" name="password_conf" /></p>
        <p>admin_right : <input type="number" name="admin"/></p>
    <p><input type="hidden" name="id" value=<?php echo $_GET["id"];?>/></p>
        <p><input type="submit" value="OK" ></p>
        </form>
    <a href="http://coding_academy.com/pool_php_rush/admin.php"> Back  </a><br>