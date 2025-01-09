<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['type']!='admin'){
    header("location: index.php");
    exit;
}
include("../../partials/_db.php");

// Add CORS headers
header('Access-Control-Allow-Origin: https://parivaar.gieogita.org/'); // Use a specific domain instead of * for security in production
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Send response to OPTIONS request and exit to avoid further processing
    header('HTTP/1.1 200 OK');
    exit;
}

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

    .fs-7 {
        font-size: 0.85rem;
    }
    </style>
</head>

<body>

    <?php include '_api_option.php'; ?>

    <!----------------------- filters input boxes--------------------- -->
    <div class="container">
        <a href="add-file.php" class="btn btn-danger float-end">Add New</a>
        <a href="index.php" class="btn btn-danger float-start">Media</a>
    </div>
    <h5 class="text-center my-3">Preparing to send message</h5>
    <div class="container bg-light p-1">
        <form id="getDataForm" action="" method="POST" class="filterform d-flex flex-wrap gap-1">
            <select required class="form-select form-select-sm" aria-label="Small select example" name="filterCountry"
                id="countrySelect" onchange="SelectState(this)">
                <option value="" selected>---Country---</option>
                <?php
                $optionSql = "SELECT DISTINCT `country` FROM `users` ";
                $result = $conn->query($optionSql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['country'] . '">' . $row['country'] . '</option>';
                }
                ?>
            </select>
            <select  name="filterState" class="form-select form-select-sm" aria-label="Small select example"
                id="stateSelect" onchange="selectingdistrict(this)">
                <option value="" selected>---State---</option>
            </select>
            <select name="filterdistrict"  name="filterCity" class="form-select form-select-sm"
                aria-label="Small select example" id="districtSelect" onchange="selectingtehsil(this)">
                <option value="" selected>---District---</option>
            </select>
            <select name="bytehsil" class="form-select form-select-sm" aria-label="Small select example"
                id="tehsilSelect">
                <option value="" selected>---Tehsil---</option>
            </select>
            <select name="dikshit" class="form-select form-select-sm" aria-label="Small select example" id="dikshit">
                <option value="" selected>---dikshit---</option>
                <?php
                $dikshit_select_sql = "SELECT DISTINCT dikshit FROM `users` ";
                $dikshit_select_result = mysqli_query($conn, $dikshit_select_sql);
                while ($dikshit_select_row = mysqli_fetch_assoc($dikshit_select_result)) {
                    $selected = $dikshit_select_row['dikshit'] == 'Birthday' ? "Selected" : "";
                    echo '<option value="' . $dikshit_select_row['dikshit'] . '" ' . $selected . '>' . $dikshit_select_row['dikshit'] . '</option>';
                }
                ?>
            </select>
            <select class="form-select form-select-sm inputfields" name="messageSelect"
                aria-label="Small select example" required>
                <?php
                $message_select_sql = "SELECT * FROM `messages` ";
                $message_select_result = mysqli_query($conn, $message_select_sql);
                while ($message_select_row = mysqli_fetch_assoc($message_select_result)) {
                    $selected = $message_select_row['title'] == 'Birthday' ? "Selected" : "";
                    echo '<option value="' . $message_select_row['title'] . '" ' . $selected . '>' . $message_select_row['title'] . '</option>';
                }
                ?>
            </select>

            <div class="form-check inputfields bg-light border bg-white rounded  px-2">
                <input class="form-check-input mx-1" type="checkbox" name="executive" value="karykarini" id="executive">
                <label class="form-check-label" for="executive">
                    Karykarini
                </label>
            </div>
            <div class="form-check inputfields bg-light border bg-white rounded  px-2">
                <input class="form-check-input mx-1" type="checkbox" name="trustee" value="trustee" id="trustee">
                <label class="form-check-label" for="trustee">
                    Trustee
                </label>
            </div>

            <?php
            // Fetch data from api_content table
            $sql = "SELECT id, image_title, image_path, image_caption, dt FROM api_content";
            $result = $conn->query($sql);
            ?>


            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Media</th>
                        <th>Title</th>
                        <th>Caption</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input class='form-check-input' type='checkbox' name='selectedMedia[]' value='" . $row['id'] . "'></td>";
                            echo "<td>";
                            $fileExtension = pathinfo($row['image_path'], PATHINFO_EXTENSION);
                            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                echo "<img src='../../imgs/api_content/" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['image_title']) . "' style='max-width: 70px; max-height: 70px;'>";
                            } elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv'])) {
                                echo "<video width='70' height='auto' controls>";
                                echo "<source src='../../imgs/api_content/" . htmlspecialchars($row['image_path']) . "' type='video/" . $fileExtension . "'>";
                                echo "Your browser does not support the video tag.";
                                echo "</video>";
                            }
                            echo "</td>";
                            echo "<td>" . htmlspecialchars($row['image_title']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['image_caption']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <button id="sendBtn" type="submit" name="get-data" class="btn btn-danger">send ></button>
        </form>
    </div>

    <div class="container fs-7">
        <table class="table my-3 fs-7">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="resultData">


            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="../../js/api.js"></script>


</body>

</html>