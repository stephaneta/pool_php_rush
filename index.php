<html>
<head>
</head>
<body>

<?php
session_start();
if ($_SESSION["name"] == null)
    header('Location: http://coding_academy.com/pool_php_rush/login.php');
echo "hello ". $_SESSION["name"] ;
         
?>
<form action="index.php" method="post">
     <p><input type="submit" name="submit" value="Log out" ></p>
     </form>
                
<?php
     if (isset($_POST["submit"]))
         {
             session_unset();
             session_destroy();
             session_reset();
             header('Location: http://coding_academy.com/pool_php_rush/login.php');
         }    
?>
</body>
</html>