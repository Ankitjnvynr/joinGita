<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
include ("../partials/_db.php");
$values = false;
$done = false;


// filtering data
if (isset($_POST['add-tehsil']))
{
    $country = $_POST['filterCountry'];
    $state = $_POST['filterState'];
    $district = $_POST['filterdistrict'];
    $addingtehsils = $_POST['addingtehsils'];

    $tehsils = explode(",", $addingtehsils);

    // Prepare the SQL statement
    $sql = "INSERT INTO `allselect`(`country`, `state`, `district`, `tehsil`) VALUES ";
    $values = array();

    // Generate values for multiple rows
    foreach ($tehsils as $tehsil)
    {
        // Escape values to prevent SQL injection
        $values[] = "('" . $conn->real_escape_string($country) . "', '" . $conn->real_escape_string($state) . "', '" . $conn->real_escape_string($district) . "', '" . $conn->real_escape_string($tehsil) . "')";
    }

    // Append values to the SQL statement
    echo $sql .= implode(", ", $values);

    // Execute the query
    if ($conn->query($sql))
    {
        echo "Records inserted successfully.";
        $done = true;
    } else
    {
        if ($conn->errno == 1062)
        {
            echo "Error: Duplicate entry found. Record not inserted.";
        } else
        {
            echo "Error: " . $conn->error;
        }
    }
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

        .filterform input {
            flex: 1 0 150px;
        }

        .filterform>button {
            flex: 1 0 100px;
        }

        textarea::placeholder {
            opacity: 0.7 !important;
            font-size: 0.9rem;            
        }
    </style>
</head>

<body>

    <?php include '_options.php'; ?>

    <!----------------------- filters input boxes--------------------- -->
    <div class="container">
        <form action="" method="POST" class="">
            <div class="filterform d-flex flex-wrap gap-1">
                <input required class="form-select form-select-sm" aria-label="Small select example"
                    name="filterCountry" list="countrySelect" onkeyup="SelectState(this)" placeholder="Type Country">
                <datalist id="countrySelect">
                    <option value="" selected>---Country---</option>
                    <?php
                    $optionSql = "SELECT DISTINCT `country` FROM `users` ";
                    $result = $conn->query($optionSql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['country'] . '">' . $row['country'] . '</option>';
                    }
                    ?>
                </datalist>

                <input required class="form-select form-select-sm" aria-label="Small select example" name="filterState"
                    list="stateSelect" onkeyup="selectingdistrict(this)" placeholder="Type State">
                <datalist id="stateSelect">
                    <option value="" selected>---Country---</option>
                </datalist>

                <input required class="form-select form-select-sm" aria-label="Small select example"
                    name="filterdistrict" list="districtSelect" placeholder="Type District">
                <datalist id="districtSelect">
                    <option value="" selected>---Country---</option>
                </datalist>

            </div>
            <textarea required name="addingtehsils" rows="5" placeholder="Type tehsil here.
if you want to add multiple tehsils seperate them by comma." class="form-control my-1" id="addingtehsils"></textarea>
            <button type="submit" name="add-tehsil" class="btn btn-danger">Add Tehsil ></button>
        </form>
    </div>

    <div class="container">
        <?php
        if ($values)
        {
            echo '
            You were added
            <span class="bg-warning-subtle rounded px-1">
            ';
        }

        if ($done)
        {
            foreach ($tehsils as $tehsil)
            {
                echo $tehsil . ', ';
            }
        }

        if ($values)
        {
            echo ' </span>  in <span class="bg-warning-subtle rounded px-1 mx-1"> ' . $district . ' </span> District.';
        }
        ?>

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