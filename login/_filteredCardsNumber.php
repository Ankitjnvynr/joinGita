<?php
include("../partials/_db.php");
$newStr = null;

$sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

$filters = array();
$byPhone = $_POST['phone'];
$byName = $_POST['filterName'];
$byEmail = $_POST['filterEmail'];
$byCountry = $_POST['filterCountry'];
$byState = $_POST['filterState'];
$byCity = $_POST['filterCity'];
$limit =  $_POST['limit'] ;
$start = $_POST['start'] ;

if($byPhone || $byEmail || $byCountry || $byState || $byCity || $byName){
    $newStr = ' WHERE ';
}

if($byCountry){
    // unset($filters[1]);
    // unset($filters[2]);
    $filters = array();
    $byCountry = " country LIKE '".$byCountry."%'";
    // array_splice($filters, 1, 2);  
    array_push($filters,$byCountry);
}
if($byName){
    $byName = " name LIKE '".$byName."%'";
    array_push($filters,$byName);
}
if($byState){
    $byState = " state LIKE '".$byState."%'";
    array_push($filters,$byState);
}
if($byCity){
    $byCity = " district LIKE '".$byCity."%'";
    array_push($filters,$byCity);
}
if($byPhone){
    $byPhone = " phone LIKE '".$byPhone."%'";
    array_push($filters,$byPhone);
}
if($byEmail){
    $byEmail = " email LIKE '%".$byEmail."%'";
    array_push($filters,$byEmail);
}

// echo var_dump($filters);
$newStr = $newStr.implode(" AND ", $filters);
// echo ($newStr);

$sql = "SELECT * FROM `users`  ".$newStr."  ORDER BY `id` DESC ";

// echo $sql;
// SELECT * FROM `users` WHERE phone LIKE '89%' AND name LIKE '%an%' ORDER BY `id` DESC LIMIT 3;
$result = mysqli_query($conn, $sql);
echo $result->num_rows ;


?>