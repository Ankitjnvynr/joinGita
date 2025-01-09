<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
include("../partials/_db.php");
$csvnames = "";

if (isset($_POST['get-data'])) {
    $sql = "SELECT * FROM `users` ORDER BY `id` DESC ";
    $filters = array();
    $byCountry = $_POST['filterCountry'];
    $byState = $_POST['filterState'];
    $filterdistrict = $_POST['filterdistrict'];
    $bytehsil = $_POST['bytehsil'];
    $bydikshit = $_POST['filterDikshit'];
    $csvnames = $filterdistrict . ", " . $byState;

    if ($byCountry || $byState || $filterdistrict || $bydikshit) {
        $newStr = ' WHERE ';
    }

    if ($byCountry) {
        $filters = array();
        $byCountry = " country LIKE '" . $byCountry . "%'";
        array_push($filters, $byCountry);
    }
    if ($byState) {
        $byState = " state LIKE '" . $byState . "%'";
        array_push($filters, $byState);
    }
    if ($filterdistrict) {
        $filterdistrict = " district LIKE '" . $filterdistrict . "%'";
        array_push($filters, $filterdistrict);
    }
    if ($bytehsil) {
        $bytehsil = " tehsil LIKE '" . $bytehsil . "%'";
        array_push($filters, $bytehsil);
    }

    if ($bydikshit) {
        $bydikshit = " dikshit LIKE '" . $bydikshit . "%'";
        array_push($filters, $bydikshit);
    }
    $newStr = $newStr . implode(" AND ", $filters);
    $sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY name ASC;";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : Members Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: #f7e092;
            overflow-x: hidden;
        }

        .filterform select,
        .filter-item {
            flex: 1 0 150px;
        }

        .filterform>button {
            flex: 1 0 100px;
        }

        .tablediv {
            overflow-x: scroll;
        }

        th,
        td {
            text-align: center !important;
            border: none !important;
            background: transparent !important;
        }

        .table {
            background: transparent !important;
        }

        @media print {
            body {
                position: relative;
                margin: 0;
                padding: 0;
                height: 100%;
            }

            .print-background {
                position: fixed;
                top: 0;
                left: 0;
                width: 60px;
                height: 60px;
                z-index: -1;
                /* background-image: url('https://parivaar.gieogita.org/imgs/logo.png'); */
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;

            }

            th,
            td {
                background: transparent !important;
                border: none !important;
            }

            .table {
                background: transparent !important;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>

    <?php include '_options.php'; ?>

    <div class="container">
        <form action="" method="POST" class="filterform d-flex flex-wrap gap-1">
            <select required class="form-select form-select-sm" aria-label="Small select example" name="filterCountry"
                id="countrySelect" onchange="SelectState(this)">
                <option value="" selected>---Country---</option>
                <?php
                $optionSql = "SELECT DISTINCT `country` FROM `users` ORDER BY country ASC ";
                $result = $conn->query($optionSql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['country'] . '">' . $row['country'] . '</option>';
                }
                ?>
            </select>
            <select required name="filterState" class="form-select form-select-sm" aria-label="Small select example"
                id="stateSelect" onchange="selectingdistrict(this)">
                <option value="" selected>---State---</option>
            </select>
            <select name="filterdistrict" name="filterCity" class="form-select form-select-sm"
                aria-label="Small select example" id="districtSelect" onchange="selectingtehsil(this)">
                <option value="" selected>---District---</option>
            </select>
            <select name="bytehsil" class="form-select form-select-sm" aria-label="Small select example"
                id="tehsilSelect">
                <option value="" selected>---Tehsil---</option>
            </select>
            <select name="filterDikshit" class="form-select form-select-sm" aria-label="Small select example">
                <option value="" selected>Dikshit</option>
                <?php
                $optionSql = "SELECT DISTINCT `dikshit` FROM `users` ";
                $result = $conn->query($optionSql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['dikshit'] . '">' . $row['dikshit'] . '</option>';
                }
                ?>
            </select>
            <div class="d-flex align-items-center gap-1 filter-item form-control form-control-sm">
                <input type="checkbox" name="isAddress" id="isAddress" />
                <label for="isAddress">Is Address</label>
            </div>


            <button type="submit" name="get-data" class="btn btn-danger">Get Data ></button>

        </form>
    </div>

    <div class="container mt-2">
        <button class="btn btn-danger" onclick="downloadCSV()">Download CSV</button>
        <button id="export" class="btn btn-danger">Download PDF</button>
    </div>
    <div class="container tablediv" id="contentToExport">
        <table id="myTable" class="table table-borderless" style="font-size:12px;">
            <thead>
                <tr class="">

                    <div class="">
                        <th class="text-center">Sr</th>
                        <th>Name</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Dikshit</th>
                        <th class="text-center">State</th>
                        <th class="text-center">City</th>

                        <?php if (isset($_POST['isAddress'])) { ?>
                            <th>Address</th>
                        <?php } ?>
                    </div>
                    <th class="text-center">
                        hello world
                        <?php
                        if (isset($_POST['state'])) echo $_POST['state'];
                        ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dataheading = '';
                if (isset($_POST['get-data'])) {
                    $sr = 0;
                    $result = $conn->query($sql);
                    $totalresult = mysqli_num_rows($result);
                    if ($totalresult > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $sr++;
                            echo '
                            <tr>
                                <td>' . $sr . '</td>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['phone'] . '</td>
                                <td>' . $row['dikshit'] . '</td>
                                <td>' . $row['state'] . '</td>
                                <td>' . $row['tehsil'] . '</td>';
                            if (isset($_POST['isAddress'])) {
                                echo '<td>' . $row['address'] . '</td>';
                            }
                            echo '</tr>';
                            $dataheading = $row['state'];
                        }
                    } else {
                        echo '<tr><td colspan="7">No data found</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">Select filter to view data</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('export').addEventListener('click', function() {
            const content = document.getElementById('contentToExport').innerHTML;
            const printWindow = window.open('', '_blank', 'width=800,height=600');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Export PDF</title>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
                        <style>
                            body {
                                position: relative;
                                margin: 0;
                                padding: 0;
                                height: 100%;
                            }

                            .print-background {
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                z-index: -1;
                                background-image: url('../printbg.png'); 
                                background-size: contain;
                                background-repeat: no-repeat;
                                background-position: center;
                            }

                            

                            table {
                                width: 100%;
                                margin-top: 50px;
                                border-collapse: collapse;
                                background: transparent;
                            }

                            th,
                            td {
                                padding: 10px;
                                text-align: center;
                                border: none !important;
                                background: transparent !important;
                            }

                            @media print {
                                body {
                                    -webkit-print-color-adjust: exact !important;
                                }

                                .table {
                                    background: transparent !important;
                                }

                                th,
                                td {
                                    background: transparent !important;
                                }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="print-background"></div>
                        <div class="text-center fw-bold fs-4"> <?php echo $dataheading  ?></div>
                        ${content}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        });
    </script>

    <script>
        $('.totalCount').load('_totalProfiles.php');
        setInterval(() => {
            $('.totalCount').load('_totalProfiles.php');
        }, 3000);

        let SelectState = (e) => {
            $.ajax({
                url: '_selectState.php',
                type: 'POST',
                data: {
                    country: e.value
                },
                success: function(response) {
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
                success: function(response) {
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
                success: function(response) {
                    let stateSelect = document.getElementById('tehsilSelect')
                    // console.log(response)
                    stateSelect.innerHTML = response;
                }
            })
        }
    </script>
</body>

</html>