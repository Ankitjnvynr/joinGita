<?php
include("../partials/_db.php");
// Handle AJAX request to update content in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $sr = $_POST['sr'];
    $msg = $_POST['msg'];
    // $msg = htmlentities($msg, ENT_QUOTES, 'UTF-8');
    $msg = urlencode($msg);

    // Update content in the database
    // Assume you have a database connection established already
    $sql = "UPDATE messages SET msg='$msg' WHERE sr='$sr'";
    if ($conn->query($sql) === TRUE) {
        echo "Content updated successfully";
    } else {
        echo "Error updating content: " . $conn->error;
    }

    // Close the database connection if needed
    $conn->close();
}
?>
