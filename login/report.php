<?php
session_start();
if (!isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
include ("../partials/_db.php");



// filtering data
if (isset ($_POST['get-data']))
{
    $sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

    $filters = array();
    $byCountry = $_POST['filterCountry'];
    $byState = $_POST['filterState'];
    $filterdistrict = $_POST['filterdistrict'];
    $bytehsil = $_POST['bytehsil'];
    $bydikshit = $_POST['filterDikshit'];

    if ($byCountry || $byState || $byCity || $bydikshit)
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

    if ($bydikshit)
    {
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
            <select name="filterDikshit" class="form-select form-select-sm" aria-label="Small select example">
                <option value="" selected>Dikshit</option>
                <?php
                $optionSql = "SELECT DISTINCT `dikshit` FROM `users` ";
                $result = $conn->query($optionSql);
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="' . $row['dikshit'] . '">' . $row['dikshit'] . '</option>';
                }
                ?>
            </select>


            <button type="submit" name="get-data" class="btn btn-danger">Get Data ></button>

        </form>
    </div>

    <!-- -------output data list ------- -->

    <div class="container mt-2">
        <button class="btn btn-danger" onclick="downloadCSV()">Download CSV</button>
        <button class="btn btn-danger" onclick="downloadPDFWithPDFMake()">Download PDF</button>
    </div>
    <div class="container tablediv">

        <table id="myTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">City</th>
                    <th scope="col">Dikshit</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Anniversary</th>
                    <!-- <th scope="col">Join On</th> -->
                    <!-- <td>' . substr($joinOn,0,10) . '</td> -->
                </tr>
            </thead>
            <tbody>
                Showing :-
                <?php
                if (isset ($_POST['get-data']))
                {
                    $sr = 0;
                    $result = $conn->query($sql);
                    echo $totalresult = mysqli_num_rows($result);
                    if ($totalresult > 0)
                    {
                        while ($row = mysqli_fetch_array($result))
                        {
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
                                <td>' . $dikshit . '</td>
                                <td>' . $dob . '</td>
                                <td>' . $aniver_date . '</td>
                                
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.77/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.77/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.77/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.77/vfs_fonts.js"></script>


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
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        function downloadPDF() {
            const doc = new jsPDF();
            doc.autoTable({
                html: '#myTable'
            });
            doc.save('table.pdf');
        }
    </script>


    <script>
        // Create a new Date object which represents the current date and time
        const currentDate = new Date();

        // Get the current date components
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth() + 1; // Month is zero-based, so we add 1
        const day = currentDate.getDate();

        // Construct the date string
        const dateString = `${year}-${month < 10 ? '0' : ''}${month}-${day < 10 ? '0' : ''}${day}`;

        console.log(dateString); // Output format: YYYY-MM-DD

        function downloadCSV() {
            const table = document.getElementById('myTable');
            const rows = table.querySelectorAll('tr');
            let csv = [];
            for (let i = 0; i < rows.length; i++) {
                let row = [],
                    cols = rows[i].querySelectorAll('td, th');
                for (let j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
                }
                csv.push(row.join(','));
            }
            const csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', `GIEO GITA ${dateString}.csv`);
            document.body.appendChild(link);
            link.click();
        }
    </script>
    <script>
        // JavaScript to show/hide the loader
        document.addEventListener("DOMContentLoaded", function (event) {
            // When the DOM content is loaded
            var loader = document.getElementById("loader");


            // Hide loader and show content after 2 seconds (simulate loading time)
            setTimeout(function () {
                loader.style.display = "none";

            }, 2000);
        });
    </script>

    <!-- ////////// -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.1.0/papaparse.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    <button onclick="downloadPDFWithPDFMake()">Export PDF</button>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.77/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.77/vfs_fonts.js"></script>


    <script>
        function downloadPDFWithPDFMake() {
            var rows = document.querySelectorAll("#myTable tr");
            var data = [];
            for (var i = 0; i < rows.length; i++) {
                var rowData = [];
                var cells = rows[i].querySelectorAll("td, th");
                for (var j = 0; j < cells.length; j++) {
                    const select = cells[j].querySelector("select");
                    if (select) {
                        rowData.push({
                            text: select.value,
                            style: 'tableData'
                        });
                    } else {
                        rowData.push({
                            text: cells[j].innerText,
                            style: 'tableData'
                        });
                    }
                }
                data.push(rowData);
            }


            var docDefinition = {
                header: {
                    text: 'Your awesome table',
                    alignment: 'center'
                },
                footer: function (currentPage, pageCount) {
                    return ({
                        text: `Page ${currentPage} of ${pageCount}`,
                        alignment: 'center'
                    });
                },
                content: [{
                    style: 'tableExample',
                    table: {
                        headerRows: 1,
                        body: [
                            ...data
                        ]
                    },
                    layout: {
                        fillColor: function (rowIndex) {
                            return (rowIndex % 2 === 0) ? '#E6E6FA' : null;
                        }
                    },
                },],
                styles: {
                    tableExample: {
                        // table style
                    },
                    tableData: {
                        // table data style
                    },
                },
            };
            pdfMake.createPdf(docDefinition).download('Your awesome table');
        }
        $('.totalCount').load('_totalProfiles.php');
        setInterval(() => {
            $('.totalCount').load('_totalProfiles.php');
        }, 3000);
    </script>





    <!-- /. -->



</body>

</html>