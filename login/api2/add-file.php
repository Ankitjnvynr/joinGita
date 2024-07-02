<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
include ("../../partials/_db.php");

// SQL query to create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS api_content (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    image_title VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    image_caption TEXT,
    dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute query
if ($conn->query($sql) === TRUE)
{
    // echo "Table api_content created successfully or already exists.";
} else
{
    echo "Error creating table: " . $conn->error;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $imageTitle = $conn->real_escape_string($_POST['image_title']);
    $imageTitle = htmlspecialchars($imageTitle);
    $imageCaption = $conn->real_escape_string($_POST['image_caption']);
    $imageCaption = htmlspecialchars($imageCaption);
    $uploadDir = '../../imgs/api_content/';

    // Ensure the upload directory exists
    if (!is_dir($uploadDir))
    {
        mkdir($uploadDir, 0777, true);
    }

    // Generate a unique filename
    $fileExtension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
    $uniqueFileName = uniqid() . '.' . $fileExtension;

    // Move the uploaded file to the server
    $uploadFile = $uploadDir . $uniqueFileName;
    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadFile))
    {
        $sql = "INSERT INTO api_content (image_title, image_path, image_caption, dt) VALUES ('$imageTitle', '$uniqueFileName', '$imageCaption', NOW())";

        if ($conn->query($sql) === TRUE)
        {
            echo "File uploaded and data saved successfully.";
            header('location:index.php');
            exit;
        } else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else
    {
        echo "Error uploading file.";
    }
}

// Close connection
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : Custom message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        .filterform>button {
            flex: 1 0 100px;
        }

        .tablediv {
            overflow-x: scroll;
            font-size: 1rem;
        }

        #myTable {}
    </style>
</head>

<body>

    <?php include '_api_option.php'; ?>
    <div class="container">
        <a href="add-file.php" class="btn btn-danger float-end">Add New</a>
        <a href="index.php" class="btn btn-danger float-start">Media</a>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Upload Image or Video</h2>
        <form action="" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
                <label for="imageTitle">Image/Video Title</label>
                <input type="text" class="form-control" id="imageTitle" name="image_title" required>
            </div>
            <div class="form-group">
                <label for="imageCaption">Image/Video Caption</label>
                <textarea class="form-control" id="imageCaption" name="image_caption" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="imageFile">Select Image or Video</label>
                <input type="file" class="form-control" id="imageFile" name="image_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        let SelectState = (e) => {
            $.ajax({
                url: '../_selectState.php',
                type: 'POST',
                data: {
                    country: e.value
                },
                success: function (response) {
                    let stateSelect = document.getElementById('stateSelect')
                    stateSelect.innerHTML = response;
                }
            })
        }
        let selectingdistrict = (e) => {
            $.ajax({
                url: '../_selectDistrict.php',
                type: 'POST',
                data: {
                    country: e.value
                },
                success: function (response) {
                    let stateSelect = document.getElementById('districtSelect')
                    stateSelect.innerHTML = response;
                }
            })
        }
        let selectingtehsil = (e) => {
            $.ajax({
                url: '../_selectTehsil.php',
                type: 'POST',
                data: {
                    country: e.value
                },
                success: function (response) {
                    let stateSelect = document.getElementById('tehsilSelect')
                    stateSelect.innerHTML = response;
                }
            })
        }
        $('.totalCount').load('../_totalProfiles.php');
        setInterval(() => {
            $('.totalCount').load('../_totalProfiles.php');
        }, 3000);
    </script>

</body>

</html>
