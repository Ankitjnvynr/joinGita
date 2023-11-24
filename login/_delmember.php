<?php
$del = $_POST['mid'];
include("../partials/_db.php");

$delsql = "DELETE FROM `users` WHERE `id` = '$del'";
$result = mysqli_query($conn, $delsql);
if ($result) {
    echo "deleted successfully";
}

?>