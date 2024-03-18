<?php
session_start();
if (isset ($_SESSION['loggedin']))
{
    //	header('location : dashboard.php');
    header("location: all-card.php");

    exit;
}
include ("../partials/_db.php");
$msg = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_user WHERE  username = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            if (password_verify($password, $row['password']))
            {
                $logged = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['intro'] = true;
                header("location: all-card.php");
                exit;
            } else
            {
                $msg = "Password not match";
            }
        }
    } else
    {
        $msg = "Wrong username";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : Admin login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 10px;
            background: #f7e092;
            overflow-x: hidden;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
        }

        .logo {
            top: -75px;
            width: 150px;
            /* border: 2px solid red; */
            border-radius: 50%;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div style="width:90%; max-width:400px "
        class="container  d-flex justify-content-center align-items-center shadow p-4 py-5 rounded bg-warning-subtle rounded-xl position-relative ">
        <div class="logo position-absolute shadow">
            <img style="width:100%" src="../imgs/cards/logo.png" alt="GIEO gita logo">
        </div>
        <form class="relative w-100 mt-5 overflow-hidden" method="POST" action="">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" required
                    placeholder="name@example.com">
                <label for="username">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" required
                    placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="text-center pt-2">
                <button type="submit" class="btn btn-danger">Log In</button>
            </div>

            <div style="height: 20px;" class="text-danger text-center mt-2 ">
                <?php echo $msg; ?>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>