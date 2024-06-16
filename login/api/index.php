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

    <?php

    // Fetch data from api_content table
    $sql = "SELECT id, image_title, image_path, image_caption, dt FROM api_content";
    $result = $conn->query($sql);
    ?>

    <div class="container mt-5">
        <h4 class="text-center">Media Content</h4>
        <a href="add-file.php" class="btn btn-danger float-end">Add New</a>
        <a href="custom-message.php" class="btn btn-danger float-start">Send Message</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Media</th>
                    <th>Caption</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['image_title']) . "</td>";
                        echo "<td>";
                        $fileExtension = pathinfo($row['image_path'], PATHINFO_EXTENSION);
                        if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        {
                            echo "<img src='../../imgs/api_content/" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['image_title']) . "' style='max-width: 320px; max-height: 240px;'>";
                        } elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv']))
                        {
                            echo "<video width='320' height='240' controls>";
                            echo "<source src='../../imgs/api_content/" . htmlspecialchars($row['image_path']) . "' type='video/" . $fileExtension . "'>";
                            echo "Your browser does not support the video tag.";
                            echo "</video>";
                        }
                        echo "</td>";
                        echo "<td>" . htmlspecialchars($row['image_caption']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['dt']) . "</td>";
                        echo "<td>";
                        echo "<a href='update.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></a> ";
                        echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this item?\")'><i class='fas fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else
                {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // Close connection
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</body>

</html>