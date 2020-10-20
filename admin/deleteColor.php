<?php
    include "config.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "DELETE FROM colors WHERE 
        `color_id`= '".$id."'";

        if ($conn->query($sql) === true) {
            header('Location: manageColors.php');
        }
    }

?>
