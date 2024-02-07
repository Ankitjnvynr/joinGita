<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}
// ====================creating masik parwas tabel if not exist================
include("../partials/_db.php");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 10px;
            background: #f7e092;
            overflow-x: hidden;
            cursor: url('imgs/cursor_PNG61.png') !important;
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
            animation: op 1s;
        }

        @keyframes op {
            0% {
                opacity: 1;
                transform: scale(1);
            }



            100% {
                opacity: 0;
                transform: scale(0);

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

    <!-- =============================toast end =============================== -->



    <div class="container d-flex justify-content-between">
        <div class="border border-danger rounded-3 bg-white fw-3 fs-5 text-danger fw-bold p-2 py-1"> Total Profiles :
            <span class="totalCount"></span>
        </div>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>


    <div class="container sticky-top">
        <div class=" bg-danger-subtle py-2 my-2 rounded d-flex gap-2 justify-content-center">
            <a class="btn btn-danger" href="all-card.php">All Profiles</a>
            <a class="btn btn-danger" href="masik-parwas.php">Masik Parwas</a>
            <a class="btn btn-danger" href="alluser.php">Report</a>
        </div>
    </div>
    <div class="container">
        <div class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
            <div class="form-floating mb-3 ">
                <select onclick="fillCountry()" id="countrySelect" style="min-width: 100px;" name="country"
                    class="form-control filterInput" onchange="loadpics(0,5)">

                </select>
                <label for="countrySelect">Country</label>
            </div>
            <div class="form-floating mb-3 ">
                <select id="stateSelect" style="min-width: 100px;" name="state" class='form-control'
                    onchange="loadpics(0,5)">

                </select>
                <label for="stateSelect">State</label>
            </div>
            <div class="form-floating mb-3 ">
                <select id="citySelect" style="min-width: 100px;" name="district" class='form-control'
                    onchange="loadpics(0,5)">

                </select>
                <label for="citySelect">city</label>
            </div>
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control filterInput" id="filterName" data-limit="5" data-start="5"
                    oninput="loadpics(0,5)">
                <label for="filterName">Name</label>
            </div>
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control filterInput" id="filterPhone" oninput="loadpics(0,5)"
                    onchange="restwindowtop()">
                <label for="filterPhone">Phone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control filterInput" id="filterEmail" oninput="loadpics(0,5)">
                <label for="filterEmail">Email address</label>
            </div>
        </div>

    </div>

    <div class="container  mt-4"><span class="bg-white p-2 rounded-3">Showing <span class="showing"></span>/<span
                class="totalCount"></span></span></div>
    <div class="container cardbox mt-4"></div>
    <div class="container text-center my-3"><button class="btn btn-success" onclick="loadMore(5,5)" id="loadMore">Load
            More</button></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="filterselect.js"></script>

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

        $(document).ready(function () {
            var limit = 50;
            var start = 0;

            $('.totalCount').load('_totalProfiles.php');
            setInterval(() => {
                $('.totalCount').load('_totalProfiles.php');
            }, 3000);


            function deleteScript() {
                let dels = document.getElementsByClassName('del');
                $.each(dels, function (e, item) {
                    $(item).off('click').on('click', function (e) {
                        cardid = $(this).attr('data-id');
                        if (confirm("Are you sure to Delete ?")) {
                            a = item.parentElement.parentElement.parentElement
                            let imgd = {
                                img: cardid
                            }
                            $.ajax({
                                url: "_deletecard.php",
                                type: "GET",
                                data: imgd,
                                success: function (data) {
                                    // console.log(data)
                                    $('#toastmsg').text(data)
                                    toastBootstrap.show();

                                    a.classList.add('op')
                                    setTimeout(() => {
                                        a.style.display = 'none';
                                    }, 1000);
                                    // loadpics(start, limit);
                                    var fltr = {
                                        filterName: $('#filterName').val(),
                                        phone: $('#filterPhone').val(),
                                        filterEmail: $('#filterEmail').val(),
                                        filterCountry: $('#countrySelect').val(),
                                        filterState: $('#stateSelect').val(),
                                        filterCity: $('#citySelect').val(),
                                        limit: limit,
                                        start: start,
                                    }
                                    $.ajax({
                                        url: '_filteredCardsNumber.php',
                                        type: 'POST',
                                        // cache: false,
                                        data: fltr,
                                        success: function (response) {
                                            // console.log(response)
                                            $('.showing').html(response)

                                        }
                                    })

                                }
                            })
                        } else {
                            console.log("no")
                        }
                    })
                })
            }


            deleteScript()

            var action = 'inactive';
            loadpics = (start, limit) => {
                console.log(start, limit)
                var fltr = {
                    filterName: $('#filterName').val(),
                    phone: $('#filterPhone').val(),
                    filterEmail: $('#filterEmail').val(),
                    filterCountry: $('#countrySelect').val(),
                    filterState: $('#stateSelect').val(),
                    filterCity: $('#citySelect').val(),
                    limit: limit,
                    start: start,
                }
                $.ajax({
                    url: '_loadcard.php',
                    type: 'POST',
                    // cache: false,
                    data: fltr,
                    success: function (response) {
                        // console.log(response)
                        $('.cardbox').html(response);
                        deleteScript()

                    }
                })
                $.ajax({
                    url: '_filteredCardsNumber.php',
                    type: 'POST',
                    // cache: false,
                    data: fltr,
                    success: function (response) {
                        // console.log(response)
                        $('.showing').html(response)

                    }
                })

            }
            loadMore = (start, limit) => {
                let dels = document.getElementsByClassName('del');
                start = dels.length;

                var fltr = {
                    filterName: $('#filterName').val(),
                    phone: $('#filterPhone').val(),
                    filterEmail: $('#filterEmail').val(),
                    filterCountry: $('#countrySelect').val(),
                    filterState: $('#stateSelect').val(),
                    filterCity: $('#citySelect').val(),
                    limit: limit,
                    start: start,
                }
                $.ajax({
                    url: '_loadcard.php',
                    type: 'POST',
                    // cache: false,
                    data: fltr,
                    success: function (response) {
                        if (response == '') {
                            $('#loadMore').html("No More Data")
                        } else {
                            $('.cardbox').append(response);
                            deleteScript()
                        }
                    }
                })


            }
            // loadpics()
            resetTop = false;
            restwindowtop = () => {
                resetTop = true;
            }

            if (action == 'inactive') {
                action = 'active';
                loadpics(start, limit);
            }
            // $(window).scroll(function () {
            //     if ($(window).scrollTop() + $(window).height() > $(".cardbox").height() && action == 'inactive') {
            //         action = 'active';
            //         if(resetTop){window. scrollTo(0,0), resetTop=false;}
            //         start = start + limit;
            //         setTimeout(function () {
            //             loadpics(start, limit);
            //             console.log(start, limit)
            //         }, 1000);
            //     }
            // });

        })

    </script>
</body>

</html>