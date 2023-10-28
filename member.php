<?php
    $statusMsg = ''; 
    include("partials/_db.php");
    

    if(isset($_POST['Update'])){
        $targetDir = "imgs/";
        $updateEmail =$_POST['updateEmail'];
        $phoneNumber = $_GET['phoneNumber'];

        if(!empty($_FILES["pic"]["name"])){ 
            $fileName = basename($_FILES["pic"]["name"]); 
            $targetFilePath = $targetDir . $fileName; 
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
         
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                $phoneNumber = $_GET['phoneNumber'];
                $sql = "SELECT * FROM `users` WHERE `phone` = $phoneNumber";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                $statusMsg = 'Please select a file to upload.'; 
                $fileNameUnlink = $row['pic'];
                unlink($targetDir.$fileNameUnlink);
                if(move_uploaded_file($_FILES["pic"]["tmp_name"], $targetFilePath)){
                    $updateImg =true;
                    if($updateImg){ 
                        $statusMsg = "Picture Updated successfully."; 
                    }else{ 
                        $statusMsg = "File upload failed, please try again."; 
                    }  
                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file."; 
                } 
            }else{ 
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            } 
        }else{ 
            $phoneNumber = $_GET['phoneNumber'];
            $sql = "SELECT * FROM `users` WHERE `phone` = $phoneNumber";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);
            $statusMsg = 'Please select a file to upload.'; 
            $fileName = $row['pic'];
        } 
        // Insert image file name into database 
        $usql = "UPDATE `users` SET `email`='$updateEmail', `pic`='$fileName' WHERE `phone` = $phoneNumber";
        $update = mysqli_query($conn,$usql);
        $update = true;
    }
    $phoneNumber = $_GET['phoneNumber'];
    $sql = "SELECT * FROM `users` WHERE `phone` = $phoneNumber";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if(!$row){
        echo "not";
        header("location:view-profile.php?pnot=true");
    }
    $name = $row['name'];
    $district = $row['district'];
    $phone = $row['phone'];
    $wing = $row['interest'];
    
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    body {
        background: #f7e092;
    }

    #card td {
        text-transform: capitalize;
    }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md  d-flex justify-content-center align-items-center p-3">
                <img style="width: 42%; aspect-ratio: 1/1; object-fit:cover;"
                    class="rounded-circle shadow-lg border border-black" src="imgs/<?php echo $row['pic'] ?>"
                    alt="user image" class="user">
            </div>
            <div class="col-md p-3">
                <div class="shadow-lg bg-white rounded-5 p-4">
                    <table class="table p-3 " id="card">
                        <thead>
                            <tr>
                                <th scope="col-md">Name</th>
                                <td colspan="2"><?php echo $name; ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">City</th>
                                <td colspan="2"><?php echo $district; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Phone No</th>
                                <td colspan="2"><?php echo $phone; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Wing</th>
                                <td colspan="2"><?php echo $wing; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Designation</th>
                                <td colspan="2">सदस्य</td>
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
                    <form action=" <?php echo $_SERVER['PHP_SELF']."?phoneNumber=".$phoneNumber; ?>" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md my-2 ">
                                <label for="updatephone">Phone No</label>
                                <input type="text" class="form-control" value="<?php echo $phone; ?>" id="updatephone"
                                    aria-label="First name" disabled>
                            </div>
                            <div class="col-md my-2">
                                <label for="updateEmail">Email address</label>
                                <input type="text" value="<?php echo $row['email']; ?>" class="form-control"
                                    id="updateEmail" name="updateEmail" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md my-2">
                                <label for="pic">Upload Profile Photo</label>
                                <input onchange="fileValidation()" type="file" id="pic" name="pic" class="form-control" aria-label="picture">
                                <span class="text-danger"><?php echo $statusMsg; ?></span>
                            </div>

                        </div>
                        <button type="submit" name="Update" class="btn btn-primary my-1">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-md p-2">
                <div class="bg-white p-md-5 rounded-5 shadow-lg">

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
    <div class="container-fluid bg-light py-3 my-2">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-md d-flex justify-content-center flex-column align-items-center">
                    <h3 class="fw-bold">​मासिक प्रवास</h3>
                    <div class="my-2">
                        <img height="400px" class="rounded-3 shadow-lg"
                            src="imgs/पूज्य महाराज जी के आगामी कार्यकृम_edited.webp" alt="">
                    </div>
                </div>
                <div class="col-md d-flex flex-column justify-content-center align-items-center">
                    <h3 class="fw-bold">VIDEOS</h3>
                    <video src="imgs/file.mp4" height="400px" class="object-fit-cover rounded-3 shadow-lg"
                        controls></video>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="container my-4">
        <div class="card mb-3 ">
            <div class="row g-0">
                <div class="col-md-4">
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        
        function fileValidation() {
            var fileInput = document.getElementById('pic');
            var filePath = fileInput.value;
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            }} 
    </script>
</body>

</html>