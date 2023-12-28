<?php
    include("../partials/_db.php");
    $sql = "SELECT * FROM `users`";
    $result = $conn->query($sql);
    $numrows = $result->num_rows;
    echo $numrows;
?>