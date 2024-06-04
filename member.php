<?php

function getCurrentURL()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['SERVER_NAME'];
    $uri = $_SERVER['REQUEST_URI'];

    return $protocol . $host . $uri;
}

$currentURL = getCurrentURL();


$statusMsg = '';
include("partials/_db.php");
if (!isset($_GET['member'])) {
    header('location:view-profile.php');
    exit;
}

if (isset($_POST['Update'])) {
    $targetDir = "imgs/";
    $updateEmail = $_POST['updateEmail'];
    $memberId = $_GET['member'];
    $dob = $_POST["dob"];
    $aniver_date = isset($_POST['aniver_date']) ? $_POST['aniver_date'] : "";
    $sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $statusMsg = 'profile update successfully.';
    $fileName = $row['pic'];

    // Insert image file name into database 
    $usql = "UPDATE `users` SET `email`='$updateEmail', `dob`='$dob', `aniver_date`='$aniver_date',  `pic`='$fileName' WHERE `hash_id` = '$memberId'";
    $update = mysqli_query($conn, $usql);
    $update = true;
}
$memberId = false;
$memberId = $_GET['member'];
$sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (!$row) {
    echo "not";
    header("location:view-profile.php?pnot=true");
    exit;
}
$idMember = $row['id'];
$name = $row['name'];
$country = $row['country'];
$state = $row['state'];
$district = $row['district'];
$tehsil = $row['tehsil'];
$phone = $row['phone'];
$wing = $row['interest'];
$designation = $row['designation'];
$pic = $row['pic'];
$star = $row['star'];
$dob = $row['dob'];
$aniver_date = $row['aniver_date'];
$icon = '';
if ($star == 'null') {
    $star = "";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita |
        <?php echo $name; ?>
    </title>
    <link rel="shortcut icon" href="imgs/<?php echo $row['pic'] ?>" type="image/x-icon">


    <meta property="og:title" content="GIEO Gita : <?php echo $name; ?> ">
    <meta property="og:description" content=" <?php echo $name; ?> is a member of GIEO Gita">
    <meta property="og:image" content="https://parivaar.gieogita.org/imgs/<?php echo $row['pic'] ?>">
    <meta property="og:url" content="<?php echo $currentURL ?>">
    <meta property="og:type" content="article">


    <!-- Load FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        body {
            background: #f7e092;
            overflow-x: hidden;
        }

        #card td {
            text-transform: capitalize;
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

        @media screen and (max-width: 480px) {

            .rashtr-suchna {
                display: flex;
                flex-direction: column-reverse !important;
            }
        }

        .music-item {
            cursor: pointer;
        }

        .music-item:hover {
            background-color: var(--bs-warning-bg-subtle) !important;
            ;
        }

        .contrls {
            cursor: pointer;
        }

        #cropperImage {
            width: 50%;
        }

        #cropperImage img {
            width: 100%;
        }

        /* Add this CSS to ensure Cropper stays within the bounds of its container */
        .modal-body {
            overflow: hidden;
            /* Hide any overflow within the modal body */
        }

        .cropper-container {
            max-width: 100%;
            /* Ensure Cropper container doesn't exceed the width of its parent */
            max-height: 100%;
            /* Ensure Cropper container doesn't exceed the height of its parent */
        }

        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
            /* Apply circular mask */
        }

        .karykarinitable {
            overflow-x: scroll;
        }

        .karykarinitable table {
            font-size: 1rem !important;
        }

        .picscard {
            flex: 1 0 200px !important;
        }
    </style>
    <link rel="stylesheet" href="css/icard.css">
</head>

