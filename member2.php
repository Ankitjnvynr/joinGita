<?php
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

    if (!empty($_FILES["pic"]["name"])) {
        $fileName = basename($_FILES["pic"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            $memberId = $_GET['member'];
            $sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $statusMsg = 'Please select a file to upload.';
            $fileNameUnlink = $row['pic'];
            if ($fileNameUnlink != 'defaultusers.png') {
                unlink($targetDir . $fileNameUnlink);
            }
            if (move_uploaded_file($_FILES["pic"]["tmp_name"], $targetFilePath)) {
                $updateImg = true;
                if ($updateImg) {
                    $statusMsg = "Picture Updated successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $memberId = $_GET['member'];
        $sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $statusMsg = 'Please select a file to upload.';
        $fileName = $row['pic'];
    }
    // Insert image file name into database 
    $usql = "UPDATE `users` SET `email`='$updateEmail', `pic`='$fileName' WHERE `hash_id` = '$memberId'";
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
$name = $row['name'];
$district = $row['district'];
$phone = $row['phone'];
$wing = $row['interest'];
$designation = $row['designation'];
$pic = $row['pic'];
$star = $row['star'];
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
    <!-- Load FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background: #f7e092;
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
    </style>
</head>

<body>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================= -->
    <input type="file" id="uploadImage" accept="image/*">
    <div id="previewContainer">
        <img id="previewImage" src="#" alt="Preview">
    </div>
    <button id="cropButton">Crop Image</button>
    ==========



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
                                    <?php echo $district; ?>
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
                                echo '
                                        <tr>
                                            <th scope="row">🔅</th>
                                            <td colspan="2">
                                                ' . $star . '
                                            </td>
                                        </tr>
                                    ';
                            }
                            ?>

                            <tr>

                                <td class="text-center bg-warning-subtle rounded-3" colspan="3">
                                    <a download class="btn btn-danger" href="card.php?member=<?php echo $memberId ?>">Download your card</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                            <div class="col-md my-2">
                                <label for="pic">Upload Profile Photo</label>
                                <input onchange="fileValidation()" type="file" id="pic" name="pic" class="form-control" aria-label="picture">
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

                    गीता मनीषी पूज्य स्वामी श्री ज्ञानानंद जी महाराज की सत्प्रेरणा
                    पुरुषोत्तम मास में करें,अधिक से अधिक पुरुषोत्तम योग पाठ
                    भारतीय वर्ष एवम मास परम्परा में हर तीसरे वर्ष अधिक मास आता है,जिसके अनुसार हर बार कोई एक महीना दो
                    बार आता है,इस वर्ष श्रावण मास दो हैं,एक अधिक मास,जिसे मल मास भी कहा जाता है,इसमें लौकिक रूप में कोई
                    शुद्ध मुहूर्त नहीं निकलता! स्वयं को निंदित रूप में देख मल मास भगवान श्रीकृष्ण की शरण में आर्त भाव से
                    पहुंचा,तो भगवान नेअपना नाम देकर कहा कि अब से इस मास को पुरुषोत्तम मास कहा जाएगा ,जो इस वर्ष विक्रमी
                    संवत 2080 में 18 जुलाई से 16अगस्त तक है
                    गीता जी का 15 वा अध्याय पुरुषोत्तम परमात्मा के भाव से भावित है,
                    पूज्य गुरुदेव ने आह्वान किया है कि पुरुषोत्तम मास में इस पुरुषोत्तम योग का नित्य प्रति अधिकाधिक पाठ
                    हो, हर नगर में हो ,हर घर में हो,सभी गीता प्रिय स्वयं भी पाठ करें,अन्य सभी को भी इस पाठ के लिए
                    प्रेरित करें
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
                        <div class="now-playing">PLAYING x OF y</div>
                        <div class="track-art"></div>
                        <div class="track-name">Song 1</div>

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
                        <input style="width: 50%;" type="range" min="1" max="100" value="99" class="volume_slider contrls" onchange="setVolume()">
                        <i class="fa fa-volume-up"></i>
                    </div>
                </div>

                <div class="col-md px-2 py-5">
                    <div style=" height:100%;  " class="music-player mx-2 ">
                        <ul style="max-height: 200px;" class="list-group overflow-y-scroll">
                            <!-- Replace the following list items with your actual music data -->
                            <li id="0" class="list-group-item music-item" data-src="audio/song1.mp3" data-cover="images/cover1.jpg">Song 1</li>
                            <li id="1" class="list-group-item music-item" data-src="audio/song2.mp3" data-cover="images/cover2.jpg">Song 2</li>
                            <li id="2" class="list-group-item music-item" data-src="audio/song3.mp3" data-cover="images/cover3.jpg">Song 3</li>
                        </ul>
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
                                                                                        ?>" alt="hjt">
                    </div>
                </div>
                <div class="col-md d-flex flex-column justify-content-center align-items-center">
                    <h3 class="fw-bold">VIDEOS</h3>
                    <video src="imgs/file.mp4" width="100%" class="object-fit-cover rounded-3 shadow-lg" controls></video>
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'))



        function fileValidation(event) {
            var fileInput = document.getElementById('pic');
            var filePath = fileInput.value;
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('File must be jpg, jpeg or png');
                fileInput.value = '';
                return false;
            }

            // Initialize Cropper.js
            let cropper;

            // document.getElementById('uploadImage').addEventListener('change', function(event) {
            const files = event.target.files;
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.getElementById('previewImage');
                img.src = e.target.result;

                // Initialize Cropper.js
                cropper = new Cropper(img, {
                    aspectRatio: 1, // Set the aspect ratio as needed
                    crop: function(event) {
                        // You can add logic here to handle cropping coordinates
                    }
                });
            };

            reader.readAsDataURL(files[0]);
            // });

            // Handle crop button click
            document.getElementById('cropButton').addEventListener('click', function() {
                // Get cropped image data
                const croppedImageData = cropper.getCroppedCanvas().toDataURL('image/jpeg');

                // You can now send the croppedImageData to the server or perform any other action
            });

        }
    </script>
    <script src="js/music.js"></script>

</body>

</html>