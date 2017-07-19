<link rel="stylesheet" TYPE="text/css" href="style.css">

<?php
include_once("tools.php");
class product
{
    function get_product_admin()
    {
        $query_get = ('SELECT id, name, description, price, user_id, category_id FROM products');
        $pdo = tools::connect_db();
        $res = tools::_query_all($pdo, $query_get);
        
        foreach ($res as $value)
            {
                echo "<table><tr><td> name: </td><td>".$value["name"]. "</td><td>price: </td><td>".$value["price"]."</td><td> description:</td><td>".$value["description"]."</td>
<td><a href='http://coding_academy.com/pool_php_rush/update_product.php?id=".$value["id"]."'>Update</a></td>
<td><a href='http://coding_academy.com/pool_php_rush/delete_product.php?id=".$value["id"]."'>Delete</a></td>
</tr></table>";
            }
    }
    function get_product_user()
    {
        $query_get = ('SELECT id, name, description, price, user_id, category_id FROM products');
        $pdo = tools::connect_db();
        $res = tools::_query_all($pdo, $query_get);
        
        foreach ($res as $value)
            {
                echo "<table><tr><td> name: </td><td>".$value["name"]. "</td><td>price: </td><td>".$value["price"]."</td><td> description:</td><td>".$value["description"]."</td></tr></table>";
            }
    }
    
    function add_product($pdo)
    {
        $query_set = ('INSERT INTO products (name, price, description) VALUES ("'.$_POST["name"].'", "'.$_POST["price"].'","'.$_POST["description"].'")');
        tools::_query($pdo, $query_set);
    }

     function update_product($pdo)
    {
        $id = substr_replace($_POST["id"], "", -1);
        $query_update = ('UPDATE products SET name="'.$_POST["name"].'", price="'.$_POST["price"].'", description="'.$_POST["description"].'" WHERE id='.$id);
        tools::_query($pdo, $query_update);    
    }
    function delete_product($pdo)
    {
        $query_delete = ('DELETE FROM products WHERE id='.$_GET["id"]);
        tools::_query($pdo, $query_delete);
    }
}