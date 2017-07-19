<link rel="stylesheet" TYPE="text/css" href="style.css">

<?php
include_once("tools.php");
class user
{
    function login($log_email, $log_pass)
    {
        $erreur = 0;
        $pdo = tools::connect_db();
        $query_pass = 'SELECT password FROM users WHERE email="'.$log_email.'"';
        $res = tools::_query($pdo, $query_pass);
        $pass = password_verify($log_pass, $res["password"]);
        if ($pass == true)
            {
                $query_username = 'SELECT username, is_admin FROM users WHERE email="'.$log_email.'"';
                $res = tools::_query($pdo, $query_username);       
                $_SESSION["name"] = $res["username"];       
                $_SESSION["is_admin"] = $res["is_admin"];
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
    function get_user_admin($pdo)
    {
        $query_get = ('SELECT id, username, email, password, is_admin FROM users');
        $res = tools::_query_all($pdo, $query_get);
        foreach ($res as $value)
            {
                echo "<table><tr><td> user: </td><td>".$value["username"]. "</td><td>email: </td><td>".$value["email"]."</td><td> admin_right:</td><td>".$value["is_admin"]."</td>
<td><a href='http://coding_academy.com/pool_php_rush/update_user.php?id=".$value["id"]."'>Update</a></td>
<td><a href='http://coding_academy.com/pool_php_rush/delete_user.php?id=".$value["id"]."'>Delete</a></td>
</tr></table>";
            }
    }
    function get_user_user($pdo)
    {
        $query_get = ('SELECT id, username, email FROM users');
        $res = tools::_query($pdo, $query_get);
        echo "<table><tr><td> user: ".$res["username"]."</td><td>email: </td><td>".$res["email"]."</td></tr></table>";
    }
    function add_user($pdo)
    {
        $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $query_set = ('INSERT INTO users (username, email, password, created_at, is_admin) VALUES ("'. $_POST["name"].'", "'.$_POST["email"].'","'.$new_password.'", NOW(),"'.$_POST["admin"].'")');
        tools::_query($pdo, $query_set); 
    }
    function update_user($pdo)
    {
        $id = substr_replace($_POST["id"], "", -1);
        $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $query_update = ('UPDATE users SET username="'.$_POST["name"].'", email="'.$_POST["email"].'", password="'.$new_password.'", created_at=NOW(), is_admin='.$_POST["admin"].' WHERE id='.$id);
        tools::_query($pdo, $query_update);    
    }
    function delete_user($pdo)
    {
        $query_delete = ('DELETE FROM users WHERE id='.$_GET["id"]);
        tools::_query($pdo, $query_delete);
    }
}
