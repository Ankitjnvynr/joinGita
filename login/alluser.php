<?php
session_start();
if (!isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}

include ("../partials/_db.php");



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : All users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.0.1/css/searchBuilder.dataTables.min.css">

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



    <div class="container d-flex flex-row-reverse">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>


    <?php include '_options.php'; ?>
    <div class="container">
        <div class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
            <div class="form-floating mb-3 ">
                <select onclick="fillCountry()" id="countrySelect" style="min-width: 100px;" name="country"
                    class="form-control filterInput" onchange="loadpics()">

                </select>
                <label for="countrySelect">Country</label>
            </div>
            <div class="form-floating mb-3 ">
                <select id="stateSelect" style="min-width: 100px;" name="state" class='form-control'
                    onchange="loadpics()">

                </select>
                <label for="stateSelect">State</label>
            </div>
            <div class="form-floating mb-3 ">
                <select id="citySelect" style="min-width: 100px;" name="district" class='form-control'
                    onchange="loadpics()">

                </select>
                <label for="citySelect">city</label>
            </div>
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control filterInput" id="filterName" placeholder="Enter"
                    oninput="loadpics()">
                <label for="filterName">Name</label>
            </div>
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control filterInput" id="filterPhone" placeholder="Enter"
                    oninput="loadpics()">
                <label for="filterPhone">Phone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control filterInput" id="filterEmail" placeholder="name@example.com"
                    oninput="loadpics()">
                <label for="filterEmail">Email address</label>
            </div>
        </div>
    </div>
    <div class="container ove my-3 tab1 ">
        <div class="row">
            <div class="col-md-12 my-4">


                <div class="card">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body d-flex ">
                            <input type="file" name="excel_file" class="form-control" required accept=".csv">
                            <input type="submit" name="import" class="btn btn-success mx-2" value="Import">
                            <a href="GIEO_member_upload_format.csv" class="btn btn-primary">Download_format</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div id="tble" class="allList" style="overflow-x:scroll"> -->

        <div style="overflow-x:scroll">
            <table style=" overflow-x:scroll;" id="myTable">
                <thead>
                    <tr>
                        <th>sr</th>
                        <th>Name <input type="text" class="form-control filter-input" data-column="1"></th>
                        <th>Phone <input type="text" class="form-control filter-input" data-column="2"></th>
                        <th>Email <input type="text" class="form-control filter-input" data-column="3"></th>
                        <th>Dikshit</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Interest</th>
                        <th>Occupation</th>
                        <th>Education</th>
                        <th>DOB</th>
                        <th>Anniversary</th>

                        <!-- Add more columns based on your table structure -->
                    </tr>
                </thead>
                <tbody></tbody>
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
    <!-- ------------------data table cdn -------------- -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.0.1/js/dataTables.searchBuilder.min.js"></script>


    <!-- ------------------data table end -------------- -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "ajax": {
                    "url": "_loadTable.php",
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "phone" },
                    { "data": "email" },
                    { "data": "dikshit" },
                    { "data": "country" },
                    { "data": "state" },
                    { "data": "district" },
                    { "data": "interest" },
                    { "data": "occupation" },
                    { "data": "education" },
                    { "data": "dob" },
                    { "data": "aniver_date" }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                select: true,
                searchBuilder: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], // Indexes of columns to be included in search
                    conditions: {
                        string: {
                            '=': 'Equals',
                            '!=': 'Not equal',
                            '<': 'Less than',
                            '>': 'Greater than',
                            '<=': 'Less than or equal to',
                            '>=': 'Greater than or equal to'
                        }
                        // Define conditions for other data types as needed
                    }
                }
            });
            $('.filter-input').keyup(function () {

                // Perform filtering on the DataTable
                if (searchText != "") {
                    var columnIndex = $(this).data('column'); // Get column index from data attribute
                    var searchText = $(this).val().toLowerCase(); // Get value entered in the input box
                    $('#myTable').DataTable().column(columnIndex).search(searchText).draw();
                }
            });
        });

    </script>
</body>

</html>