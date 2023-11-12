<?php
session_start();
if (isset($_SESSION['loggedin'])) {
//	header('location : dashboard.php');
	header("location: alluser.php");

	exit;
}
include("../partials/_db.php");
$msg = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_user WHERE  username = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password,  $row['password'])) {
                $logged = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: alluser.php");
                exit;
            } else {
                $msg = "Password not match";
            }
        }
    } else {
        $msg = "Wrong username";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>GIEO Gita : Login</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <!--Stylesheet-->


    <style media="screen">

    </style>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email or Username" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <div class="msg red"><?php echo $msg; ?></div>

        <button type="submit">Log In</button>

    </form>
</body>

</html>