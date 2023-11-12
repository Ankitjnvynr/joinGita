<?php


session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : All users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        body {
            margin: 10px;
            background: #f7e092;
            overflow-x: hidden;
        }

        table {
            background: transparent;
        }

        td,
        th {
            font-size: 13px;
            width: fit-content;
            max-width: 200px;
            text-align: center;
            /* border: 1px solid red; */
            /* border-radius: 5px; */
            background-color: transparent !important;
        }

        .w-150 {
            min-width: 150px;
        }



        @media (min-width: 1400px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 1450px;
            }
        }

        div.dt-button-collection {
            position: fixed;
            width: 900px !important;
            margin-top: 0px !important;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-row-reverse">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <div class="container ove my-3 " style="overflow-x:scroll">
        <table class="table caption-top shadow rounded" id="myTable">
            <caption>List of users</caption>
            <thead>
                <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Country</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Whatsapp</th>
                    <th scope="col">Email</th>
                    <th scope="col">Dikshit</th>
                    <th scope="col">Marital_Status</th>
                    <th scope="col">State</th>
                    <th scope="col">District</th>
                    <th scope="col">Tehsil</th>
                    <th scope="col">Address</th>
                    <th scope="col">Intrest_Field</th>
                    <th scope="col">Occupation</th>
                    <th scope="col">Education</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Aniversary</th>
                    <th scope="col">Message</th>

                </tr>
            </thead>
            <tbody>

                <?php

                $sr = 0;
                include("../partials/_db.php");
                $sql = "SELECT * FROM `users` ";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $sr++;
                    $country = $row['country'];
                    $name = $row['name'];
                    $phone = $row['phone'];
                    $whatsapp = $row['whtsapp'];
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
                    $message = $row['message'];
                    echo '
                            <tr>
                            <th scope="row">' . $sr . '</th>
                            <td>' . $country . '</td>
                            <td>' . $name . '</td>
                            <td>' . $phone . '</td>
                            <td>' . $whatsapp . '</td>
                            <td>' . $email . '</td>
                            <td>' . $dikshit . '</td>
                            <td>' . $marital_status . '</td>
                            <td>' . $state . '</td>
                            <td>' . $district . '</td>
                            <td>' . $tehsil . '</td>
                            <td class="w-150" >' . $address . '</td>
                            <td>' . $wing . '</td>
                            <td>' . $occupation . '</td>
                            <td>' . $education . '</td>
                            <td>' . $dob . '</td>
                            <td>' . $aniver_date . '</td>
                            <td class="w-150" >' . $message . '</td>
                            </tr>
                            ';
                }
                ?>


            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>