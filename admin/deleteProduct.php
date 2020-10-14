<?php
    include "config.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "DELETE FROM products WHERE 
        `product_id`= '".$id."'";

        if ($conn->query($sql) === true) {
            header('Location: manageProduct.php');
        }
    }

?>
