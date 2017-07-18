<?php
class tools
{
    function connect_db()
    {
        $dns = "mysql:host=localhost;dbname=RUSH;port=3306";
        $user = "root";
        $pass = "olibaba972";
        try
            {
                $pdo = new PDO($dns, $user, $pass);
                return $pdo;
            }
        catch (PDOException $e)
            {
                echo $e->getMessage() . "\n";
                return null;
            }
    }
    
    function _query($pdo, $query)
    {
        $pdoStatement = $pdo->prepare($query);
        $pdoStatement->execute();
        $res = $pdoStatement->fetch();
        return ($res);
    }
    function _query_all($pdo, $query)
    {
        $pdoStatement = $pdo->prepare($query);
        $pdoStatement->execute();
        $res = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return ($res);
    }
}
?>