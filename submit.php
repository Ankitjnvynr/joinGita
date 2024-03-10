<?php
include("partials/_db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // echo "btn is pressed";
  $phone = $_POST["phone"];

  $checksql = "SELECT phone FROM `users` WHERE `phone` = '$phone' ";
  $res = mysqli_query($conn, $checksql);
  $row = mysqli_fetch_assoc($res);
  $numrows = mysqli_num_rows($res);
  if ($numrows > 0) {
    header("location:index.php?dphoneExiit=true");
    exit;

  }


  $country = $_POST["country"];
  $name = $_POST["name"];
  $email = $_POST["email"];

  $dikshit = $_POST["dikshit"];
  $married = $_POST["married"];
  $state = $_POST["state"];
  $district = $_POST["district"];
  $tehsil = $_POST["tehsil"];
  $address = $_POST["address"];

  $occupation = $_POST["occupation"];
  $education = $_POST["education"];
  $dob = $_POST["dob"];

  $aniver_date = isset($_POST['aniver_date']) ? $_POST['aniver_date'] : "";
  $hash_id = md5($phone);



  // Use prepared statements to insert data
  if (isset($_POST['joinsubmit'])) {
    $sql = "INSERT INTO `users`(`hash_id`, `country`, `name`, `phone`,  `email`, `dikshit`, `marital_status`, `state`, `district`, `tehsil`, `address`, `occupation`, `education`, `dob`,`dob`, `aniver_date`) VALUES ('$hash_id','$country','$name','$phone','$email','$dikshit','$married','$state','$district','$tehsil','$address','$occupation','$education','$dob','GIEO Gita','$aniver_date')";
  }

  

  try {
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo "Please Wait..........";
      header("location:view-profile.php?joined=true");
      exit;

    }

  } catch (Exception $err) {
    if ($err) {
      echo $err;
      echo "hii";
      // header("location:index.php?dphoneExiit=true");
      exit;
    }
  }
}
// header("location:index.php");
echo "cher";

$conn->close();
