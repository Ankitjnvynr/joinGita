<?php
include("../partials/_db.php");

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$final = json_encode($data);
echo json_encode($data);



$conn->close();
?>

