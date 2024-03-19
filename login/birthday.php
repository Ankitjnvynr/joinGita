<?php
$currentURL = "http://$_SERVER[HTTP_HOST]/imgs/";


session_start();
if (!isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
// ====================creating masik parwas tabel if not exist================
include ("../partials/_db.php");
$totalBday = 0;
$birthday = null;

if (isset ($_POST['bdaySubmit']))
{
    $birthday = true;
    $birthDate = isset ($_POST['birthDate']) ? $_POST['birthDate'] : date('d');
    $birthMonth = isset ($_POST['birthMonth']) ? $_POST['birthMonth'] : date('m');
    $messageSelect = isset ($_POST['messageSelect']) ? $_POST['messageSelect'] : "Birthday";

    $query = "SELECT * FROM users WHERE MONTH(dob) = $birthMonth AND DAY(dob) =$birthDate ";
    $resultb = mysqli_query($conn, $query);

    $totalBday = mysqli_num_rows($resultb);

    $msgsql = "SELECT * FROM `messages` WHERE `title` = '$messageSelect'";
    $msgresult = mysqli_query($conn, $msgsql);
    $msgrow = mysqli_fetch_assoc($msgresult);
    $message = $msgrow['msg'];

}
$aniverfinding = false;
if (isset ($_POST['aniSubmit']))
{
    $aniverfinding = true;
    $birthday = false;
    $birthDate = $_POST['aniDate'];
    $birthMonth = $_POST['aniMonth'];
    $messageSelect = isset ($_POST['messageSelect']) ? $_POST['messageSelect'] : "Birthday";

    $query = "SELECT * FROM users WHERE MONTH(aniver_date) = $birthMonth AND DAY(aniver_date) = $birthDate ";
    $resultb = mysqli_query($conn, $query);
    $totalBday = mysqli_num_rows($resultb);

    $msgsql = "SELECT * FROM `messages` WHERE `title` = '$messageSelect'";
    $msgresult = mysqli_query($conn, $msgsql);
    $msgrow = mysqli_fetch_assoc($msgresult);
    $message = urldecode($msgrow['msg']);
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

        .deleteditem {
            animation: op 1s ease-in-out;
        }

        @keyframes op {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(0)
            }
        }
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
        <div class="modal-dialog modal-lg   ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Messages</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="allMessage" class=" modal-body d-flex flex-column gap-2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset ($_POST['newmsgSubmit']))
    {
        $newmsgtitle = $_POST['newmsgtitle'];
        $newmsg = $_POST['newmsg'];
        // $newmsg = htmlspecialchars($newmsg, ENT_QUOTES, 'UTF-8');
        $newmsg = urlencode($newmsg);

        // Establish database connection (assuming $conn is your database connection object)
    
        $sql = "INSERT INTO `messages` (`title`, `msg`) VALUES ('$newmsgtitle', '$newmsg')";
        $result = $conn->query($sql); // Execute the SQL query using $conn->query()
        if ($result)
        {
            $messageAdded = true;
        } else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Messages</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-2">
                        <div class="form-control">
                            <input class="form-control" maxlength="10" name="newmsgtitle" placeholder="Title"
                                type="text" required>
                        </div>
                        <div class="form-control">
                            <textarea class="form-control" name="newmsg" placeholder="Enter Message"
                                rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="newmsgSubmit" class="btn btn-danger">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
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
                <form class="mt-3 bg-warning-subtle px-2 rounded shadow-sm" action="" method="POST">
                    <div class="row d-flex flex-wrap ">
                        <div class="col my-2">
                            <input type="number" name="birthDate" class="form-control" placeholder="Enter Date"
                                aria-label="First name" oninput="validateDate(this)" required>
                        </div>
                        <div class="col my-2">
                            <input type="number" name="birthMonth" class="form-control" placeholder="Enter Month"
                                aria-label="Last name" oninput="validateMonth(this)" required>
                        </div>
                        <div class="col my-2">
                            <select class="form-select form-select-sm" name="messageSelect"
                                aria-label="Small select example">
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
                        </div>
                        <div class="col-md my-2  text-center">
                            <button name="bdaySubmit" class="btn btn-danger">View all Birthday</button>
                        </div>
                    </div>
                </form>
                <form class="mt-3 bg-warning-subtle px-2 rounded shadow-sm" action="" method="POST">
                    <div class="row">
                        <div class="col my-2">
                            <input type="number" name="aniDate" class="form-control" placeholder="Enter Date"
                                aria-label="First name" oninput="validateDate(this)" required>
                        </div>
                        <div class="col my-2">
                            <input type="number" name="aniMonth" class="form-control" placeholder="Enter Month"
                                aria-label="Last name" oninput="validateMonth(this)" required>
                        </div>
                        <div class="col my-2">
                            <select class="form-select form-select-sm" name="messageSelect"
                                aria-label="Small select example">
                                <?php
                                $message_select_sql = "SELECT * FROM `messages` ";
                                $message_select_result = mysqli_query($conn, $message_select_sql);
                                while ($message_select_row = mysqli_fetch_assoc($message_select_result))
                                {

                                    $selected = $message_select_row['title'] == 'Aniversary' ? "Selected" : "";

                                    echo '<option value="' . $message_select_row['title'] . '" ' . $selected . '>' . $message_select_row['title'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md my-2  text-center">
                            <button name="aniSubmit" class="btn btn-danger">All Aniversary</button>
                        </div>
                    </div>
                </form>
                <div class="mt-3 text-center bg-warning-subtle p-2 rounded shadow-sm d-flex gap-2 justify-center">
                    <!-- Button trigger modal -->
                    <div class="m-auto">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            View All Messages
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#newModal">
                            Add New
                        </button>
                    </div>
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
                            <th scope="col">
                                <?php echo $birthday ? "DOB" : "Aniversary" ?>
                            </th>
                            <th scope="col">Send</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($totalBday > 0)
                        {
                            $sr = 0;
                            while ($row = mysqli_fetch_assoc($resultb))
                            {
                                $sr++;
                                $code = $country_code[$row['country']];
                                $targetDate = $birthday ? $row['dob'] : $row['aniver_date'];
                                echo '
                            
                            <tr>
                            <th scope="row">' . $sr . '</th>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $targetDate . '</td>
                            <td>
                            
                            <a href="https://wa.me/' . $code . $row['phone'] . '?text=गीता प्रिय ' . $row['name'] . ' जी , %0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A' . $message . '&attachment=' . $currentURL . '65f7fc772d3bf.png" target="_blank"><i class="fa-solid fs-3  fa-brands fa-whatsapp text-success "></i></a>
                            </td>
                            </tr>
                            ';
                            }
                        } else
                        {
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

    <script>
        function validateDate(input) {
            if (input.value < 1) {
                input.value = "";
            } else if (input.value > 31) {
                input.value = 31;
            }
        }

        function validateMonth(input) {
            if (input.value < 1) {
                input.value = "";
            } else if (input.value > 12) {
                input.value = 12;
            }
        }
        let loadMessages = () => {

            $.ajax({
                url: '_viewAllMessages.php',
                method: 'POST',
                success: function (response) {
                    $('#allMessage').html(response)
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error('Error updating content:', error);
                }
            });
        }

        function updateContent(textarea, sr) {
            var newText = textarea.value;
            $.ajax({
                url: '_update_message.php',
                method: 'POST',
                data: {
                    sr: sr,
                    msg: newText
                },
                success: function (response) {
                    // Handle success

                    console.log('Content updated successfully');
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error('Error updating content:', error);
                }
            });
        }
        let deleteMsg = (e, sr) => {
            let card = e.parentNode.parentNode;
            $.ajax({
                url: '_deletemsg.php',
                method: 'POST',
                data: {
                    sr: sr,
                },
                success: function (response) {
                    card.classList.add("deleteditem");
                    setInterval(() => {
                        card.style.display = "none";
                    }, 1000);
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error('Error updating content:', error);
                }
            });
        }

        loadMessages()
    </script>


</body>

</html>