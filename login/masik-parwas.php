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
        pic TEXT NOT NULL,
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
            text-align: left;
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
            /* border: 2px solid purple; */
            display: grid;
            grid-template-columns: repeat(5, minmax(20%, 350px));
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

        .op {
            opacity: 0;
            animation: op 5s;
        }

        @keyframes op {
            0% {
                opacity: 1;
            }

            60% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        * {
            box-sizing: border-box;
        }

        .picbg {
            background: rgb(34, 193, 195);
            background: linear-gradient(0deg, rgba(34, 193, 195, 0) 65%, rgba(255, 0, 0, 0.1) 35%);
        }

        .cardbox {
            transition: all 1s;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 500px));
            gap: 20px;
            /* grid-template-columns: repeat( auto-fill, minmax(300px, auto) ); */
            grid-template-columns: repeat(auto-fill, minmax(max-content, auto));
            justify-content: center;
            /* grid-template-columns: repeat(auto-fill, 40px);   */
        }

        .card {
            width: 100%;
            transition: all 1s;
        }

        .table td,
        .table {
            padding: 0;
            margin: 0;
        }

        .table {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- =============================toast=============================== -->
    <div class="toast align-items-center position-absolute border border-danger text-danger " role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div id="toastmsg" class="toast-body">
                Deleted Successfully!
            </div>
            <button type="button" class="btn-close me-2 m-auto bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>



    <div class="container d-flex flex-row-reverse">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>


    <?php include'_options.php'; ?>

    <div class="container tab2  <?php if ($_SESSION['intro']) {
                                    echo "intro";
                                } ?> ">
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
                                        <button type="submit" class="btn btn-danger">Upload</button> <span id="imguploadStatus" class="ml-3 text-danger fs-6 "> </span>
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
                        <button id = "' . $row['id'] . '"  type="button" class="cls btn-close position-absolute " data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"   aria-label="Close"></button>
                    </div>
                    ';
                }
                ?>

            </div>
        </div>
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
        function tt() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        }
        tt();
        const toastElList = document.querySelectorAll('.toast')[0]
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElList)
    </script>
    <script>
        function deleteScript() {
            let closes = document.getElementsByClassName('cls');
            // console.log(closes)

            $.each(closes, function(e, item) {
                // console.log(item)
                $(item).click(function(e) {
                    imgid = $(this).attr('id');
                    // console.log(imgid)
                    if (confirm("Are you sure to Delete ?")) {
                        // console.log("yes")
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
                                toastBootstrap.show();
                                $('#imgsdiv').load(' #allPics', function() {

                                    // Code to run after content is loaded
                                    tt();
                                    deleteScript();
                                });
                            }
                        })
                    } else {
                        console.log("no")
                    }
                })
            })
        }

        $(document).ready(function() {
            deleteScript()
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
                        // $("#imgsdiv").load(location.href + " #allPics");
                        $.ajax({
                            url: '_loadimgs.php',
                            success: function(data) {
                                $('#allPics').html(data);
                                $('#imgsdiv').load(' #allPics', function() {
                                    // Code to run after content is loaded
                                    tt();
                                    deleteScript();
                                });

                            },
                        });
                    }
                });
            });


            let delList = document.querySelectorAll('.listdel')
            // console.log(delList)
            deleteMember = () => {
                $.each(delList, function(e, item) {
                    $(item).click(function(e) {
                        console.log(item)
                        mid = $(this).attr('id');
                        mid = parseInt(mid.slice(4))
                        data = {
                            'mid': mid
                        }
                        if (confirm("Are you sure to delete ?")) {
                            $.ajax({
                                url: '_delmember.php',
                                type: 'POST',
                                data: data,
                                success: (data) => {
                                    // console.log(data)
                                    alert(data)
                                    $('#tble').load(' #myTable', function() {
                                        // Code to run after content is loaded

                                        deleteMember()
                                        console.log("hello world");
                                    });

                                }
                            })
                        } else {
                            console.log("no")
                        }
                    })
                })
            }
            deleteMember()
        })
    </script>
</body>

</html>
<?php $_SESSION['intro'] = false; ?>