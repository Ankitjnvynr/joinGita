<?php
include("../partials/_db.php");
$del = $_GET['img'];
$sql = "SELECT * FROM `masik_parvas` WHERE `id` = '$del'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (unlink('../masik_parwas/' . $row['pic'])) {
    $delsql = "DELETE FROM `masik_parvas` WHERE `id` = '$del'";
    $result = mysqli_query($conn, $delsql);
    if($result){
        echo "deleted successfully";
    }
}
