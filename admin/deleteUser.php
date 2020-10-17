<?php
    include "config.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "DELETE FROM users WHERE 
        `user_id`= '".$id."'";

        if ($conn->query($sql) === true) {
            header('Location: manageUser.php');
        }
    }

?>
