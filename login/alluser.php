<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
// ====================creating masik parwas tabel if not exist================
include("../partials/_db.php");
try {
    $sql = "CREATE TABLE masik_parvas (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        pic VARCHAR(100) NOT NULL,
        stat VARCHAR(50) DEFAULT '0',
        dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "table created succesfully";
    } else {
        // echo "not created ";
    }
} catch (exception $err) {
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

        input[type=radio] {
            display: none;
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

        .tab1,
        .tab2 {
            display: none;
        }

        #tab1:checked~.tab1 {
            display: flex;
            flex-direction: column;

        }

        #tab2:checked~.tab2 {
            display: flex;
            flex-direction: column;
        }

        .intro {
            animation: opacityani 0.5s cubic-bezier(0, 0, 0.02, 0.95);
        }

        @keyframes opacityani {
            from {
                opacity: 0;
                scale: 0.95;
            }

            to {
                opacity: 1;
                scale: 1;
            }
        }

        #allPics {
            display: grid;
            grid-template-columns: repeat(5, minmax(150px, 500px));
            gap: 5px;
        }

        .imgs {
            width: 100%;
        }

        .btn-close {
            top: 5%;
            right: 5%;
        }

        .custom-tooltip {
            --bs-tooltip-bg: rgb(213, 0, 0);
            --bs-tooltip-color: var(--bs-white);
        }
    </style>
</head>

<body>
    <!-- =============================toast=============================== -->
    <div class="toast align-items-center position-absolute " role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div id="toastmsg" class="toast-body">
                Deleted successfully!
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>



    <div class="container d-flex flex-row-reverse">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <input type="radio" name="tabs" id="tab1"><input type="radio" name="tabs" id="tab2" checked>

    <div class="container">
        <div class="row bg-danger-subtle py-2 my-2 rounded ">
            <div class="col d-flex justify-content-end"><label for="tab1"><span class="btn btn-danger">All Members</span></label></div>
            <div class="col"><label for="tab2"><span class="btn btn-danger">Masik Parwas</span></label></div>
        </div>
    </div>
    <div class="container ove my-3 tab1 intro" style="overflow-x:scroll">
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
    <div class="container tab2 intro  ">
        <div class="row m-auto">
            <div class="col-md m-auto">
                <div class="card mb-3 ">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex justify-content-center">
                            <img src="../imgs/guruji.webp" class="img-fluid rounded-start m-auto" alt="...">
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body  ">
                                <h3 class="card-title">Upload Masik Parwas Calender</h3>
                                <p class="card-text">
                                <form id="imgUpload" action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-floating mb-3">
                                        <input type="file" class="form-control" id="masikimage" name="masikimage" placeholder="name@example.com">
                                        <label for="floatingInput">Upload image</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <button type="submit" class="btn btn-danger">Upload</button> <span id="imguploadStatus" class="ml-3 text-danger fs-6"> </span>
                                    </div>
                                </form>
                                </p>
                                <p class="card-text"><small class="text-body-secondary">Please upload a image of size 388 X 400 in px</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="refres" class="btn btn-primary">Refresh

        </button>
        <div id="imgsdiv">
            <div class="row " id="allPics">
                <?php
                $sql = "SELECT * FROM `masik_parvas` ORDER BY `dt` DESC ";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo '
                    <div class="grid-item p-2 position-relative">
                        <input type="hidden" value = ' . $row['id'] . '  >
                        <img class="imgs  rounded bg-white m-md-1 my-1" src="../masik_parwas/' . $row['pic'] . '" alt="hello">
                        <button id = "del' . $row['id'] . '"  type="button" class="btn-close position-absolute " data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"   aria-label="Close"></button>
                    </div>
                    ';
                }
                ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        const toastElList = document.querySelectorAll('.toast')[0]
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElList)
    </script>
    <script>
        $(document).ready(function() {
            $('#imgUpload').on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "_masik-upload.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#imguploadStatus').html(data);
                        $('#masikimage').val('');
                        $("#imgsdiv").load(location.href + " #allPics");
                    }
                })
            })

            let closes = document.getElementsByClassName('btn-close');
            Array.from(closes).forEach((e)=>{
                e.addEventListener('click',(e)=>{
                    let iid = e.parentNode; 
                    console.log(iid)
                })
            })


            $('#refres').click(function(){
                console.log("cli")
                $("#imgsdiv").load(location.href + " #allPics");
            })

            $.each(closes,function(e,item){
                // console.log(item)
                $(item).click(function() {
                    imgid = $(this).data('imgid')
                    // console.log(imgid)
                    if (confirm("Are you sure to Delete ?")) {
                        console.log("yes")
                        let imgd = {
                            img: imgid
                        }
                        $.ajax({
                            url: "_delete.php",
                            type: "GET",
                            data: imgd,
                            success: function(data) {
                                console.log(data)
                                $('#toastmsg').text(data)
                                // $("#imgsdiv").load(location.href + " #allPics");
                                toastBootstrap.show()
                            }
                        })
                    } else {
                        console.log("no")
                    }
        
    
                })
            })

        })
    </script>
</body>

</html>