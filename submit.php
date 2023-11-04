<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "join-gieo";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

if ($_SERVER['REQUEST_METHOD']=='POST') {
    // echo "btn is pressed";
    $country = $_POST["country"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $whatsapp = $_POST["whatsapp"];
    $dikshit = $_POST["dikshit"];
    $married = $_POST["married"];
    $state = $_POST["state"];
    $district = $_POST["district"];
    $tehsil = $_POST["tehsil"];
    $address = $_POST["address"];
    $intrest = $_POST["intrest"];
    $occupation = $_POST["occupation"];
    $education = $_POST["education"];
    $dob = $_POST["dob"];
    $message = $_POST["message"];
    

    
    

    // Use prepared statements to insert data
    $sql = "INSERT INTO `users`( `country`, `name`, `phone`, `whtsapp`, `email`, `dikshit`, `marital_status`, `state`, `district`, `tehsil`, `address`, `interest`, `occupation`, `education`, `dob`, `message`) VALUES ('$country','$name','$phone','$whatsapp','$email','$dikshit','$married','$district','$state','$tehsil','$address','$intrest','$occupation','$education','$dob','$message')";

    try{
        $result = mysqli_query($conn,$sql);
        if($result){
            echo "Please Wait..........";
            header("location:view-profile.php?joined=true");
            exit;
      
        }

    } catch(Exception $err){
      if($err){
        header("location:index.php?dphoneExiit=true");
        exit;
      }
    }
}
header("location:index.php");

$conn->close();
