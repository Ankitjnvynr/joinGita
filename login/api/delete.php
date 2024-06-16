<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}

include ("../../partials/_db.php");

$id = $_GET['id'];

// Fetch the file path from the database
$sql = "SELECT image_path FROM api_content WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($row)
    {
        $filePath = $row['image_path'];

        // Delete the record from the database
        $sql = "DELETE FROM api_content WHERE id = $id";
        if ($conn->query($sql) === TRUE)
        {
            // Delete the file from the server
            if (file_exists($filePath))
            {
                unlink($filePath);
            }
            header("location: index.php");
        } else
        {
            echo "Error deleting record: " . $conn->error;
        }
    } else
    {
        echo "Record not found.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Media Content</title>
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
        <h2 class="text-center text-danger">Delete Media Content</h2>
        <p>Are you sure you want to delete this record?</p>
        <form action="" method="post">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="display.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>