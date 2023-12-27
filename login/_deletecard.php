<?php
include("../partials/_db.php");
$del = $_GET['img'];

$delsql = "DELETE FROM `users` WHERE `id` = '$del'";
$result = mysqli_query($conn, $delsql);
if ($result) {
    echo "deleted successfully";
}
?>