<link rel="stylesheet" TYPE="text/css" href="style.css">

<?php
include_once("tools.php");
class category
{
    function get_category($pdo)
    {
        $query_get = ('SELECT id, name, category_id FROM categories');
        $res = tools::_query_all($pdo, $query_get);
        
        foreach ($res as $value)
            {
                echo "<table><tr><td> category: </td><td>".$value["name"]."</td>
                <td><a href='http://coding_academy.com/pool_php_rush/update_category.php?id=".$value["id"]."'>Update</a></td>
                <td><a href='http://coding_academy.com/pool_php_rush/delete_category.php?id=".$value["id"]."'>Delete</a></td> </tr></table>";
            }
    }

    function get_category2($pdo)
    {
        $query_get = ('SELECT id, name, category_id FROM categories');
        $res = tools::_query_all($pdo, $query_get);
        return $res;
    }
    
    function get_category_user($pdo)
    {
        $query_get = ('SELECT id, name, category_id FROM categories');
        $res = tools::_query_all($pdo, $query_get);
        foreach ($res as $value)
            {
                echo "<table><tr><td> category: </td><td>".$value["name"]."</td> </tr></table>";
            }
    }
    function add_category($pdo)
    {
        $query_set = ('INSERT INTO categories (name, category_id) VALUES ("'.$_POST["name"].'", "'.$_POST["parent_id"].'")');
        tools::_query($pdo, $query_set);
    }
    function update_category($pdo)
    {
        $id = substr_replace($_POST["id"], "", -1);
        $query_update = ('UPDATE categories SET name="'.$_POST["name"].'" WHERE id ='.$id);
        tools::_query($pdo, $query_update);
    }
    function delete_category($pdo)
    {
        $query_delete = ('DELETE FROM categories WHERE id="'.$_GET["id"].'"');
        tools::_query($pdo, $query_delete);
    }
}