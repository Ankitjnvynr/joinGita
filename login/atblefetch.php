<?php
// Database connection details
include("../partials/_db.php");

// SQL query to fetch data, selecting only the desired columns
$sql = "SELECT id as sr_no, name, phone, state, district, tehsil AS city users";
$result = $conn->query($sql);

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>