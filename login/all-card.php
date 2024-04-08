<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
// ====================creating masik parwas tabel if not exist================
include ("../partials/_db.php");
header('Content-Type: text/html; charset=utf-8');
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
    <!-- toast for update profile -->


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="updatedToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <!-- toast for update profile end -->





    <?php include '_options.php'; ?>

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
                id="tehsilSelect" onchange="loadpics(0,5)">
                <option value="" selected>---Tehsil---</option>
            </select>
            <input type="text" class="form-control form-control-sm" placeholder="Name" id="filterName"
                oninput="loadpics(0,5)">
            <input type="text" class="form-control form-control-sm" placeholder="Phone" id="filterPhone"
                oninput="loadpics(0,5)">
            <input type="text" class="form-control form-control-sm" placeholder="Email" id="filterEmail"
                oninput="loadpics(0,5)">
        </form>
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
        let createhash = (phone) => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "_createhash.php",
                    type: "POST",
                    data: {
                        phone: phone
                    },
                    success: (response) => {
                        resolve(response); // Resolve the promise with the response data
                    },
                    error: (error) => {
                        reject(error); // Reject the promise if there's an error
                    }
                });
            });
        };

        selectMessage = async (e) => {
            const secondChild = e.parentNode.childNodes[3];
            const memberName = e.parentNode.parentNode.parentNode.childNodes[1].childNodes[3].childNodes[1].innerText;
            const phoneNumber = e.parentNode.parentNode.parentNode.childNodes[1].childNodes[3].childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[3].childNodes[0].innerText;
            console.log(phoneNumber)
            const newText = e.value;
            let src = secondChild.getAttribute('href');
            let link = src.split('&');
            let myhash = await createhash(phoneNumber);
            console.log(myhash)
            

            for (let i = 0; i < link.length; i++) {
                if (link[i].startsWith('text=')) {
                    link[i] = 'text=' + 'गीता प्रिय ' + memberName + ' जी %0A🌹जय श्री कृष्ण🌹%0A' + encodeURIComponent(newText) + ' %0A %0ATo view profile Click here- '+'https://parivaar.gieogita.org/member.php?member='+ myhash;
                    break;
                }
            }
            href = link.join('&');
            console.log(href)
            console.log(href)
            secondChild.setAttribute('href', href);


        }
    </script>

    <script>
        function tt() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        }
        tt();
        const toastElList = document.querySelectorAll('.toast')[0]
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElList);

        let toastmsg = document.getElementById('toastmsg');
        toastmsg.innerHTML = "Updated Success!";
        // toastBootstrap.show();
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
                                        filterDistrict: $('#districtSelect').val(),
                                        filterTehsil: $('#tehsilSelect').val(),
                                        limit: "50",
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
                    filterDistrict: $('#districtSelect').val(),
                    filterTehsil: $('#tehsilSelect').val(),
                    limit: "50",
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
                    filterDistrict: $('#districtSelect').val(),
                    filterTehsil: $('#tehsilSelect').val(),
                    limit: "50",
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


        })
    </script>
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
                    loadpics(0, 5)
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
                    loadpics(0, 5)
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
                    loadpics(0, 5)
                }
            })
        }
    </script>
    <script>

        const updatedToast = document.getElementById('updatedToast')
        const toastBootstrapupdate = bootstrap.Toast.getOrCreateInstance(updatedToast)

    </script>

    <?php



    ?>

</body>

</html>