<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="join-gieo";

// $servername = "localhost";
// $username = "u704382176_join_gita";
// $password = "GieoGita@2022";
// $db="u704382176_join_gita";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>