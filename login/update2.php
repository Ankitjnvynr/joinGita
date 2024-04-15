<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
  header("location: index.php");
  exit;
}

include ("../partials/_db.php");
$user_id = $_GET['user'];

$sr = 0;

$sql = "SELECT * FROM `users` WHERE `id` = '$user_id' ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result))
{
  $sr++;
  $country = $row['country'];
  $name = $row['name'];
  $phone = $row['phone'];
  $hash_id = $row['hash_id'];
  $designation = $row['designation'];
  $email = $row['email'];
  $dikshit = $row['dikshit'];
  $marital_status = $row['marital_status'];
  $state = $row['state'];
  $district = $row['district'];
  $tehsil = $row['tehsil'];
  $address = $row['address'];
  $wing = $row['interest'];
  $occupation = $row['occupation'];
  $education = $row['education'];
  $dob = $row['dob'];
  $aniver_date = $row['aniver_date'];
  $star = $row['star'];
  $pic = $row['pic'];
}
?>
<style>
  #joinForm {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  #joinForm>div,
  span {
    flex: 1 0 300px;
  }

  .cropper-container {
    width: 100% !important;
  }
</style>