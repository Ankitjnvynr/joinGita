<?php
include ("../partials/_db.php");
$newStr = null;

$sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

$filters = array();
$byPhone = $_POST['phone'];
$byName = $_POST['filterName'];
$byEmail = $_POST['filterEmail'];
$byCountry = $_POST['filterCountry'];
$byState = $_POST['filterState'];
$filterdistrict = $_POST['filterDistrict'];
$bytehsil = $_POST['filterTehsil'];
$limit = $_POST['limit'];
$start = $_POST['start'];

// ----------------------from another --------------------


// $bydikshit = $_POST['filterDikshit'];

// if ($bydikshit)
// {
//     $bydikshit = " dikshit LIKE '" . $bydikshit . "%'";
//     array_push($filters, $bydikshit);
// }
// ----------------------from another --------------------



if ($byPhone || $byEmail || $byCountry || $byState || $bytehsil || $byName)
{
    $newStr = ' WHERE ';
}

if ($byCountry)
{
    // unset($filters[1]);
    // unset($filters[2]);
    $filters = array();
    $byCountry = " country LIKE '" . $byCountry . "%'";
    // array_splice($filters, 1, 2);  
    array_push($filters, $byCountry);
}
if ($byName)
{
    $byName = " name LIKE '" . $byName . "%'";
    array_push($filters, $byName);
}
if ($byState)
{
    $byState = " state LIKE '" . $byState . "%'";
    array_push($filters, $byState);
}
if ($filterdistrict)
{
    $filterdistrict = " district LIKE '" . $filterdistrict . "%'";
    array_push($filters, $filterdistrict);
}
if ($bytehsil)
{
    $bytehsil = " tehsil LIKE '" . $bytehsil . "%'";
    array_push($filters, $bytehsil);
}
if ($byPhone)
{
    $byPhone = " phone LIKE '" . $byPhone . "%'";
    array_push($filters, $byPhone);
}
if ($byEmail)
{
    $byEmail = " email LIKE '%" . $byEmail . "%'";
    array_push($filters, $byEmail);
}

// echo var_dump($filters);
$newStr = $newStr . implode(" AND ", $filters);
// echo ($newStr);

$sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY `id` DESC LIMIT " . $start . " , " . $limit . " ";
// echo ($newStr);

$sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY `id` DESC ";

// echo $sql;
// SELECT * FROM `users` WHERE phone LIKE '89%' AND name LIKE '%an%' ORDER BY `id` DESC LIMIT 3;
$result = mysqli_query($conn, $sql);
echo $result->num_rows;


?>