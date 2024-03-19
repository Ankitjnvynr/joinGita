<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $member = md5($_POST['phoneNumber']);
    header('location:member.php?member=' . $member);
    // echo $member;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/header.css">
    <style>
        body {
            background: #f7e092;
        }

        .container {
            /* max-width: 900px; */
             /* background: rgba(255, 255, 255, 0.9); */
             position: relative; 

        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="style.css" />

    <title>GIEO Gita : View Profile</title>
</head>

<body>
    <!-- =============toast=============== -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="jointoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img width="20px"
                    src="https://static.vecteezy.com/system/resources/previews/010/152/436/original/tick-check-mark-icon-sign-symbol-design-free-png.png"
                    class="rounded me-2" alt="...">
                <strong class="me-auto text-success">Joined successfully</strong>
                <small>1 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Thanks for joining.
            </div>
        </div>
    </div>
    <?php
    include 'partials/_header.php';
    ?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="phtoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img width="20px"
                    src="https://static.vecteezy.com/system/resources/thumbnails/017/172/379/small/warning-message-concept-represented-by-exclamation-mark-icon-exclamation-symbol-in-triangle-png.png"
                    class="rounded me-2" alt="...">
                <strong class="me-auto text-danger">Phone No Error!</strong>
                <small>1 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Mobile Number not Exist.
            </div>
        </div>
    </div>






    <div class="container p-md-4 shadow-lg my-3 rounded " style="padding-bottom: 1%;">
        <div class="text-center pt-2">
            <h4>
                Not a member - <a href="index.php" class="btn btn-danger p-4 py-2 p"><b>Join Now</b></a>
            </h4>
        </div>
        <hr>
        <div class="card mb-3 ">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="imgs/guruji.webp" class="img-fluid rounded-start m-auto" alt="...">
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body  ">
                        <form action="" method="POST">
                            <h5 class="text-center mb-2">View your Profile</h5>
                            <div class="form-floating mb-3">
                                <input name="phoneNumber" type="number" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" required>
                                <label for="floatingInput">Phone Number</label>
                            </div>
                            <div class="text-center"><button name="submit" type="submit"
                                    class="btn btn-danger p-4 py-2 p"><b>View</b></button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
        </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <?php
    if (isset ($_GET['joined']))
    {
        $joined = false;
        $joined = $_GET['joined'];
        if ($joined == true)
        {
            echo '
            <script>
                const toastLiveExample = document.getElementById("jointoast")
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            </script>
                ';
        }
    }
    ?>
    <?php
    if (isset ($_GET['pnot']))
    {
        $pnot = false;
        $pnot = $_GET['pnot'];
        if ($pnot == true)
        {
            echo '
            <script>
                const toastLiveExample = document.getElementById("phtoast")
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            </script>
                ';
        }
    }
    ?>


</body>

</html>