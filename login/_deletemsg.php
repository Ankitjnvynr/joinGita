<?php
include("../partials/_db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sr = $_POST['sr'];
    $sql = "DELETE FROM `messages` WHERE sr='$sr'";
    if ($conn->query($sql) === TRUE) {
        echo "Deleted successfully";
    } else {
        echo "Error updating content: " . $conn->error;
    }
    $conn->close();
}
?>