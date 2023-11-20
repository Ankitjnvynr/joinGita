<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>updating members</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>


  <?php

  use SimpleExcel\SimpleExcel;

  if (isset($_POST['import'])) {

    if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $_FILES['excel_file']['name'])) {
      require_once('SimpleExcel/SimpleExcel.php');

      $excel = new SimpleExcel('csv');

      $excel->parser->loadFile($_FILES['excel_file']['name']);

      $foo = $excel->parser->getField();

      $count = 1;

      include("../partials/_db.php");

      //echo "Connected successfully";


      while (count($foo) > $count) {
        $country = $foo[$count][2];
        $name = $foo[$count][3];
        $phone = $foo[$count][4];
        $whatsapp = $foo[$count][5];
        $email = $foo[$count][6];
        $dikshit = $foo[$count][7];
        $married = $foo[$count][8];
        $state = $foo[$count][9];
        $district = $foo[$count][10];
        $tehsil = $foo[$count][11];
        $address = $foo[$count][12];
        $intrest = $foo[$count][13];
        $occupation = $foo[$count][14];
        $education = $foo[$count][15];
        $dob = $foo[$count][16];
        $aniver_date = $foo[$count][17];
        $message = $foo[$count][18];

        $hash_id = md5($phone);

        $query = "INSERT INTO `users`(`hash_id`, `country`, `name`, `phone`, `whtsapp`, `email`, `dikshit`, `marital_status`, `state`, `district`, `tehsil`, `address`, `interest`, `occupation`, `education`, `dob`, `aniver_date`, `message`) VALUES ('$hash_id','$country','$name','$phone','$whatsapp','$email','$dikshit','$married','$state','$district','$tehsil','$address','$intrest','$occupation','$education','$dob','$aniver_date','$message')";

        $result = mysqli_query($conn, $query);

        $count++;
      }
      if ($result) {
        $count--;
        echo "Done, $count rows inserted";
      }

      // echo "<script>window.location.href='index.php';</script>";
    }
  }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>