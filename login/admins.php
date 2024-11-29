<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
}

include("../partials/_db.php");
header('Content-Type: text/html; charset=utf-8');

$error = ''; // Initialize an error message variable

// Handle Create operation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check for duplicate username
    $check_sql = "SELECT * FROM admin_user WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        $error = "Username already exists. Please choose a different username.";
    } else {
        // Insert new user if username is unique
        $sql = "INSERT INTO admin_user (username, password, dt) VALUES ('$username', '$password', NOW())";
        if (mysqli_query($conn, $sql)) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}

// Handle Update operation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];

    if (!empty($_POST['edit_password'])) {
        $password = password_hash($_POST['edit_password'], PASSWORD_BCRYPT);
        $sql = "UPDATE admin_user SET username = '$username', password = '$password' WHERE id = $id";
    } else {
        $sql = "UPDATE admin_user SET username = '$username' WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Handle Delete operation
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM admin_user WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Fetch all users
$sql = "SELECT * FROM admin_user";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7e092;
            overflow-x: hidden;
        }

        .logo {
            top: -75px;
            width: 150px;
            border-radius: 50%;
            overflow: hidden;
        }
    </style>
</head>

<body>
<?php include '_options.php'; ?>
    <div class="container my-5">
        <h5 class="text-center mb-4">Manage Admin Users</h5>

        <!-- Display Error Message -->
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Add User Modal -->
        <button class="btn btn-primary mb-3 fs-6" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>

        <!-- User Table -->
        <table class="table table-striped fs-6">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username']." (".$user['type'] ?>)</td>
                    <td><?= $user['dt'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editUserModal<?= $user['id'] ?>">Edit</button>
                        <a href="?delete_id=<?= $user['id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>

                <!-- Edit User Modal -->
                <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">
                                    <div class="mb-3">
                                        <label for="edit_username" class="form-label">Username</label>
                                        <input type="text" name="edit_username" class="form-control"
                                            value="<?= $user['username'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_password" class="form-label">Password (Leave blank to keep current)</label>
                                        <input type="password" name="edit_password" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="edit_user" class="btn btn-primary">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script>
        $('.totalCount').load('_totalProfiles.php');
        setInterval(() => {
            $('.totalCount').load('_totalProfiles.php');
        }, 3000);
    </script>
</body>

</html>
