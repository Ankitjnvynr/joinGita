<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
include ("../../partials/_db.php");

$id = $_GET['id'];

// Fetch existing data
$sql = "SELECT * FROM api_content WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $imageTitle = $conn->real_escape_string($_POST['image_title']);
    $imageCaption = $conn->real_escape_string($_POST['image_caption']);
    $imagePath = $row['image_path']; // Default to existing image path

    // Handle file upload if a new file is provided
    if (!empty($_FILES['image']['name']))
    {
        $uploadDir = '../../imgs/api_content/';
        $existingFilePath = $row['image_path'];
        $existingFileName = basename($existingFilePath);
        $targetFile = $uploadDir . $existingFileName; // Preserve existing filename

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false)
        {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile))
            {
                $imagePath = $targetFile; // Update image path if new file is uploaded
            } else
            {
                echo "Sorry, there was an error uploading your file.";
            }
        } else
        {
            echo "File is not an image.";
        }
    }

    $sql = "UPDATE api_content SET image_title='$imageTitle', image_caption='$imageCaption', image_path='$imagePath' WHERE id=$id";

    if ($conn->query($sql) === TRUE)
    {
        header("location: index.php");
    } else
    {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Media Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: #f7e092;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Media Content</h2>
        <div class="row">
            <div class="col-md d-flex align-items-center flex-column">
                <label for="currentImage">Current Image</label>
                <?php
                $fileExtension = pathinfo($row['image_path'], PATHINFO_EXTENSION);
                if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                {
                    echo "<img src='../../imgs/api_content/" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['image_title']) . "' style='max-width: 100%; max-height: 500px;' class='d-block mb-3'>";
                } elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv']))
                {
                    echo "<video width='100%' height='auto' controls class='d-block mb-3'>";
                    echo "<source src='../../imgs/api_content/" . htmlspecialchars($row['image_path']) . "' type='video/" . $fileExtension . "'>";
                    echo "Your browser does not support the video tag.";
                    echo "</video>";
                }
                ?>
            </div>
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data" class="mt-4">
                    <div class="form-group">
                        <label for="imageTitle">Image Title</label>
                        <input type="text" class="form-control" id="imageTitle" name="image_title"
                            value="<?php echo htmlspecialchars($row['image_title']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="imageCaption">Image Caption</label>
                        <textarea class="form-control" id="imageCaption" name="image_caption" rows="3"
                            required><?php echo htmlspecialchars($row['image_caption']); ?></textarea>
                    </div>
                    <div class="form-group my-2">
                        <input type="file" class="form-control" id="image" name="image">
                        <small class="form-text text-muted">Choose a new image to replace the current one.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>