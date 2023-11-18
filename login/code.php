
        <?php

        use SimpleExcel\SimpleExcel;

        include("../partials/_db.php");

        if (isset($_POST['save_excel_data'])) {

            if (move_uploaded_file($_FILES['import_file']['tmp_name'], $_FILES['import_file']['name'])) {
                require_once('SimpleExcel/SimpleExcel.php');

                $excel = new SimpleExcel('csv');

                $excel->parser->loadFile($_FILES['import_file']['name']);

                $foo = $excel->parser->getField();
                // echo var_dump($foo);
                $datalen = sizeof($foo);
                // echo $datalen;
                echo count($foo)-1;
                $count = 1;
                while (count($foo) > $count) {
                    echo "<br>".$count ."<br>";
                    $country = $foo[$count][2];
                    $name = $foo[$count][3];
                    $phone = $foo[$count][4];
                    $email = $foo[$count][5];
                    $whatsapp = $foo[$count][6];
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
                    $message = $foo[$count][17];
                    $aniver_date = $foo[$count][18];
                    $hash_id = md5($phone);
                    echo $name;
                    $count++;

                    $sql = "INSERT INTO `users`(`hash_id`, `country`, `name`, `phone`, `whtsapp`, `email`, `dikshit`, `marital_status`, `state`, `district`, `tehsil`, `address`, `interest`, `occupation`, `education`, `dob`, `aniver_date`, `message`) VALUES ('$hash_id','$country','$name','$phone','$whatsapp','$email','$dikshit','$married','$state','$district','$tehsil','$address','$intrest','$occupation','$education','$dob','$aniver_date','$message')";

                    try {
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "Please Wait..........";
                            // header("location:view-profile.php?joined=true");
                            // exit;
                        }
                    } catch (Exception $err) {
                        echo var_dump($err);
                        echo "not uploaded";

                        if ($err) {
                            echo "hii";
                            // header("location:index.php?dphoneExiit=true");
                            exit;
                        }
                    }
                    
                }

                // echo "<script>window.location.href='index.php';</script>";

            }
        }
        ?>
