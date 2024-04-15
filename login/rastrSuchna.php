<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
// ====================creating masik parwas tabel if not exist================
include ("../partials/_db.php");




?>
<?php
// Define the path to the file
$filePath = '../rashrSuchna.txt';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Get the updated content from the form
    $updatedContent = $_POST['content'];

    // Write the updated content to the file
    if (file_put_contents($filePath, $updatedContent) !== false)
    {
        echo "File updated successfully!";
    } else
    {
        echo "Error: Unable to update file.";
    }
}

// Read the content of the file
$fileContent = file_get_contents($filePath);
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

    <?php include '_options.php'; ?>



    <div class="container">
        <h1>File Reader and Updater</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <textarea class="form-control" name="content" rows="10" cols="50"><?php echo htmlspecialchars($fileContent); ?></textarea><br>
            <input type="submit" value="Update File">
        </form>


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
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Compose an epic...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image', 'video'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });
    </script>

</body>

</html>
<?php $_SESSION['intro'] = false; ?>