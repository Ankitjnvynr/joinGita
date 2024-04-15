<?php
// Directory where music files are stored
$musicDirectory = '../audio/';

$msg = "";
$noti = false;

// Function to get list of music files
function getMusicFiles($directory)
{
    $files = glob($directory . "*.{mp3,wav}", GLOB_BRACE);
    return $files;
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"]))
{
    $targetDirectory = $musicDirectory;
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile))
    {
        $msg = "Sorry, file already exists.";
        $uploadOk = 0;
        $noti = true;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 5000000000)
    { // 5MB limit
        $msg =  "Sorry, your file is too large.";
        $noti = true;
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($fileType != "mp3" && $fileType != "wav")
    {
        $msg =  "Sorry, only MP3 & WAV files are allowed.";
        $uploadOk = 0;
        $noti = true;

    }

    // If everything is ok, try to upload file
    if ($uploadOk == 0)
    {
        $msg =  "Sorry, your file was not uploaded.";
        $noti = true;
    } else
    {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile))
        {
            $msg = "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
            $noti = true;
        } else
        {
            $msg = "Sorry, there was an error uploading your file.";
            $noti = true;
        }
    }
}

// Handle file deletion
if (isset($_POST['delete']))
{
    $fileToDelete = $_POST['delete'];
    if (file_exists($fileToDelete))
    {
        unlink($fileToDelete);
        $msg =  "File deleted successfully.";
        $noti = true;
    } else
    {
        $msg =  "File does not exist.";
        $noti = true;
    }
}

// Get list of music files
$musicFiles = getMusicFiles($musicDirectory);
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
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css" rel="stylesheet" />
    <style>
        body {

            background: #f7e092;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
   
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Message</strong>
                <small>1 second ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="messageContent" class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <?php include '_options.php'; ?>



    <div class="container mb-5">
        <h2>Upload Bhajan</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <input class="form-control" accept=".mp3,.wav" multiple type="file" name="file" id="file">
            <input class="btn btn-danger my-1" type="submit" value="Upload" name="submit">
        </form>
        <hr>
        <h2>Availble Bhajan</h2>


        <ol class="list-group list-group-numbered">
            <?php foreach ($musicFiles as $file): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <?php echo basename($file); ?>
                    </div>
                    <span class="badge  rounded-pill">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="delete" value="<?php echo $file; ?>">
                            <button class="btn bg-danger m-0 p-1 text-white" type="submit">Delete</button>
                        </form>
                    </span>
                </li>
            <?php endforeach; ?>
        </ol>



    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>


    <script>
        $('.totalCount').load('_totalProfiles.php');
        setInterval(() => {
            $('.totalCount').load('_totalProfiles.php');
        }, 3000);
    </script>


    <script>
        const toastLiveExample = document.getElementById('liveToast')

        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        
       
        <?php
            if($noti){
             
            echo 'toastBootstrap.show()';
            }
        ?>
    </script>

</body>

</html>
<?php $_SESSION['intro'] = false; ?>