<body>
    <!-- =============toast=============== -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="jointoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img width="20px" src="https://static.vecteezy.com/system/resources/previews/010/152/436/original/tick-check-mark-icon-sign-symbol-design-free-png.png" class="rounded me-2" alt="...">
                <strong class="me-auto text-success">Joined successfully</strong>
                <small>1 second ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Thanks for joining.
            </div>
        </div>
    </div>


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="alreadyToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img width="20px" src="https://static.vecteezy.com/system/resources/previews/010/152/436/original/tick-check-mark-icon-sign-symbol-design-free-png.png" class="rounded me-2" alt="...">
                <strong class="me-auto text-success">Already Joined</strong>
                <small>1 second ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                This Phone Number Already Linked With this Profile
            </div>
        </div>
    </div>


    <!-- Modal -->
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


    <!-- ========================= -->



    <?php
    include 'partials/_header.php';
    ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md  d-flex justify-content-center align-items-center p-3">
                <img style="width: 42%; aspect-ratio: 1/1; object-fit:cover;" class="rounded-circle shadow-lg border border-black" src="imgs/<?php echo $row['pic'] ?>" alt="user image" class="user">
            </div>
            <div class="col-md p-3">
                <div class="shadow-lg bg-white rounded-5 p-4">
                    <table class="table p-3 " id="card">
                        <thead>
                            <tr>
                                <th scope="col-md">Name</th>
                                <td colspan="2">
                                    <?php echo $name; ?>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">City</th>
                                <td colspan="2">
                                    <?php echo $tehsil; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Phone No</th>
                                <td colspan="2">
                                    <?php echo $phone; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Wing</th>
                                <td colspan="2">
                                    <?php echo $wing; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Designation</th>
                                <td colspan="2">

                                    <?php echo $designation; ?>
                                </td>
                            </tr>

                            <?php
                            if ($star !== '') {
                                if ($star == "Corporate Trustee") {
                                    $icon = "⭐⭐⭐";
                                } elseif ($star == "Patern Trustee") {
                                    $icon = "⭐⭐";
                                } else {
                                    $icon = "⭐";
                                }
                                echo '
                                        <tr>
                                            <th scope="row">' . $icon . '</th>
                                            <td colspan="2">
                                                ' . $star . '
                                            </td>
                                        </tr>
                                    ';
                            }
                            ?>

                            <tr>

                                <td class="text-center bg-warning-subtle rounded-3" colspan="3">
                                    <button class="btn btn-danger" id="downloadButton">Download your card</button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="transform: translatex(-200%)" class="container position-absolute">
        <div id="studentIDCard">
            <div class="i-card">
                <div class="i-card-img">
                    <img src="imgs/<?php echo $row['pic'] ?>" alt="img" />
                </div>
                <p class="i-card-name"><?php echo $name ?></p>
                <table class="i-card-table">
                    <thead>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?php echo $tehsil ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $phone ?></td>
                        </tr>
                        <tr>
                            <td>Wing</td>
                            <td>:</td>
                            <td><?php echo $wing ?></td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>:</td>
                            <td><?php echo $designation ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $icon ?></td>
                            <td>:</td>
                            <td><?php echo $star ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <h4>Update your Profile</h4>
                </div>
                <div class="col-md ">
                    <form action=" <?php echo $_SERVER['PHP_SELF'] . "?member=" . $memberId; ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md my-2 ">
                                <label for="updatephone">Phone No</label>
                                <input type="text" class="form-control" value="<?php echo $phone; ?>" id="updatephone" aria-label="First name" disabled>
                            </div>
                            <div class="col-md my-2">
                                <label for="updateEmail">Email address</label>
                                <input type="text" value="<?php echo $row['email']; ?>" class="form-control" id="updateEmail" name="updateEmail" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md my-2 ">
                                <label for="updatedob">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>" id="updatedob" aria-label="First name">
                            </div>
                            <div class="col-md my-2">
                                <label for="updateAniver">Aniversary Date</label>
                                <input type="date" value="<?php echo $aniver_date; ?>" class="form-control" id="updateAniver" name="aniver_date" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md my-2">
                                <label for="pic">Upload Profile Photo</label>
                                <input onchange="fileValidation(this)" type="file" id="pic" name="pic" accept="image/*" class="form-control" aria-label="picture">
                                <span class="text-danger op">
                                    <?php echo $statusMsg; ?>
                                </span>
                            </div>

                        </div>
                        <button type="submit" name="Update" class="btn btn-danger my-1">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row rashtr-suchna">
            <div class="col-md p-2">
                <div class="bg-white p-3 p-md-5 rounded-5 shadow-lg">

                    <?php
                    // Define the path to the file
                    $filePath = 'rashrSuchna.txt';
                    // Method 1: Using file_get_contents()
                    $fileContent = file_get_contents($filePath);
                    echo htmlspecialchars($fileContent);
                    ?>
                </div>
            </div>
            <div class="col-md d-flex justify-content-center align-items-center ">
                <div class="fw-bold">
                    <h3 class="fw-bold">राष्ट्र सूचना</h3>
                </div>
            </div>
        </div>


    </div>


    <!-- ------------------musicplayer start------------- -->
    <div class="container-fluid py-5 bg-white ">
        <div class="container">
            <div class="row bg-white rounded-5 shadow-lg mx-2">
                <div class="col-md bg-warning-subtle rounded-5 py-4 bg-white">
                    <!-- Define the section for displaying details -->
                    <div class="details d-flex flex-column justify-content-center align-items-center">
                        <div class="now-playing">PLAYING</div>
                        <div class="track-art"></div>
                        <div style="" class="track-name fs-6 ">Song 1</div>
                        <audio data-music="0" src="audio/song1.mp3" id="currentAudio"></audio>
                    </div>
                    <!-- Define the section for displaying track buttons -->
                    <div class="buttons d-flex justify-content-around align-items-center mt-4 gap-3">
                        <div class="prev-track contrls" onclick="prevTrack()">
                            <i class="fa fa-step-backward fa-2x"></i>
                        </div>
                        <div class="playpause-track contrls" onclick="playpauseTrack()">
                            <i class="fa fa-play-circle fa-5x"></i>
                        </div>
                        <div class="next-track contrls" onclick="nextTrack()">
                            <i class="fa fa-step-forward fa-2x"></i>
                        </div>
                    </div>
                    <!-- Define the section for displaying the seek slider-->
                    <div class="slider_container d-flex justify-content-center align-items-center mt-4 gap-3 ">
                        <div class="current-time">00:00</div>
                        <input style="width: 60%;" type="range" min="1" max="100" value="0" class="seek_slider contrls" onchange="seekTo()">
                        <div class="total-duration">00:00</div>
                    </div>
                    <!-- Define the section for displaying the volume slider-->
                    <div class="slider_container d-flex justify-content-center align-items-center mt-4 gap-3">
                        <i class="fa fa-volume-down"></i>
                        <input style="width: 50%;" type="range" min="1" max="100" value="41" class="volume_slider contrls" onchange="setVolume()">
                        <i class="fa fa-volume-up"></i>
                    </div>
                </div>

                <div class="col-md px-2 py-3">
                    <div style=" height:100%;  " class="music-player mx-2 ">
                        click to play
                        <ol id="songlist" style="max-height: 300px; font-size:1rem;" class="list-group list-group-numbered overflow-y-scroll">
                            <!-- Replace the following list items with your actual music data -->
                            <li id="0" class="list-group-item music-item" data-src="audio/song1.mp3" data-cover="images/cover1.jpg">Song 1</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------------musicplayer end------------- -->



    <div class="container-fluid  py-3 my-2">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-md d-flex justify-content-center flex-column align-items-center">
                    <h3 class="fw-bold">​मासिक प्रवास</h3>
                    <div class="my-2">
                        <img width="100%" class="rounded-3 shadow-lg" src="masik_parwas/<?php
                                                                                        $sql = "SELECT * FROM `masik_parvas` ORDER BY `dt` DESC ";
                                                                                        $result = mysqli_query($conn, $sql);
                                                                                        $row = mysqli_fetch_array($result);
                                                                                        echo $row['pic'];
                                                                                        ?>" alt="<?php echo $row['pic']; ?>">
                    </div>
                </div>
                <div class="col-md d-flex flex-column justify-content-center align-items-center">
                    <h3 class="fw-bold">VIDEOS</h3>
                    <video style="max-width:100%; max-height:100%" controls src="imgs/videos/video.mp4"></video>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="container my-4">
        <div class="card mb-3 ">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="imgs/guruji.webp" class="img-fluid rounded-start m-auto" alt="...">
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body  ">
                        <h3 class="card-title">Swami Shri Gyananand Ji Maharaj</h3>
                        <p class="card-text">A portent of harmony and harbinger of love, Gurudev is a pedagogue, a
                            philosopher, a guide, a writer, a yogi and a social server.</p>
                        <p class="card-text"><small class="text-body-secondary">.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-2 p-2 shadow-lg rounded-5">
        <h2 class="text-center">Our Focus</h2>
        <ul>
            <li>
                <b>Global</b>
                <p>The world is in Gods heart! Is it on yours? Sun does not discriminate; its rays fall on every spot
                    alike. GITA is a major guidebook. It is an eirenicona work that harmonizes the conflicting views of
                    life.</p>
            </li>
            <li>
                <b>Inspiration</b>
                <p>GITA says It is better to perform one’s own duties imperfectly than to master the duties of another.
                    By fulfilling the obligations he is born with, a person never comes to grief.</p>
            </li>
            <li>
                <b>Enlightment</b>
                <p>GITA is sometimes a lesson, sometimes a warning, sometimes an inspiration and sometimes motivation.
                    It teaches, happiness is not something to be postponed for the future instead it is something to be
                    experienced every second in the present.</p>
            </li>
        </ul>
    </div>


    <div class="container-fluid bg-light my-4 py-5">
        <div class="container ">
            <div class="row">
                <div class="col-md d-flex justify-content-center align-items-center">
                    <h3> कार्यकारिणी सदस्य (
                        <?php
                        echo $tehsil;
                        ?>)
                    </h3>
                </div>
                <div class="col-md karykarinitable">
                    <table class="table   table-striped fs-5">
                        <thead>
                            <tr>
                                <th scope="col">sr</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>

                                <th scope="col">Designation</th>
                                <th scope="col">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ksql = "SELECT `name`,`phone`,`tehsil`, `designation` FROM `users` WHERE country = '$country' AND state = '$state' AND district = '$district' AND tehsil = '$tehsil' AND designation != 'Member';";

                            $res = $conn->query($ksql);
                            $ser = 0;
                            while ($r = mysqli_fetch_assoc($res)) {
                                $ser++;
                                echo '
                                <tr class="text-secondary">
                                <th scope="row">' . $ser . '</th>
                                <td>' . $r['name'] . '</td>
                                <td>' . $r['phone'] . '</td>
                                
                                <td>' . $r['designation'] . '</td>
                                <td class="text-success d-flex gap-4 fs-4">
                                    <a href="tel:' . $r['phone'] . '">
                                        <i class="fa-solid fa-phone"></i>
                                    </a>
                                    <a href="https://wa.me/91' . $r['phone'] . '?text=गीता प्रिय ' . $r['name'] . ' जी , %0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </td>
                            </tr>
                                ';
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =======================photo section============================ -->
    <div class="container mb-5">
        <h4>Downloads</h4>
        <div class="row gap-2 d-flex flex-wrap">

            <?php
            // Define the directory where your images are stored
            $imageDir = 'imgs/gurujiPics/';

            // Open a directory handle
            $dirHandle = opendir($imageDir);

            // Loop through each file in the directory
            while (($file = readdir($dirHandle)) !== false) {
                // Check if the file is an image
                if (is_file($imageDir . $file) && in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Display the image
                    echo '<div  class=" picscard card d-flex align-items-center justify-content-center"> <img style="height: 100%; object-fit:cover; max-width:200px" src="' . $imageDir . $file . '" alt="' . $file . '" /><a download class="btn btn-sucess" href="imgs/gurujiPics/' . $file . '">Download</a> </div>';
                }
            }

            // Close the directory handle
            closedir($dirHandle);
            ?>


        </div>
    </div>
    <!-- =======================photo section end ============================ -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Get the member ID
        var memberId = <?php echo $idMember; ?>;

        // Function to trigger download of the image
        function downloadImage(dataUrl) {
            const link = document.createElement('a');
            link.href = dataUrl;
            link.download = '<?php echo $name . $phone ?>';
            link.click();
        }
    </script>

    <script src="js/music.js"></script>
    <script src="js/member.js"></script>
    <script src="js/iCard.js"></script>



    <?php
    if (isset($_GET['joined'])) {
        $joined = false;
        $joined = $_GET['joined'];
        if ($joined == true) {
            echo '
            <script>
                const toastLiveExample = document.getElementById("jointoast")
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            </script>
                ';
        }
    }
    ?>
    <?php
    if (isset($_GET['already'])) {
        $pnot = false;
        $pnot = $_GET['already'];
        if ($pnot == true) {
            echo '
            <script>
                const toastLiveExample = document.getElementById("alreadyToast")
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            </script>
                ';
        }
    }
    ?>

</body>

</html>