<?php
class tools
{
    function connect_db($dns, $user, $pass)
    {
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
}
?>