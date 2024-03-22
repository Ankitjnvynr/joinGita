<?php
session_start();
if (!isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
include ("../partials/_db.php");


$currentURL = "http://$_SERVER[HTTP_HOST]/imgs/";
// filtering data
if (isset ($_POST['get-data']))
{
    $sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

    $filters = array();
    $byCountry = $_POST['filterCountry'];
    $byState = $_POST['filterState'];
    $filterdistrict = $_POST['filterdistrict'];
    $bytehsil = $_POST['bytehsil'];








    // $bydikshit = $_POST['filterDikshit'];

    if ($byCountry || $byState || $byCity || $messageSelect)
    {
        $newStr = ' WHERE ';
    }

    if ($byCountry)
    {
        $filters = array();
        $byCountry = " country LIKE '" . $byCountry . "%'";
        array_push($filters, $byCountry);
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


    $newStr = $newStr . implode(" AND ", $filters);
    $sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY name ASC;";
}

$country_code = array(
    "Australia" => "61",
    "Canada" => "1",
    "United Kingdom" => "44",
    "India" => "91",
    "Japan" => "81",
    "New Zealand" => "64",
    "United Arab Emirates" => "971",
    "United States" => "1",
    "USA" => "1",
    "UK" => "+44",
    "England" => "+44",
);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : Custom message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: #f7e092;
            overflow-x: hidden;
        }

        .filterform select {
            flex: 1 0 150px;
        }

        .filterform>button {
            flex: 1 0 100px;
        }

        .tablediv {
            overflow-x: scroll;
            font-size: 1rem;
        }
        #myTable{
        }
    </style>
</head>

<body>

    <?php include '_options.php'; ?>

    <!----------------------- filters input boxes--------------------- -->
    <div class="container">
        <form action="" method="POST" class="filterform d-flex flex-wrap gap-1">
            <select required class="form-select form-select-sm" aria-label="Small select example" name="filterCountry"
                id="countrySelect" onchange="SelectState(this)">
                <option value="" selected>---Country---</option>
                <?php
                $optionSql = "SELECT DISTINCT `country` FROM `users` ";
                $result = $conn->query($optionSql);
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="' . $row['country'] . '">' . $row['country'] . '</option>';
                }
                ?>
            </select>
            <select required name="filterState" class="form-select form-select-sm" aria-label="Small select example"
                id="stateSelect" onchange="selectingdistrict(this)">
                <option value="" selected>---State---</option>
            </select>
            <select name="filterdistrict" required name="filterCity" class="form-select form-select-sm"
                aria-label="Small select example" id="districtSelect" onchange="selectingtehsil(this)">
                <option value="" selected>---District---</option>
            </select>
            <select name="bytehsil" class="form-select form-select-sm" aria-label="Small select example"
                id="tehsilSelect">
                <option value="" selected>---Tehsil---</option>
            </select>
            <select class="form-select form-select-sm inputfields" name="messageSelect"
                aria-label="Small select example" required>
                <?php
                $message_select_sql = "SELECT * FROM `messages` ";
                $message_select_result = mysqli_query($conn, $message_select_sql);
                while ($message_select_row = mysqli_fetch_assoc($message_select_result))
                {
                    $selected = $message_select_row['title'] == 'Birthday' ? "Selected" : "";
                    echo '<option value="' . $message_select_row['title'] . '" ' . $selected . '>' . $message_select_row['title'] . '</option>';
                }
                ?>
            </select>


            <button type="submit" name="get-data" class="btn btn-danger">Get Data ></button>

        </form>
    </div>

    <!-- -------output data list ------- -->


    <div class="container tablediv pt-3">

        <table style="font-size: small;" id="myTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile</th>
                    <!-- <th scope="col">District</th> -->
                    <th scope="col">City</th>
                    <th scope="col">Send</th>
                    <!-- <th scope="col">Anniversary</th> -->
                    <!-- <th scope="col">Join On</th> -->
                    <!-- <td>' . substr($joinOn,0,10) . '</td> -->
                </tr>
            </thead>
            <tbody>
                Showing :-
                <?php
                if (isset ($_POST['get-data']))
                {
                        $messageSelect = $_POST['messageSelect'];
                        $msgsql = "SELECT * FROM `messages` WHERE `title` = '$messageSelect'";
                        $msgresult = mysqli_query($conn, $msgsql);
                        $msgrow = mysqli_fetch_assoc($msgresult);
                        $message = $msgrow['msg'];
                        // echo urldecode($message);
    
    
                    $sr = 0;
                    $result = $conn->query($sql);
                    echo $totalresult = mysqli_num_rows($result);
                    if ($totalresult > 0)
                    {
                        while ($row = mysqli_fetch_array($result))
                        {
                            $code = $country_code[$row['country']];
                            $sr++;
                            $user_id = $row['id'];
                            $country = $row['country'];
                            $name = $row['name'];
                            $phone = $row['phone'];
                            $name = $row['name'];
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
                            $joinOn = $row['dt'];
                            // $message = $row['message'];
                            $pic = $row['pic'];

                            echo '
                            <tr>
                                <th scope="row">' . $sr . '</th>
                                <td>' . $name . '</td>
                                <td><a style="text-decoration:none;" href="tel:' . $phone . '"><span  class="text-black" >' . $phone . '</span></a></td>
                                
                                <td>' . $tehsil . '</td>
                                <td>
                                    <a href="https://wa.me/' . $code . $row['phone'] . '?text=गीता प्रिय ' . $row['name'] . ' जी , %0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A' . $message . '&attachment=' . $currentURL . '65f7fc772d3bf.png" target="_blank"><i class="fa-solid fs-3  fa-brands fa-whatsapp text-success "></i>
                                    </a>
                                </td>
                            </tr>
                            ';
                        }
                    } else
                    {
                        echo '
                    <tr>
                        <td class="text-center" colspan="7"> No data found </td>
                    </tr>
                    ';
                    }
                } else
                {
                    echo '
                    <tr>
                        <td class="text-center" colspan="7"> Select filter to view data</td>
                    </tr>
                    ';
                }
                ?>

            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>



    <script>
        let SelectState = (e) => {
            $.ajax({
                url: '_selectState.php',
                type: 'POST',
                data: {
                    country: e.value
                },
                success: function (response) {
                    let stateSelect = document.getElementById('stateSelect')
                    // console.log(response)
                    stateSelect.innerHTML = response;
                }
            })
        }
        let selectingdistrict = (e) => {

            $.ajax({
                url: '_selectDistrict.php',
                type: 'POST',
                data: {
                    country: e.value
                },
                success: function (response) {
                    let stateSelect = document.getElementById('districtSelect')
                    // console.log(response)
                    stateSelect.innerHTML = response;
                }
            })
        }
        let selectingtehsil = (e) => {

            $.ajax({
                url: '_selectTehsil.php',
                type: 'POST',
                data: {
                    country: e.value
                },
                success: function (response) {
                    let stateSelect = document.getElementById('tehsilSelect')
                    console.log(response)
                    stateSelect.innerHTML = response;
                }
            })
        }
        $('.totalCount').load('_totalProfiles.php');
        setInterval(() => {
            $('.totalCount').load('_totalProfiles.php');
        }, 3000);
    </script>




</body>

</html>