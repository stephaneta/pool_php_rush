<?php
include_once("tools.php");
class user
{
    function login($dns, $user, $pass, $log_email, $log_pass)
    {
        $erreur = 0;
        $pdo = tools::connect_db($dns, $user, $pass);
        $query_pass = 'SELECT password FROM users WHERE email="'.$log_email.'"';
        $res = tools::_query($pdo, $query_pass);
        $pass = password_verify($log_pass, $res["password"]);
        if ($pass == true)
            {
                $query_username = 'SELECT username FROM users WHERE email="'.$log_email.'"';
                $res = tools::_query($pdo, $query_username);       
                $_SESSION["name"] = $res["username"];
                $erreur = 0;
                return $erreur;
            }
        else
            {
                $erreur = 1;
                return $erreur;
            }
    }

    function verify_info()
    {       
        $erreur = 0;
        
        if (empty($_POST["name"]))
            {
                echo "Nom recquis<br>";
                $erreur = 1;
            }
        else if (!preg_match("/^.[a-zA-Z ]{2,9}$/", $_POST["name"]))
            {
                echo "Utiliser uniquement des lettres et des espaces avec minimum 3 caractères et maximum 10 caractères<br>";
                $erreur = 1;
            }
        if (empty($_POST["email"]))
            {
                echo "Email recquis<br>";
                $erreur = 1;
            }
        else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            {
                echo "Email invalide<br>";
                $erreur = 1;
            }
        if (empty($_POST["password"]))
            {
                echo "Password recquis<br>";
                $erreur = 1;
            }
        else if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%])[0-9a-zA-Z!@#$%]{2,9}$/", $_POST["password"]))
            {
                echo "3 à 10 charactères dont au moins un charactère spécial, nombre et lettre<br>";
                $erreur = 1;
            }
        if (empty($_POST["password_conf"]))
            {
                echo "Confirmer le password<br>";
                $erreur = 1;
            }
        else if ($_POST["password_conf"] != $_POST["password"])
            {
                echo "Votre mot de passe de confirmation n'est pas valide<br>";
                $erreur = 1;
            }
        return $erreur;        
    }

    function inscription($pdo)
    {
        $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $query_insert = 'INSERT INTO users (username, email, password, created_at) VALUES ("'. $_POST["name"] .'","'. $_POST["email"] .'","'. $new_password .'", NOW())';
        tools::_query($pdo, $query_insert);
        $_SESSION["name"] = $_POST["name"];
    }
}
?>