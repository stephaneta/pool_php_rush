<html>
<head>
</head>
<body>

<?php
include_once("user.php");

session_start();
$messageErr = "";
$erreur= 0;

if (isset($_POST["inscription"]))
    header('Location: http://coding_academy.com/pool_php_rush/inscription.php');

if (isset($_POST["login"]))
    {        
        $log = user::login($_POST["email"], $_POST["password"]);
        if ($log == 0)
            header('Location: http://coding_academy.com/pool_php_rush/index.php');
        else
            {
                $erreur = 1;
                $messageErr = "Incorrect email/password";
            }
    }

if ((!isset($_POST["email"])) || ($erreur == 1))
    {
        echo $messageErr . "<br>";

        
?>
        <form action="login.php" method="post">
        <p>email : <input type="text" name="email" /></p>
        <p>password : <input type="password" name="password" /></p>
        <p><input type="submit"  name="login" value="Login" ></p>
        <p><input type="submit" name="inscription" value="Inscription" ></p>
        </form>        
<?php
    }
?>

</body>
</html>