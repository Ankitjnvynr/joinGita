<?php

session_start();
if (!isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
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


    <!-- -------------------------------------cropper modal ----------------- -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crop Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body cropper-container">
                    <img id="cropperImage" src="" alt="Image to crop">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveCroppedImage" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------cropper modal end----------------- -->






    <?php include '_options.php'; ?>

    <div class="container">
        <div class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
            <!-- <div class="form-floating mb-3 ">
                <select onclick="fillCountry()" id="countrySelect" style="min-width: 100px;" name="country"
                    class="form-control filterInput" onchange="loadpics(0,5)">

                </select>
                <label for="countrySelect">Country</label>
            </div> -->
            <!-- <div class="form-floating mb-3 ">
                <select id="stateSelect" style="min-width: 100px;" name="state" class='form-control'
                    onchange="loadpics(0,5)">

                </select>
                <label for="stateSelect">State</label>
            </div> -->
            <!-- <div class="form-floating mb-3 ">
                <select id="citySelect" style="min-width: 100px;" name="district" class='form-control'
                    onchange="loadpics(0,5)">

                </select>
                <label for="citySelect">city</label>
            </div> -->
            <!-- <div class="form-floating mb-3 ">
                <input type="text" class="form-control filterInput" id="filterName" oninput="loadpics(0,5)">
                <label for="filterName">Name</label>
            </div> -->
            <!-- <div class="form-floating mb-3 ">
                <input type="text" class="form-control filterInput" id="filterPhone" oninput="loadpics(0,5)">
                <label for="filterPhone">Phone</label>
            </div> -->
            <!-- <div class="form-floating mb-3">
                <input type="text" class="form-control filterInput" id="filterEmail" oninput="loadpics(0,5)">
                <label for="filterEmail">Email address</label>
            </div> -->
        </div>

    </div>
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
            <!-- <select name="filterDikshit" class="form-select form-select-sm" aria-label="Small select example">
                <option value="" selected>Dikshit</option>
                <?php
                // $optionSql = "SELECT DISTINCT `dikshit` FROM `users` ";
                // $result = $conn->query($optionSql);
                // while ($row = mysqli_fetch_assoc($result))
                // {
                //     echo '<option value="' . $row['dikshit'] . '">' . $row['dikshit'] . '</option>';
                // }
                ?>
            </select> -->
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
        selectMessage = (e) => {
            const secondChild = e.parentNode.childNodes[3];
            const memberName = e.parentNode.parentNode.parentNode.childNodes[1].childNodes[3].childNodes[1].innerText;
            console.log(memberName);
            const newText = e.value;
            let src = secondChild.getAttribute('href');
            let link = src.split('&');

            for (let i = 0; i < link.length; i++) {
                if (link[i].startsWith('text=')) {
                    link[i] = 'text=' + 'गीता प्रिय ' + memberName + ' जी %0A🌹जय श्री कृष्ण🌹%0A' + encodeURIComponent(newText);
                    break;
                }
            }
            href = link.join('&');
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
        document.addEventListener('DOMContentLoaded', function () {
            const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
            let cropper;



            // Show modal and initialize cropper when it is shown
            $('#cropperModal').on('shown.bs.modal', function () {
                const image = document.getElementById('cropperImage');
                const cropperContainer = document.querySelector('.cropper-container');

                // Create a new canvas element
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                // Set the desired width and height for the resized image
                var maxWidth = 2000; // Set your maximum width
                var maxHeight = 2000; // Set your maximum height

                // Ensure the image dimensions fit within the maximum dimensions while preserving aspect ratio
                var width = image.width;
                var height = image.height;

                if (width > height) {
                    if (width > maxWidth) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }

                // Set the canvas dimensions to the resized image dimensions
                canvas.width = width;
                canvas.height = height;

                // Draw the resized image onto the canvas
                ctx.drawImage(image, 0, 0, width, height);

                // Replace the original image source with the resized image data URL
                image.src = canvas.toDataURL('image/jpeg'); // Change 'image/jpeg' to the desired image format if needed

                // Initialize Cropper with the resized image


                cropper = new Cropper(image, {
                    aspectRatio: 1, // Adjust aspect ratio as needed
                    viewMode: 1,
                    rotatable: true,
                    rotator: true,
                    checkOrientation: true, // Set to 1 to ensure the cropped image fits within the container
                    crop: function (event) {
                        // Apply circular mask to cropper container
                        $('.cropper-view-box, .cropper-face').css('border-radius', '50%');
                        $('.cropper-container').css('overflow', 'hidden');
                    }
                });
                $('#cropperModal').on('hidden.bs.modal', function (e) {
                    // Check if Cropper instance exists

                    if (cropper !== undefined) {
                        // Destroy Cropper instance
                        cropper.destroy();
                    }
                });

                // Set the Cropper container's width and height explicitly
                cropperContainer.style.width = '100%';
                cropperContainer.style.height = '400px'; // Adjust height as needed
            });

            // When user clicks the "Upload Profile Photo" button, show the modal
            $('#pic').on('change', function (event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#cropperImage').attr('src', e.target.result);
                        cropperModal.show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });


            // When user clicks the "Save" button, save the cropped image
            $('#saveCroppedImage').on('click', function () {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas();
                    const croppedImageDataURL = canvas.toDataURL("image/png");

                    // Update the original image with the cropped image
                    $('#image').attr('src', croppedImageDataURL);

                    // Get the member ID
                    var memberId = userid; // Assuming you're passing member ID as a query parameter


                    // AJAX request to send cropped image data to PHP script
                    $.ajax({
                        type: 'POST',
                        url: 'partials/_updateprofilePic.php', // Update with the correct PHP script path
                        data: {
                            croppedImage: croppedImageDataURL, // Use croppedImageDataURL instead of croppedImageData
                            memberId: memberId
                        },
                        // dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                // Display success message or perform any other actions
                                // console.log(response.message);
                                console.log(response)
                            } else {
                                // Display error message or handle error case
                                // console.error(response.message);
                                console.log(response)
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle AJAX error
                            console.error(error);
                        }
                    });

                    // Close the modal
                    cropperModal.hide();
                } else {
                    console.error('Cropper is not initialized.');
                }
            });
        });
    </script>
    <script>
        changeProfilePic = (e) => {
            let userid = e.id.substring(4)
            let pic = document.createElement('input')
            pic.type = 'file'
            console.log(userid, pic)
            pic.click()
            cropperModal.show();
        }
    </script>


</body>

</html>