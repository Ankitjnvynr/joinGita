<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>updating members</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="container my-3">
    
    <?php
        use SimpleExcel\SimpleExcel;
        if (isset($_POST['import'])) {
          if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $_FILES['excel_file']['name'])) {
            require_once('SimpleExcel/SimpleExcel.php');

            $excel = new SimpleExcel('csv');

            $excel->parser->loadFile($_FILES['excel_file']['name']);

            $foo = $excel->parser->getField();

            $count = 1;
            $inserts = 0;

            include("../partials/_db.php");

            //echo "Connected successfully";
            $sr = 0;
            $er=0;
            $result = false;
            while (count($foo) > $count) {
          $country = $foo[$count][2];
          $name = $foo[$count][3];
          $phone = $foo[$count][4];
          $designation = ($foo[$count][5] == '') ? 'Member' : $foo[$count][5];
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

          $query = "INSERT INTO `users`(`hash_id`, `country`, `name`, `phone`, `designation`, `email`, `dikshit`, `marital_status`, `state`, `district`, `tehsil`, `address`, `interest`, `occupation`, `education`, `dob`, `aniver_date`, `star`) VALUES ('$hash_id','$country','$name','$phone','$designation','$email','$dikshit','$married','$state','$district','$tehsil','$address','$intrest','$occupation','$education','$dob','$aniver_date','$message')";

              try {
                $sr++;
                $result = mysqli_query($conn, $query);
                if($result){
                  $inserts++;
                }
              } catch (Exception $e) {
                $er++;
                if($er==1){
                  echo '
                  <table class="table table-bordered">
                    <thead>
                      <h4 class="text-center text-danger">&#129396 Oops! something went wrong.</h4>
                      <tr>
                        <th scope="col">Sr. No. </th>
                        <th scope="col">What is wrong</th>
                        <!-- <th scope="col">File</th>
                        <th scope="col">Line</th> -->
                      </tr>
                    </thead>
                    <tbody>';
                  }
                // echo $e;
                // echo var_dump($e);
                echo '
                  <tr>
                    <td>' . $sr . '</td>
                    <td>' . $e->getMessage() . '</td>
                  </tr>
                  ';
                // echo $e->getMessage();
                // echo "<br>";
                if($er==1){
                  echo '
                    <tbody>
                      </tbody>';
                  }
              }

              $count++;
            }
            if ($result) {
              
              echo "Done, $inserts rows inserted";
            }else{
              
            }

            // echo "<script>window.location.href='index.php';</script>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>