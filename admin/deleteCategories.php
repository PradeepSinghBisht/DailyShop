<?php
    include "config.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "DELETE FROM categories WHERE 
        `category_id`= '".$id."'";

        if ($conn->query($sql) === true) {
            header('Location: manageCategories.php');
        }
    }

?>
