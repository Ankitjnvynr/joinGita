<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
// ====================creating masik parwas tabel if not exist================
include("../partials/_db.php");
$totalBday = 0;
$birthday = null;



if (isset($_POST['submit'])) {
    $birthday = true;
    $birthDate = $_POST['birthDate'];
    $birthMonth = $_POST['birthMonth'];

    $query = "SELECT * FROM users WHERE MONTH(dob) = $birthDate AND DAY(dob) = $birthMonth";
    $result = mysqli_query($conn, $query);
    $totalBday = mysqli_num_rows($result);

    $msgsql = "SELECT * FROM `messages` WHERE `title` = 'Birthday'";
    $msgresult = mysqli_query($conn, $msgsql);
    $msgrow = mysqli_fetch_assoc($msgresult);
    $message = $msgrow['msg'];

}
if (isset($_POST['aniSubmit'])) {
    $birthday = false;
    $birthDate = $_POST['aniDate'];
    $birthMonth = $_POST['aniMonth'];

    $query = "SELECT * FROM users WHERE MONTH(aniver_date) = $birthDate AND DAY(aniver_date) = $birthMonth";
    $result = mysqli_query($conn, $query);
    $totalBday = mysqli_num_rows($result);

    $msgsql = "SELECT * FROM `messages` WHERE `title` = 'Aniversary'";
    $msgresult = mysqli_query($conn, $msgsql);
    $msgrow = mysqli_fetch_assoc($msgresult);
    $message = $msgrow['msg'];

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
    <title>GIEO Gita : Birthday</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        /* div.dt-button-collection {
            position: fixed;
            width: 900px !important;
            margin-top: 0px !important;
        } */
    </style>
</head>

<body>
    <!-- =============================toast=============================== -->
    <div class="toast align-items-center position-absolute border border-danger text-danger " role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div id="toastmsg" class="toast-body">
                Deleted Successfully!
            </div>
            <button type="button" class="btn-close me-2 m-auto bg-white" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>


    <!-- ---------------------modal start--------------------------- -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ---------------------modal end--------------------------- -->



    <div class="container d-flex flex-row-reverse">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>


    <?php include '_options.php'; ?>





    <div class="container">
        <div class="row my-3 ">
            <div class="col-md ">
                <form class="mt-3 bg-warning-subtle p-2 rounded shadow-sm" action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <input type="number" name="birthDate" class="form-control" placeholder="Enter Date"
                                aria-label="First name" oninput="validateDate(this)" required>
                        </div>
                        <div class="col">
                            <input type="number" name="birthMonth" class="form-control" placeholder="Enter Month"
                                aria-label="Last name" oninput="validateMonth(this)" required>
                        </div>
                        <div class="col">
                            <button name="submit" class="btn btn-danger">View all Birthday</button>
                        </div>
                    </div>
                </form>
                <form class="mt-3 bg-warning-subtle p-2 rounded shadow-sm" action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <input type="number" name="aniDate" class="form-control" placeholder="Enter Date"
                                aria-label="First name" oninput="validateDate(this)" required>
                        </div>
                        <div class="col">
                            <input type="number" name="aniMonth" class="form-control" placeholder="Enter Month"
                                aria-label="Last name" oninput="validateMonth(this)" required>
                        </div>
                        <div class="col">
                            <button name="aniSubmit" class="btn btn-danger">View all Aniversary</button>
                        </div>
                    </div>
                </form>
                <div class="mt-3 text-center bg-warning-subtle p-2 rounded shadow-sm"> 
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        View All Messages
                    </button>
                </div>
            </div>
            <div class="col-md">
                <table class="table table-striped bg-white rounded caption-top">
                    <caption>
                        <?php echo $birthday ? "All Birthday's : " . $totalBday : "All Aniversary : " . $totalBday ?>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">sr</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Send</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($totalBday > 0) {
                            $sr = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sr++;
                                $code = $country_code[$row['country']];
                                echo '
                            
                            <tr>
                            <th scope="row">' . $sr . '</th>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>
                            
                            <a href="https://wa.me/' . $code . $row['phone'] . '?text=' . $message . '&file=../imgs/' . $row['pic'] . '
                            " target="_blank"><i class="fa-solid fs-3  fa-brands fa-whatsapp text-success "></i></a>
                            </td>
                            </tr>
                            ';
                            }
                        } else {

                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="filterselect.js"></script>
    <script>

        function validateDate(input) {
            if (input.value < 1) {
                input.value = 1; // Reset to 1 if the value is negative or 0
            } else if (input.value > 31) {
                input.value = 31; // Reset to 31 if the value exceeds 31
            }
        }
        function validateMonth(input) {
            if (input.value < 1) {
                input.value = 1; // Reset to 1 if the value is negative or 0
            } else if (input.value > 31) {
                input.value = 31; // Reset to 31 if the value exceeds 31
            }
        }

    </script>


</body>

</html>