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
    <link rel="stylesheet" href="../css/allcard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css"
        integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"
        integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <!-- =================profile picture upate modaal cropper js================ -->
    <!-- Modal -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crop Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="cropper-container">
                        <img id="cropperImage" src="" alt="Image to crop">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveCroppedImage" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =================profile picture upate modaal end ================ -->







    <?php include '_options.php'; ?>
    <input id="changeImg" type="file" class="form-control " hidden>

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
    <div class="container text-center my-3 d-flex justify-content-center gap-2">
        <button class="btn btn-success" onclick="loadMore(5,5)" id="loadMore">Load
            More
        </button>
        <span id="moreloader"></span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"
        integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js"
        integrity="sha512-Zt7blzhYHCLHjU0c+e4ldn5kGAbwLKTSOTERgqSNyTB50wWSI21z0q6bn/dEIuqf6HiFzKJ6cfj2osRhklb4Og=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //storing function for localstorage
        storeFilter = () => {
            
            var fltr = {
                filterName: $('#filterName').val(),
                phone: $('#filterPhone').val(),
                filterEmail: $('#filterEmail').val(),
                filterCountry: $('#countrySelect').val(),
                filterState: $('#stateSelect').val(),
                filterDistrict: $('#districtSelect').val(),
                filterTehsil: $('#tehsilSelect').val(),
                limit: "50",
                start: '0',
            }
            var filterStringStoring = JSON.stringify(fltr);
            isfilter = true;
            var isfilter = JSON.stringify(isfilter);
            sessionStorage.setItem('filterObject', filterStringStoring); // corrected typo here
            sessionStorage.setItem('isFilter', isfilter); // corrected typo here
            // // Clear all data from session storage
            // sessionStorage.clear();

        }

        editProfileDetail = async (userId) => {
            await storeFilter();
            console.log(userId)
            window.location.href = "update.php?user=" + userId;
        }

    </script>

    <script src="filterselect.js"></script>
    <script src="../js/allcard.js"></script>

    <script>
        const updatedToast = document.getElementById('updatedToast')
        const toastBootstrapupdate = bootstrap.Toast.getOrCreateInstance(updatedToast)



    </script>


</body>

</html>