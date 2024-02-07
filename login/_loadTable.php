<?php
include("../partials/_db.php");
$newStr = null;
$sr = 0;
$sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

$filters = array();

$byPhone = isset($_POST['phone']) ? $_POST['phone'] : null;
$byName = isset($_POST['filterName']) ? $_POST['filterName'] : null;
$byEmail = isset($_POST['filterEmail']) ? $_POST['filterEmail'] : null;
$byCountry = isset($_POST['filterCountry']) ? $_POST['filterCountry'] : null;
$byState = isset($_POST['filterState']) ? $_POST['filterState'] : null;
$byCity = isset($_POST['filterCity']) ? $_POST['filterCity'] : null;

if ($byPhone || $byEmail || $byCountry || $byState || $byCity || $byName) {
    $newStr = ' WHERE ';
}

if ($byCountry) {
    // unset($filters[1]);
    // unset($filters[2]);
    $filters = array();
    $byCountry = " country LIKE '" . $byCountry . "%'";
    // array_splice($filters, 1, 2);  
    array_push($filters, $byCountry);
}
if ($byName) {
    $byName = " name LIKE '" . $byName . "%'";
    array_push($filters, $byName);
}
if ($byState) {
    $byState = " state LIKE '" . $byState . "%'";
    array_push($filters, $byState);
}
if ($byCity) {
    $byCity = " district LIKE '" . $byCity . "%'";
    array_push($filters, $byCity);
}
if ($byPhone) {
    $byPhone = " phone LIKE '" . $byPhone . "%'";
    array_push($filters, $byPhone);
}
if ($byEmail) {
    $byEmail = " email LIKE '%" . $byEmail . "%'";
    array_push($filters, $byEmail);
}

// echo var_dump($filters);
$newStr = $newStr . implode(" AND ", $filters);
// echo ($newStr);

$sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY `id` DESC ";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);



$conn->close();
?>